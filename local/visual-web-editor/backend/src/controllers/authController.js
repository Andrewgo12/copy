/**
 * Authentication Controller
 * Handles user authentication and authorization
 */

const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const { v4: uuidv4 } = require('uuid');
const crypto = require('crypto');

const logger = require('../utils/logger');
const userStore = require('../utils/userStore');

// JWT configuration
const JWT_SECRET = process.env.JWT_SECRET || 'your-super-secret-jwt-key-change-in-production';
const JWT_EXPIRES_IN = process.env.JWT_EXPIRES_IN || '24h';
const REFRESH_TOKEN_EXPIRES_IN = process.env.REFRESH_TOKEN_EXPIRES_IN || '7d';

// User storage is now handled by userStore utility

/**
 * Generate JWT token
 */
const generateToken = (userId, type = 'access') => {
  const payload = { userId, type };
  const expiresIn = type === 'refresh' ? REFRESH_TOKEN_EXPIRES_IN : JWT_EXPIRES_IN;
  
  return jwt.sign(payload, JWT_SECRET, { expiresIn });
};

/**
 * Generate secure random token
 */
const generateSecureToken = () => {
  return crypto.randomBytes(32).toString('hex');
};

/**
 * Register a new user
 */
const register = async (req, res) => {
  try {
    const { email, password, name } = req.body;

    // Check if user already exists
    const existingUser = userStore.findByEmail(email);
    if (existingUser) {
      return res.status(400).json({
        error: 'User already exists',
        message: 'A user with this email address already exists'
      });
    }

    // Hash password
    const hashedPassword = await bcrypt.hash(password, 12);

    // Create user
    const user = userStore.create({
      email,
      name,
      password: hashedPassword,
      role: 'user',
      isEmailVerified: false,
      preferences: {
        theme: 'light',
        notifications: true,
        autoSave: true
      },
      twoFactorEnabled: false
    });

    // Generate email verification token
    const verificationToken = generateSecureToken();
    userStore.emailVerificationTokens.set(verificationToken, {
      userId: user.id,
      expiresAt: new Date(Date.now() + 24 * 60 * 60 * 1000) // 24 hours
    });

    // Generate tokens
    const accessToken = generateToken(user.id);
    const refreshToken = generateToken(user.id, 'refresh');

    // Store refresh token
    userStore.refreshTokens.set(refreshToken, {
      userId: user.id,
      createdAt: new Date().toISOString()
    });

    logger.info(`User registered: ${email} (${user.id})`);

    // Return user data without password
    const { password: _, ...userWithoutPassword } = user;

    res.status(201).json({
      message: 'User registered successfully',
      user: userWithoutPassword,
      tokens: {
        accessToken,
        refreshToken
      },
      verificationToken // In production, send this via email
    });

  } catch (error) {
    logger.error('Registration error:', error);
    res.status(500).json({
      error: 'Registration failed',
      message: error.message
    });
  }
};

/**
 * Login user
 */
const login = async (req, res) => {
  try {
    const { email, password } = req.body;

    // Find user
    const user = userStore.findByEmail(email);
    if (!user) {
      return res.status(401).json({
        error: 'Invalid credentials',
        message: 'Email or password is incorrect'
      });
    }

    // Check password
    const isPasswordValid = await bcrypt.compare(password, user.password);
    if (!isPasswordValid) {
      return res.status(401).json({
        error: 'Invalid credentials',
        message: 'Email or password is incorrect'
      });
    }

    // Generate tokens
    const accessToken = generateToken(user.id);
    const refreshToken = generateToken(user.id, 'refresh');

    // Store refresh token
    userStore.refreshTokens.set(refreshToken, {
      userId: user.id,
      createdAt: new Date().toISOString()
    });

    // Create session
    const sessionId = uuidv4();
    userStore.userSessions.addSession(user.id, {
      id: sessionId,
      createdAt: new Date().toISOString(),
      lastActivity: new Date().toISOString(),
      userAgent: req.headers['user-agent'] || 'Unknown',
      ip: req.ip || req.connection.remoteAddress
    });

    logger.info(`User logged in: ${email} (${user.id})`);

    // Return user data without password
    const { password: _, ...userWithoutPassword } = user;

    res.json({
      message: 'Login successful',
      user: userWithoutPassword,
      tokens: {
        accessToken,
        refreshToken
      },
      sessionId
    });

  } catch (error) {
    logger.error('Login error:', error);
    res.status(500).json({
      error: 'Login failed',
      message: error.message
    });
  }
};

