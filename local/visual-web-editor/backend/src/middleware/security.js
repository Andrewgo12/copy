/**
 * Security Middleware
 * Additional security measures for the application
 */

const rateLimit = require('express-rate-limit');
const logger = require('../utils/logger');

/**
 * Request sanitization middleware
 */
const sanitizeRequest = (req, res, next) => {
  // Remove potentially dangerous characters from request body
  if (req.body && typeof req.body === 'object') {
    sanitizeObject(req.body);
  }
  
  // Remove potentially dangerous characters from query parameters
  if (req.query && typeof req.query === 'object') {
    sanitizeObject(req.query);
  }
  
  next();
};

/**
 * Recursively sanitize object properties
 */
const sanitizeObject = (obj) => {
  for (const key in obj) {
    if (obj.hasOwnProperty(key)) {
      if (typeof obj[key] === 'string') {
        // Remove script tags and other potentially dangerous content
        obj[key] = obj[key]
          .replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '')
          .replace(/javascript:/gi, '')
          .replace(/on\w+\s*=/gi, '');
      } else if (typeof obj[key] === 'object' && obj[key] !== null) {
        sanitizeObject(obj[key]);
      }
    }
  }
};

/**
 * IP whitelist middleware
 */
const ipWhitelist = (allowedIPs = []) => {
  return (req, res, next) => {
    if (allowedIPs.length === 0) {
      return next(); // No whitelist configured, allow all
    }
    
    const clientIP = req.ip || req.connection.remoteAddress;
    
    if (!allowedIPs.includes(clientIP)) {
      logger.warn('IP not in whitelist:', {
        ip: clientIP,
        url: req.url,
        method: req.method,
        userAgent: req.headers['user-agent']
      });
      
      return res.status(403).json({
        error: 'Access denied',
        message: 'Your IP address is not authorized to access this resource'
      });
    }
    
    next();
  };
};

/**
 * Request size limiter
 */
const requestSizeLimiter = (maxSize = '10mb') => {
  return (req, res, next) => {
    const contentLength = parseInt(req.headers['content-length']);
    const maxSizeBytes = parseSize(maxSize);
    
    if (contentLength && contentLength > maxSizeBytes) {
      return res.status(413).json({
        error: 'Request too large',
        message: `Request size exceeds maximum allowed size of ${maxSize}`
      });
    }
    
    next();
  };
};

/**
 * Parse size string to bytes
 */
const parseSize = (size) => {
  const units = {
    'b': 1,
    'kb': 1024,
    'mb': 1024 * 1024,
    'gb': 1024 * 1024 * 1024
  };
  
  const match = size.toLowerCase().match(/^(\d+(?:\.\d+)?)\s*(b|kb|mb|gb)?$/);
  if (!match) return 0;
  
  const value = parseFloat(match[1]);
  const unit = match[2] || 'b';
  
  return Math.floor(value * units[unit]);
};

/**
 * User agent validation
 */
const validateUserAgent = (req, res, next) => {
  const userAgent = req.headers['user-agent'];
  
  if (!userAgent) {
    logger.warn('Request without user agent:', {
      ip: req.ip,
      url: req.url,
      method: req.method
    });
  }
  
  // Block known malicious user agents
  const maliciousPatterns = [
    /sqlmap/i,
    /nikto/i,
    /nessus/i,
    /masscan/i,
    /nmap/i,
    /dirb/i,
    /dirbuster/i
  ];
  
  if (userAgent && maliciousPatterns.some(pattern => pattern.test(userAgent))) {
    logger.warn('Malicious user agent detected:', {
      userAgent,
      ip: req.ip,
      url: req.url,
      method: req.method
    });
    
    return res.status(403).json({
      error: 'Access denied',
      message: 'Suspicious user agent detected'
    });
  }
  
  next();
};

/**
 * Request method validation
 */
const validateRequestMethod = (allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS']) => {
  return (req, res, next) => {
    if (!allowedMethods.includes(req.method)) {
      return res.status(405).json({
        error: 'Method not allowed',
        message: `HTTP method ${req.method} is not allowed for this endpoint`,
        allowedMethods
      });
    }
    
    next();
  };
};

/**
 * Content type validation
 */
