/**
 * Authentication Routes
 * Handles user authentication and authorization
 */

const express = require('express');
const { body, validationResult } = require('express-validator');
const rateLimit = require('express-rate-limit');

const authController = require('../controllers/authController');
const authMiddleware = require('../middleware/auth');

const router = express.Router();

// Rate limiting for auth endpoints
const authLimiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 5, // Limit each IP to 5 requests per windowMs for auth endpoints
  message: {
    error: 'Too many authentication attempts, please try again later.',
    retryAfter: '15 minutes'
  },
  standardHeaders: true,
  legacyHeaders: false
});

// Validation middleware
const validateRegister = [
  body('email')
    .isEmail()
    .normalizeEmail()
    .withMessage('Valid email is required'),
  body('password')
    .isLength({ min: 8, max: 128 })
    .withMessage('Password must be between 8 and 128 characters')
    .matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/)
    .withMessage('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character'),
  body('name')
    .trim()
    .isLength({ min: 2, max: 50 })
    .withMessage('Name must be between 2 and 50 characters')
    .matches(/^[a-zA-Z\s]+$/)
    .withMessage('Name can only contain letters and spaces'),
  body('confirmPassword')
    .custom((value, { req }) => {
      if (value !== req.body.password) {
        throw new Error('Password confirmation does not match password');
      }
      return true;
    })
];

const validateLogin = [
  body('email')
    .isEmail()
    .normalizeEmail()
    .withMessage('Valid email is required'),
  body('password')
    .isLength({ min: 1 })
    .withMessage('Password is required')
];

const validateForgotPassword = [
  body('email')
    .isEmail()
    .normalizeEmail()
    .withMessage('Valid email is required')
];

const validateResetPassword = [
  body('token')
    .isLength({ min: 1 })
    .withMessage('Reset token is required'),
  body('password')
    .isLength({ min: 8, max: 128 })
    .withMessage('Password must be between 8 and 128 characters')
    .matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/)
    .withMessage('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character')
];

const validateChangePassword = [
  body('currentPassword')
    .isLength({ min: 1 })
    .withMessage('Current password is required'),
  body('newPassword')
    .isLength({ min: 8, max: 128 })
    .withMessage('New password must be between 8 and 128 characters')
    .matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/)
    .withMessage('New password must contain at least one lowercase letter, one uppercase letter, one number, and one special character')
];

const validateUpdateProfile = [
  body('name')
    .optional()
    .trim()
    .isLength({ min: 2, max: 50 })
    .withMessage('Name must be between 2 and 50 characters')
    .matches(/^[a-zA-Z\s]+$/)
    .withMessage('Name can only contain letters and spaces'),
  body('email')
    .optional()
    .isEmail()
    .normalizeEmail()
    .withMessage('Valid email is required'),
  body('bio')
    .optional()
    .trim()
    .isLength({ max: 500 })
    .withMessage('Bio must be less than 500 characters'),
  body('preferences')
    .optional()
    .isObject()
    .withMessage('Preferences must be an object')
];

// Middleware to check validation results
const checkValidation = (req, res, next) => {
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    return res.status(400).json({
      error: 'Validation failed',
      details: errors.array()
    });
  }
  next();
};

// Routes

/**
 * POST /api/auth/register
 * Register a new user
 */
router.post('/register', [
  authLimiter,
  ...validateRegister,
  checkValidation
], authController.register);

/**
 * POST /api/auth/login
 * Login user
 */
router.post('/login', [
  authLimiter,
  ...validateLogin,
  checkValidation
], authController.login);

/**
 * POST /api/auth/logout
 * Logout user (invalidate token)
 */
router.post('/logout', authMiddleware.authenticate, authController.logout);

/**
 * POST /api/auth/refresh
 * Refresh access token
 */
router.post('/refresh', authController.refreshToken);

/**
 * GET /api/auth/me
 * Get current user profile
 */
router.get('/me', authMiddleware.authenticate, authController.getProfile);

/**
 * PUT /api/auth/me
 * Update user profile
 */
router.put('/me', [
  authMiddleware.authenticate,
  ...validateUpdateProfile,
  checkValidation
], authController.updateProfile);

/**
 * POST /api/auth/change-password
 * Change user password
 */
router.post('/change-password', [
  authMiddleware.authenticate,
  ...validateChangePassword,
  checkValidation
], authController.changePassword);

/**
 * POST /api/auth/forgot-password
 * Request password reset
 */
router.post('/forgot-password', [
  authLimiter,
  ...validateForgotPassword,
  checkValidation
], authController.forgotPassword);

/**
 * POST /api/auth/reset-password
 * Reset password with token
 */
router.post('/reset-password', [
  authLimiter,
  ...validateResetPassword,
  checkValidation
], authController.resetPassword);

/**
 * POST /api/auth/verify-email
 * Verify email address
 */
router.post('/verify-email', [
  body('token').isLength({ min: 1 }).withMessage('Verification token is required'),
  checkValidation
], authController.verifyEmail);

/**
 * POST /api/auth/resend-verification
 * Resend email verification
 */
router.post('/resend-verification', [
  authLimiter,
  authMiddleware.authenticate
], authController.resendVerification);

/**
 * GET /api/auth/sessions
 * Get user's active sessions
 */
router.get('/sessions', authMiddleware.authenticate, authController.getSessions);

/**
 * DELETE /api/auth/sessions/:sessionId
 * Revoke a specific session
 */
router.delete('/sessions/:sessionId', [
  authMiddleware.authenticate,
  body('sessionId').isUUID().withMessage('Valid session ID is required'),
  checkValidation
], authController.revokeSession);

/**
 * DELETE /api/auth/sessions
 * Revoke all sessions except current
 */
router.delete('/sessions', authMiddleware.authenticate, authController.revokeAllSessions);

/**
 * POST /api/auth/enable-2fa
 * Enable two-factor authentication
 */
router.post('/enable-2fa', authMiddleware.authenticate, authController.enable2FA);

/**
 * POST /api/auth/verify-2fa
 * Verify two-factor authentication setup
 */
router.post('/verify-2fa', [
  authMiddleware.authenticate,
  body('token').isLength({ min: 6, max: 6 }).withMessage('2FA token must be 6 digits'),
  checkValidation
], authController.verify2FA);

/**
 * POST /api/auth/disable-2fa
 * Disable two-factor authentication
 */
router.post('/disable-2fa', [
  authMiddleware.authenticate,
  body('token').isLength({ min: 6, max: 6 }).withMessage('2FA token must be 6 digits'),
  checkValidation
], authController.disable2FA);

/**
 * GET /api/auth/backup-codes
 * Get 2FA backup codes
 */
router.get('/backup-codes', authMiddleware.authenticate, authController.getBackupCodes);

/**
 * POST /api/auth/regenerate-backup-codes
 * Regenerate 2FA backup codes
 */
router.post('/regenerate-backup-codes', authMiddleware.authenticate, authController.regenerateBackupCodes);

/**
 * DELETE /api/auth/account
 * Delete user account
 */
router.delete('/account', [
  authMiddleware.authenticate,
  body('password').isLength({ min: 1 }).withMessage('Password is required for account deletion'),
  body('confirmation').equals('DELETE').withMessage('Confirmation must be "DELETE"'),
  checkValidation
], authController.deleteAccount);

/**
 * GET /api/auth/export-data
 * Export user data (GDPR compliance)
 */
router.get('/export-data', authMiddleware.authenticate, authController.exportUserData);

module.exports = router;