/**
 * Logout user
 */
const logout = async (req, res) => {
  try {
    const { refreshToken } = req.body;

    if (refreshToken) {
      userStore.refreshTokens.delete(refreshToken);
    }

    res.json({
      message: 'Logout successful'
    });

  } catch (error) {
    logger.error('Logout error:', error);
    res.status(500).json({
      error: 'Logout failed',
      message: error.message
    });
  }
};

/**
 * Refresh access token
 */
const refreshToken = async (req, res) => {
  try {
    const { refreshToken: token } = req.body;

    if (!token) {
      return res.status(401).json({
        error: 'Refresh token required',
        message: 'Please provide a refresh token'
      });
    }

    // Verify refresh token
    const decoded = jwt.verify(token, JWT_SECRET);
    if (decoded.type !== 'refresh') {
      return res.status(401).json({
        error: 'Invalid token type',
        message: 'Token is not a refresh token'
      });
    }

    // Check if refresh token exists
    const tokenData = userStore.refreshTokens.get(token);
    if (!tokenData || tokenData.userId !== decoded.userId) {
      return res.status(401).json({
        error: 'Invalid refresh token',
        message: 'Refresh token is invalid or expired'
      });
    }

    // Generate new access token
    const accessToken = generateToken(decoded.userId);

    res.json({
      accessToken
    });

  } catch (error) {
    logger.error('Token refresh error:', error);
    res.status(401).json({
      error: 'Token refresh failed',
      message: 'Invalid or expired refresh token'
    });
  }
};

/**
 * Get user profile
 */
const getProfile = async (req, res) => {
  try {
    const userId = req.user.id;
    
    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User profile not found'
      });
    }

    // Return user data without password
    const { password: _, ...userWithoutPassword } = user;

    res.json(userWithoutPassword);

  } catch (error) {
    logger.error('Get profile error:', error);
    res.status(500).json({
      error: 'Failed to get profile',
      message: error.message
    });
  }
};

/**
 * Update user profile
 */
const updateProfile = async (req, res) => {
  try {
    const userId = req.user.id;
    const { name, email, bio, preferences } = req.body;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User profile not found'
      });
    }

    // Check if email is already taken by another user
    if (email && email !== user.email) {
      const emailExists = userStore.findByEmail(email);
      if (emailExists && emailExists.id !== userId) {
        return res.status(400).json({
          error: 'Email already taken',
          message: 'This email address is already in use'
        });
      }
    }

    // Update user
    const updatedUser = userStore.update(userId, {
      ...(name && { name }),
      ...(email && { email, isEmailVerified: false }), // Reset email verification if email changed
      ...(bio !== undefined && { bio }),
      ...(preferences && { preferences: { ...user.preferences, ...preferences } })
    });

    logger.info(`User profile updated: ${updatedUser.email} (${userId})`);

    // Return user data without password
    const { password: _, ...userWithoutPassword } = updatedUser;

    res.json({
      message: 'Profile updated successfully',
      user: userWithoutPassword
    });

  } catch (error) {
    logger.error('Update profile error:', error);
    res.status(500).json({
      error: 'Failed to update profile',
      message: error.message
    });
  }
};

/**
 * Change user password
 */
const changePassword = async (req, res) => {
  try {
    const userId = req.user.id;
    const { currentPassword, newPassword } = req.body;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User not found'
      });
    }

    // Verify current password
    const isCurrentPasswordValid = await bcrypt.compare(currentPassword, user.password);
    if (!isCurrentPasswordValid) {
      return res.status(400).json({
        error: 'Invalid current password',
        message: 'Current password is incorrect'
      });
    }

    // Hash new password
    const hashedNewPassword = await bcrypt.hash(newPassword, 12);

    // Update password
    userStore.update(userId, {
      password: hashedNewPassword
    });

    logger.info(`Password changed for user: ${user.email} (${userId})`);

    res.json({
      message: 'Password changed successfully'
    });

  } catch (error) {
    logger.error('Change password error:', error);
    res.status(500).json({
      error: 'Failed to change password',
      message: error.message
    });
  }
};

/**
 * Forgot password - send reset email
 */
