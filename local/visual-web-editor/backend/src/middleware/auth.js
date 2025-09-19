/**
 * Authentication Middleware
 * Handles JWT token verification and user authentication
 */

const jwt = require('jsonwebtoken');
const logger = require('../utils/logger');
const userStore = require('../utils/userStore');

const JWT_SECRET = process.env.JWT_SECRET || 'your-super-secret-jwt-key-change-in-production';

/**
 * Authenticate user with JWT token
 */
const authenticate = async (req, res, next) => {
  try {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      return res.status(401).json({
        error: 'Authentication required',
        message: 'Please provide a valid authentication token'
      });
    }

    const token = authHeader.substring(7); // Remove 'Bearer ' prefix

    // Verify JWT token
    const decoded = jwt.verify(token, JWT_SECRET);
    
    if (decoded.type !== 'access') {
      return res.status(401).json({
        error: 'Invalid token type',
        message: 'Access token required'
      });
    }

    // Find user using centralized user store
    const user = userStore.findById(decoded.userId);
    if (!user) {
      return res.status(401).json({
        error: 'User not found',
        message: 'Authentication token is invalid'
      });
    }

    // Attach user to request object (without password)
    const { password: _, ...userWithoutPassword } = user;
    req.user = userWithoutPassword;
    
    next();

  } catch (error) {
    if (error.name === 'JsonWebTokenError') {
      return res.status(401).json({
        error: 'Invalid token',
        message: 'Authentication token is malformed'
      });
    }
    
    if (error.name === 'TokenExpiredError') {
      return res.status(401).json({
        error: 'Token expired',
        message: 'Authentication token has expired'
      });
    }

    logger.error('Authentication error:', error);
    res.status(500).json({
      error: 'Authentication failed',
      message: 'Internal server error during authentication'
    });
  }
};

/**
 * Optional authentication - doesn't fail if no token provided
 */
const optionalAuth = async (req, res, next) => {
  try {
    const authHeader = req.headers.authorization;
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      // No token provided, continue without authentication
      req.user = null;
      return next();
    }

    const token = authHeader.substring(7);
    const decoded = jwt.verify(token, JWT_SECRET);
    
    if (decoded.type === 'access') {
      const user = userStore.findById(decoded.userId);
      if (user) {
        const { password: _, ...userWithoutPassword } = user;
        req.user = userWithoutPassword;
      }
    }
    
    next();

  } catch (error) {
    // If token is invalid, continue without authentication
    req.user = null;
    next();
  }
};

/**
 * Require admin role
 */
const requireAdmin = async (req, res, next) => {
  if (!req.user) {
    return res.status(401).json({
      error: 'Authentication required',
      message: 'Please authenticate first'
    });
  }

  if (req.user.role !== 'admin') {
    return res.status(403).json({
      error: 'Admin access required',
      message: 'This action requires administrator privileges'
    });
  }

  next();
};

/**
 * Require specific role
 */
const requireRole = (role) => {
  return async (req, res, next) => {
    if (!req.user) {
      return res.status(401).json({
        error: 'Authentication required',
        message: 'Please authenticate first'
      });
    }

    if (req.user.role !== role) {
      return res.status(403).json({
        error: 'Insufficient permissions',
        message: `This action requires ${role} role`
      });
    }

    next();
  };
};

/**
 * Require any of the specified roles
 */
const requireAnyRole = (roles) => {
  return async (req, res, next) => {
    if (!req.user) {
      return res.status(401).json({
        error: 'Authentication required',
        message: 'Please authenticate first'
      });
    }

    if (!roles.includes(req.user.role)) {
      return res.status(403).json({
        error: 'Insufficient permissions',
        message: `This action requires one of the following roles: ${roles.join(', ')}`
      });
    }

    next();
  };
};

/**
 * Check if user owns the resource
 */
const requireOwnership = (resourceIdParam = 'id', userIdField = 'userId') => {
  return async (req, res, next) => {
    if (!req.user) {
      return res.status(401).json({
        error: 'Authentication required',
        message: 'Please authenticate first'
      });
    }

    // Admin can access any resource
    if (req.user.role === 'admin') {
      return next();
    }

    const resourceId = req.params[resourceIdParam];
    
    // For this implementation, we'll check if the user ID matches
    // In a real application, you'd query the database to check ownership
    if (req.user.id !== resourceId && req.body[userIdField] !== req.user.id) {
      return res.status(403).json({
        error: 'Access denied',
        message: 'You can only access your own resources'
      });
    }

    next();
  };
};

/**
 * Rate limiting per user
 */
const userRateLimit = (maxRequests = 100, windowMs = 15 * 60 * 1000) => {
  const userRequests = new Map();

  return async (req, res, next) => {
    const userId = req.user?.id || req.ip;
    const now = Date.now();
    
    if (!userRequests.has(userId)) {
      userRequests.set(userId, []);
    }

    const requests = userRequests.get(userId);
    
    // Remove old requests outside the window
    const validRequests = requests.filter(timestamp => now - timestamp < windowMs);
    
    if (validRequests.length >= maxRequests) {
      return res.status(429).json({
        error: 'Rate limit exceeded',
        message: `Too many requests. Maximum ${maxRequests} requests per ${windowMs / 1000 / 60} minutes.`,
        retryAfter: Math.ceil((validRequests[0] + windowMs - now) / 1000)
      });
    }

    validRequests.push(now);
    userRequests.set(userId, validRequests);
    
    next();
  };
};

/**
 * Verify email requirement
 */
const requireVerifiedEmail = async (req, res, next) => {
  if (!req.user) {
    return res.status(401).json({
      error: 'Authentication required',
      message: 'Please authenticate first'
    });
  }

  if (!req.user.isEmailVerified) {
    return res.status(403).json({
      error: 'Email verification required',
      message: 'Please verify your email address to access this feature'
    });
  }

  next();
};

/**
 * Check if user account is active
 */
const requireActiveAccount = async (req, res, next) => {
  if (!req.user) {
    return res.status(401).json({
      error: 'Authentication required',
      message: 'Please authenticate first'
    });
  }

  if (req.user.status === 'suspended') {
    return res.status(403).json({
      error: 'Account suspended',
      message: 'Your account has been suspended. Please contact support.'
    });
  }

  if (req.user.status === 'deleted') {
    return res.status(403).json({
      error: 'Account deleted',
      message: 'This account has been deleted.'
    });
  }

  next();
};

/**
 * Log user activity
 */
const logActivity = (action) => {
  return async (req, res, next) => {
    if (req.user) {
      logger.info(`User activity: ${req.user.email} (${req.user.id}) - ${action}`, {
        userId: req.user.id,
        action,
        ip: req.ip,
        userAgent: req.headers['user-agent'],
        timestamp: new Date().toISOString()
      });
    }
    next();
  };
};

module.exports = {
  authenticate,
  optionalAuth,
  requireAdmin,
  requireRole,
  requireAnyRole,
  requireOwnership,
  userRateLimit,
  requireVerifiedEmail,
  requireActiveAccount,
  logActivity
};