const validateContentType = (allowedTypes = ['application/json', 'multipart/form-data', 'application/x-www-form-urlencoded']) => {
  return (req, res, next) => {
    // Skip validation for GET requests and requests without body
    if (req.method === 'GET' || !req.headers['content-type']) {
      return next();
    }
    
    const contentType = req.headers['content-type'].split(';')[0];
    
    if (!allowedTypes.some(type => contentType.includes(type))) {
      return res.status(415).json({
        error: 'Unsupported media type',
        message: `Content type ${contentType} is not supported`,
        allowedTypes
      });
    }
    
    next();
  };
};

/**
 * Request frequency limiter per endpoint
 */
const endpointRateLimit = (options = {}) => {
  const {
    windowMs = 15 * 60 * 1000, // 15 minutes
    max = 100, // limit each IP to 100 requests per windowMs
    message = 'Too many requests from this IP, please try again later.',
    standardHeaders = true,
    legacyHeaders = false
  } = options;
  
  return rateLimit({
    windowMs,
    max,
    message: {
      error: 'Rate limit exceeded',
      message,
      retryAfter: Math.ceil(windowMs / 1000)
    },
    standardHeaders,
    legacyHeaders,
    handler: (req, res) => {
      logger.warn('Rate limit exceeded:', {
        ip: req.ip,
        url: req.url,
        method: req.method,
        userAgent: req.headers['user-agent']
      });
      
      res.status(429).json({
        error: 'Rate limit exceeded',
        message,
        retryAfter: Math.ceil(windowMs / 1000)
      });
    }
  });
};

/**
 * Suspicious activity detector
 */
const suspiciousActivityDetector = (req, res, next) => {
  const suspiciousPatterns = [
    // SQL injection patterns
    /(\b(union|select|insert|update|delete|drop|create|alter|exec|execute)\b)/i,
    // XSS patterns
    /<script[^>]*>.*?<\/script>/gi,
    /javascript:/gi,
    /on\w+\s*=/gi,
    // Path traversal patterns
    /\.\.\//g,
    /\.\.\\/g,
    // Command injection patterns
    /[;&|`$()]/g
  ];
  
  const checkString = (str) => {
    return suspiciousPatterns.some(pattern => pattern.test(str));
  };
  
  const checkObject = (obj) => {
    for (const key in obj) {
      if (obj.hasOwnProperty(key)) {
        if (typeof obj[key] === 'string' && checkString(obj[key])) {
          return true;
        } else if (typeof obj[key] === 'object' && obj[key] !== null) {
          if (checkObject(obj[key])) return true;
        }
      }
    }
    return false;
  };
  
  // Check URL
  if (checkString(req.url)) {
    logger.warn('Suspicious URL detected:', {
      url: req.url,
      ip: req.ip,
      userAgent: req.headers['user-agent']
    });
    
    return res.status(400).json({
      error: 'Bad request',
      message: 'Suspicious content detected in request'
    });
  }
  
  // Check query parameters
  if (req.query && checkObject(req.query)) {
    logger.warn('Suspicious query parameters detected:', {
      query: req.query,
      ip: req.ip,
      userAgent: req.headers['user-agent']
    });
    
    return res.status(400).json({
      error: 'Bad request',
      message: 'Suspicious content detected in query parameters'
    });
  }
  
  // Check request body
  if (req.body && checkObject(req.body)) {
    logger.warn('Suspicious request body detected:', {
      body: req.body,
      ip: req.ip,
      userAgent: req.headers['user-agent']
    });
    
    return res.status(400).json({
      error: 'Bad request',
      message: 'Suspicious content detected in request body'
    });
  }
  
  next();
};

/**
 * Security headers middleware
 */
const securityHeaders = (req, res, next) => {
  // Prevent clickjacking
  res.setHeader('X-Frame-Options', 'DENY');
  
  // Prevent MIME type sniffing
  res.setHeader('X-Content-Type-Options', 'nosniff');
  
  // Enable XSS protection
  res.setHeader('X-XSS-Protection', '1; mode=block');
  
  // Referrer policy
  res.setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
  
  // Permissions policy
  res.setHeader('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
  
  next();
};

/**
 * Main security middleware
 */
const securityMiddleware = [
  securityHeaders,
  sanitizeRequest,
  validateUserAgent,
  suspiciousActivityDetector,
  requestSizeLimiter('50mb') // Allow larger requests for file uploads
];

module.exports = {
  securityMiddleware,
  sanitizeRequest,
  ipWhitelist,
  requestSizeLimiter,
  validateUserAgent,
  validateRequestMethod,
  validateContentType,
  endpointRateLimit,
  suspiciousActivityDetector,
  securityHeaders
};