const forgotPassword = async (req, res) => {
  try {
    const { email } = req.body;

    const user = userStore.findByEmail(email);
    if (!user) {
      // Don't reveal if email exists for security
      return res.json({
        message: 'If an account with that email exists, a password reset link has been sent.'
      });
    }

    // Generate reset token
    const resetToken = generateSecureToken();
    userStore.passwordResetTokens.set(resetToken, {
      userId: user.id,
      expiresAt: new Date(Date.now() + 60 * 60 * 1000) // 1 hour
    });

    // In production, send email with reset link
    logger.info(`Password reset requested for user: ${email}`);

    res.json({
      message: 'If an account with that email exists, a password reset link has been sent.',
      // For development only - remove in production
      resetToken: process.env.NODE_ENV === 'development' ? resetToken : undefined
    });

  } catch (error) {
    logger.error('Forgot password error:', error);
    res.status(500).json({
      error: 'Password reset failed',
      message: error.message
    });
  }
};

/**
 * Reset password with token
 */
const resetPassword = async (req, res) => {
  try {
    const { token, password } = req.body;

    const tokenData = userStore.passwordResetTokens.get(token);
    if (!tokenData) {
      return res.status(400).json({
        error: 'Invalid reset token',
        message: 'Password reset token is invalid or has expired'
      });
    }

    // Check if token has expired
    if (new Date() > new Date(tokenData.expiresAt)) {
      userStore.passwordResetTokens.delete(token);
      return res.status(400).json({
        error: 'Reset token expired',
        message: 'Password reset token has expired'
      });
    }

    const user = userStore.findById(tokenData.userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    // Hash new password
    const hashedPassword = await bcrypt.hash(password, 12);

    // Update password
    userStore.update(user.id, {
      password: hashedPassword
    });

    // Remove reset token
    userStore.passwordResetTokens.delete(token);

    // Revoke all refresh tokens for security
    userStore.refreshTokens.clear();

    logger.info(`Password reset completed for user: ${user.email}`);

    res.json({
      message: 'Password reset successfully'
    });

  } catch (error) {
    logger.error('Reset password error:', error);
    res.status(500).json({
      error: 'Password reset failed',
      message: error.message
    });
  }
};

/**
 * Verify email address
 */
const verifyEmail = async (req, res) => {
  try {
    const { token } = req.body;

    const tokenData = userStore.emailVerificationTokens.get(token);
    if (!tokenData) {
      return res.status(400).json({
        error: 'Invalid verification token',
        message: 'Email verification token is invalid or has expired'
      });
    }

    // Check if token has expired
    if (new Date() > new Date(tokenData.expiresAt)) {
      userStore.emailVerificationTokens.delete(token);
      return res.status(400).json({
        error: 'Verification token expired',
        message: 'Email verification token has expired'
      });
    }

    const user = userStore.findById(tokenData.userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    // Update email verification status
    userStore.update(user.id, {
      isEmailVerified: true
    });

    // Remove verification token
    userStore.emailVerificationTokens.delete(token);

    logger.info(`Email verified for user: ${user.email}`);

    res.json({
      message: 'Email verified successfully'
    });

  } catch (error) {
    logger.error('Email verification error:', error);
    res.status(500).json({
      error: 'Email verification failed',
      message: error.message
    });
  }
};

/**
 * Resend email verification
 */
const resendVerification = async (req, res) => {
  try {
    const userId = req.user.id;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (user.isEmailVerified) {
      return res.status(400).json({
        error: 'Email already verified',
        message: 'Your email address is already verified'
      });
    }

    // Generate new verification token
    const verificationToken = generateSecureToken();
    userStore.emailVerificationTokens.set(verificationToken, {
      userId: user.id,
      expiresAt: new Date(Date.now() + 24 * 60 * 60 * 1000) // 24 hours
    });

    // In production, send verification email
    logger.info(`Email verification resent for user: ${user.email}`);

    res.json({
      message: 'Verification email sent successfully',
      // For development only - remove in production
      verificationToken: process.env.NODE_ENV === 'development' ? verificationToken : undefined
    });

  } catch (error) {
    logger.error('Resend verification error:', error);
    res.status(500).json({
      error: 'Failed to resend verification',
      message: error.message
    });
  }
};

/**
 * Get user's active sessions
 */
const getSessions = async (req, res) => {
  try {
    const userId = req.user.id;

    const sessions = userStore.userSessions.get(userId);

    res.json({
      sessions: sessions.map(session => ({
        id: session.id,
        createdAt: session.createdAt,
        lastActivity: session.lastActivity,
        userAgent: session.userAgent,
        ip: session.ip
      })),
      totalSessions: sessions.length
    });

  } catch (error) {
    logger.error('Get sessions error:', error);
    res.status(500).json({
      error: 'Failed to get sessions',
      message: error.message
    });
  }
};

/**
 * Revoke a specific session
 */
const revokeSession = async (req, res) => {
  try {
    const userId = req.user.id;
    const { sessionId } = req.params;

    userStore.userSessions.removeSession(userId, sessionId);

    logger.info(`Session revoked for user: ${req.user.email} (${sessionId})`);

    res.json({
      message: 'Session revoked successfully'
    });

  } catch (error) {
    logger.error('Revoke session error:', error);
    res.status(500).json({
      error: 'Failed to revoke session',
      message: error.message
    });
  }
};

/**
 * Revoke all sessions except current
 */
const revokeAllSessions = async (req, res) => {
  try {
    const userId = req.user.id;

    // Clear all refresh tokens
    userStore.refreshTokens.clear();

    // Clear all sessions
    userStore.userSessions.delete(userId);

    logger.info(`All sessions revoked for user: ${req.user.email}`);

    res.json({
      message: 'All sessions revoked successfully'
    });

  } catch (error) {
    logger.error('Revoke all sessions error:', error);
    res.status(500).json({
      error: 'Failed to revoke sessions',
      message: error.message
    });
  }
};

/**
 * Enable two-factor authentication
 */
const enable2FA = async (req, res) => {
  try {
    const userId = req.user.id;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (user.twoFactorEnabled) {
      return res.status(400).json({
        error: '2FA already enabled',
        message: 'Two-factor authentication is already enabled for this account'
      });
    }

    // Generate secret and QR code (simplified implementation)
    const secret = generateSecureToken();
    const backupCodes = Array.from({ length: 10 }, () => generateSecureToken().substring(0, 8));

    // Update user with 2FA data
    userStore.update(userId, {
      twoFactorSecret: secret,
      twoFactorBackupCodes: backupCodes,
      twoFactorEnabled: false // Will be enabled after verification
    });

    logger.info(`2FA setup initiated for user: ${user.email}`);

    res.json({
      message: '2FA setup initiated',
      secret,
      backupCodes,
      qrCodeUrl: `otpauth://totp/VisualWebEditor:${user.email}?secret=${secret}&issuer=VisualWebEditor`
    });

  } catch (error) {
    logger.error('Enable 2FA error:', error);
    res.status(500).json({
      error: 'Failed to enable 2FA',
      message: error.message
    });
  }
};

/**
 * Verify two-factor authentication setup
 */
const verify2FA = async (req, res) => {
  try {
    const userId = req.user.id;
    const { token } = req.body;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (!user.twoFactorSecret) {
      return res.status(400).json({
        error: '2FA not initiated',
        message: 'Two-factor authentication setup has not been initiated'
      });
    }

    // Simplified token verification (in production, use proper TOTP verification)
    const isValidToken = token.length === 6 && /^\d+$/.test(token);

    if (!isValidToken) {
      return res.status(400).json({
        error: 'Invalid token',
        message: 'The provided 2FA token is invalid'
      });
    }

    // Enable 2FA
    userStore.update(userId, {
      twoFactorEnabled: true
    });

    logger.info(`2FA enabled for user: ${user.email}`);

    res.json({
      message: 'Two-factor authentication enabled successfully'
    });

  } catch (error) {
    logger.error('Verify 2FA error:', error);
    res.status(500).json({
      error: 'Failed to verify 2FA',
      message: error.message
    });
  }
};

/**
 * Disable two-factor authentication
 */
const disable2FA = async (req, res) => {
  try {
    const userId = req.user.id;
    const { token } = req.body;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (!user.twoFactorEnabled) {
      return res.status(400).json({
        error: '2FA not enabled',
        message: 'Two-factor authentication is not enabled for this account'
      });
    }

    // Simplified token verification
    const isValidToken = token.length === 6 && /^\d+$/.test(token);

    if (!isValidToken) {
      return res.status(400).json({
        error: 'Invalid token',
        message: 'The provided 2FA token is invalid'
      });
    }

    // Disable 2FA
    userStore.update(userId, {
      twoFactorEnabled: false,
      twoFactorSecret: null,
      twoFactorBackupCodes: null
    });

    logger.info(`2FA disabled for user: ${user.email}`);

    res.json({
      message: 'Two-factor authentication disabled successfully'
    });

  } catch (error) {
    logger.error('Disable 2FA error:', error);
    res.status(500).json({
      error: 'Failed to disable 2FA',
      message: error.message
    });
  }
};

/**
 * Get 2FA backup codes
 */
const getBackupCodes = async (req, res) => {
  try {
    const userId = req.user.id;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (!user.twoFactorEnabled) {
      return res.status(400).json({
        error: '2FA not enabled',
        message: 'Two-factor authentication is not enabled for this account'
      });
    }

    res.json({
      backupCodes: user.twoFactorBackupCodes || []
    });

  } catch (error) {
    logger.error('Get backup codes error:', error);
    res.status(500).json({
      error: 'Failed to get backup codes',
      message: error.message
    });
  }
};

/**
 * Regenerate 2FA backup codes
 */
const regenerateBackupCodes = async (req, res) => {
  try {
    const userId = req.user.id;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    if (!user.twoFactorEnabled) {
      return res.status(400).json({
        error: '2FA not enabled',
        message: 'Two-factor authentication is not enabled for this account'
      });
    }

    // Generate new backup codes
    const backupCodes = Array.from({ length: 10 }, () => generateSecureToken().substring(0, 8));

    userStore.update(userId, {
      twoFactorBackupCodes: backupCodes
    });

    logger.info(`2FA backup codes regenerated for user: ${user.email}`);

    res.json({
      message: 'Backup codes regenerated successfully',
      backupCodes
    });

  } catch (error) {
    logger.error('Regenerate backup codes error:', error);
    res.status(500).json({
      error: 'Failed to regenerate backup codes',
      message: error.message
    });
  }
};

/**
 * Delete user account
 */
const deleteAccount = async (req, res) => {
  try {
    const userId = req.user.id;
    const { password, confirmation } = req.body;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    // Verify password
    const isPasswordValid = await bcrypt.compare(password, user.password);
    if (!isPasswordValid) {
      return res.status(400).json({
        error: 'Invalid password',
        message: 'Password is incorrect'
      });
    }

    // Verify confirmation
    if (confirmation !== 'DELETE') {
      return res.status(400).json({
        error: 'Invalid confirmation',
        message: 'Please type "DELETE" to confirm account deletion'
      });
    }

    // Delete user data
    userStore.delete(userId);

    // Clean up related data
    userStore.refreshTokens.clear();
    userStore.userSessions.delete(userId);
    userStore.passwordResetTokens.clear();
    userStore.emailVerificationTokens.clear();

    logger.info(`Account deleted for user: ${user.email} (${userId})`);

    res.json({
      message: 'Account deleted successfully'
    });

  } catch (error) {
    logger.error('Delete account error:', error);
    res.status(500).json({
      error: 'Failed to delete account',
      message: error.message
    });
  }
};

/**
 * Export user data (GDPR compliance)
 */
const exportUserData = async (req, res) => {
  try {
    const userId = req.user.id;

    const user = userStore.findById(userId);
    if (!user) {
      return res.status(404).json({
        error: 'User not found',
        message: 'User account not found'
      });
    }

    // Collect all user data
    const userData = {
      profile: {
        id: user.id,
        email: user.email,
        name: user.name,
        bio: user.bio,
        role: user.role,
        isEmailVerified: user.isEmailVerified,
        twoFactorEnabled: user.twoFactorEnabled,
        preferences: user.preferences,
        createdAt: user.createdAt,
        updatedAt: user.updatedAt
      },
      sessions: userStore.userSessions.get(userId) || [],
      exportedAt: new Date().toISOString(),
      dataRetentionPolicy: 'Data will be retained for 30 days after account deletion for recovery purposes'
    };

    // Set headers for file download
    res.setHeader('Content-Type', 'application/json');
    res.setHeader('Content-Disposition', `attachment; filename="user-data-${user.id}.json"`);

    logger.info(`User data exported for: ${user.email} (${userId})`);

    res.json(userData);

  } catch (error) {
    logger.error('Export user data error:', error);
    res.status(500).json({
      error: 'Failed to export user data',
      message: error.message
    });
  }
};

module.exports = {
  register,
  login,
  logout,
  refreshToken,
  getProfile,
  updateProfile,
  changePassword,
  forgotPassword,
  resetPassword,
  verifyEmail,
  resendVerification,
  getSessions,
  revokeSession,
  revokeAllSessions,
  enable2FA,
  verify2FA,
  disable2FA,
  getBackupCodes,
  regenerateBackupCodes,
  deleteAccount,
  exportUserData
};
