/**
 * AI Routes
 * Handles AI agent integration and AI-powered features
 */

const express = require('express');
const { body, query, validationResult } = require('express-validator');
const multer = require('multer');
const path = require('path');
const fs = require('fs-extra');

const aiController = require('../controllers/aiController');
const authMiddleware = require('../middleware/auth');
const logger = require('../utils/logger');

const router = express.Router();

// Configure multer for image uploads (for visual replication)
const storage = multer.memoryStorage();
const upload = multer({
  storage: storage,
  limits: {
    fileSize: 5 * 1024 * 1024, // 5MB limit for images
    files: 1
  },
  fileFilter: (req, file, cb) => {
    const allowedTypes = /jpeg|jpg|png|gif|webp/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);

    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb(new Error('Only image files are allowed'));
    }
  }
});

// Validation middleware
const validateChatRequest = [
  body('message')
    .trim()
    .isLength({ min: 1, max: 2000 })
    .withMessage('Message must be between 1 and 2000 characters'),
  body('context')
    .optional()
    .isObject()
    .withMessage('Context must be an object'),
  body('elements')
    .optional()
    .isArray()
    .withMessage('Elements must be an array')
];

const validateGenerateRequest = [
  body('prompt')
    .trim()
    .isLength({ min: 1, max: 1000 })
    .withMessage('Prompt must be between 1 and 1000 characters'),
  body('type')
    .optional()
    .isIn(['component', 'layout', 'page', 'form'])
    .withMessage('Invalid generation type'),
  body('framework')
    .optional()
    .isIn(['react', 'vue', 'angular'])
    .withMessage('Invalid framework'),
  body('styling')
    .optional()
    .isIn(['tailwind', 'css', 'styled-components'])
    .withMessage('Invalid styling option')
];

const validateImproveRequest = [
  body('elements')
    .isArray()
    .withMessage('Elements array is required'),
  body('feedback')
    .optional()
    .trim()
    .isLength({ max: 1000 })
    .withMessage('Feedback must be less than 1000 characters'),
  body('goals')
    .optional()
    .isArray()
    .withMessage('Goals must be an array')
];

const validateReplicateRequest = [
  body('accuracy_target')
    .optional()
    .isFloat({ min: 0.5, max: 1.0 })
    .withMessage('Accuracy target must be between 0.5 and 1.0'),
  body('target_framework')
    .optional()
    .isIn(['react', 'vue', 'angular'])
    .withMessage('Invalid target framework')
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
 * POST /api/ai/chat
 * General AI chat for design assistance
 */
router.post('/chat', [
  ...validateChatRequest,
  checkValidation
], aiController.chat);

/**
 * POST /api/ai/generate
 * Generate components from text descriptions
 */
router.post('/generate', [
  ...validateGenerateRequest,
  checkValidation
], aiController.generateComponent);

/**
 * POST /api/ai/improve
 * Get AI suggestions to improve existing design
 */
router.post('/improve', [
  ...validateImproveRequest,
  checkValidation
], aiController.improveDesign);

/**
 * POST /api/ai/replicate
 * Replicate design from uploaded image
 */
router.post('/replicate', 
  upload.single('image'),
  [
    ...validateReplicateRequest,
    checkValidation
  ],
  aiController.replicateDesign
);

/**
 * POST /api/ai/analyze
 * Analyze design for accessibility, performance, and UX
 */
router.post('/analyze', [
  body('elements')
    .isArray()
    .withMessage('Elements array is required'),
  body('analysis_type')
    .optional()
    .isIn(['accessibility', 'performance', 'ux', 'all'])
    .withMessage('Invalid analysis type'),
  checkValidation
], aiController.analyzeDesign);

/**
 * POST /api/ai/optimize
 * Optimize design for specific goals
 */
router.post('/optimize', [
  body('elements')
    .isArray()
    .withMessage('Elements array is required'),
  body('optimization_goals')
    .isArray()
    .withMessage('Optimization goals array is required'),
  body('constraints')
    .optional()
    .isObject()
    .withMessage('Constraints must be an object'),
  checkValidation
], aiController.optimizeDesign);

/**
 * POST /api/ai/suggest
 * Get AI suggestions for next steps
 */
router.post('/suggest', [
  body('current_state')
    .isObject()
    .withMessage('Current state object is required'),
  body('user_intent')
    .optional()
    .trim()
    .isLength({ max: 500 })
    .withMessage('User intent must be less than 500 characters'),
  checkValidation
], aiController.getSuggestions);

/**
 * POST /api/ai/code
 * Generate production-ready code
 */
router.post('/code', [
  body('elements')
    .isArray()
    .withMessage('Elements array is required'),
  body('options')
    .optional()
    .isObject()
    .withMessage('Options must be an object'),
  checkValidation
], aiController.generateCode);

/**
 * POST /api/ai/refactor
 * Refactor existing code with AI suggestions
 */
router.post('/refactor', [
  body('code')
    .trim()
    .isLength({ min: 1, max: 50000 })
    .withMessage('Code must be between 1 and 50000 characters'),
  body('refactor_goals')
    .isArray()
    .withMessage('Refactor goals array is required'),
  body('framework')
    .optional()
    .isIn(['react', 'vue', 'angular'])
    .withMessage('Invalid framework'),
  checkValidation
], aiController.refactorCode);

/**
 * POST /api/ai/explain
 * Get AI explanation of design decisions
 */
router.post('/explain', [
  body('elements')
    .isArray()
    .withMessage('Elements array is required'),
  body('question')
    .optional()
    .trim()
    .isLength({ max: 500 })
    .withMessage('Question must be less than 500 characters'),
  checkValidation
], aiController.explainDesign);

/**
 * GET /api/ai/templates
 * Get AI-generated templates
 */
router.get('/templates', [
  query('category')
    .optional()
    .isIn(['landing', 'dashboard', 'ecommerce', 'blog', 'portfolio'])
    .withMessage('Invalid template category'),
  query('style')
    .optional()
    .isIn(['modern', 'classic', 'minimal', 'bold'])
    .withMessage('Invalid template style'),
  query('framework')
    .optional()
    .isIn(['react', 'vue', 'angular'])
    .withMessage('Invalid framework'),
  checkValidation
], aiController.getTemplates);

/**
 * POST /api/ai/customize-template
 * Customize AI template based on requirements
 */
router.post('/customize-template', [
  body('template_id')
    .isUUID()
    .withMessage('Valid template ID is required'),
  body('customizations')
    .isObject()
    .withMessage('Customizations object is required'),
  body('brand_guidelines')
    .optional()
    .isObject()
    .withMessage('Brand guidelines must be an object'),
  checkValidation
], aiController.customizeTemplate);

/**
 * POST /api/ai/feedback
 * Provide feedback on AI suggestions
 */
router.post('/feedback', [
  body('suggestion_id')
    .isUUID()
    .withMessage('Valid suggestion ID is required'),
  body('rating')
    .isInt({ min: 1, max: 5 })
    .withMessage('Rating must be between 1 and 5'),
  body('feedback')
    .optional()
    .trim()
    .isLength({ max: 1000 })
    .withMessage('Feedback must be less than 1000 characters'),
  checkValidation
], aiController.provideFeedback);

/**
 * GET /api/ai/status
 * Get AI agent status and capabilities
 */
router.get('/status', aiController.getAIStatus);

/**
 * POST /api/ai/train
 * Train AI with user preferences (admin only)
 */
router.post('/train', [
  // authMiddleware.requireAdmin, // Uncomment when auth is implemented
  body('training_data')
    .isArray()
    .withMessage('Training data array is required'),
  body('model_type')
    .isIn(['design', 'code', 'optimization'])
    .withMessage('Invalid model type'),
  checkValidation
], aiController.trainModel);

/**
 * GET /api/ai/metrics
 * Get AI performance metrics (admin only)
 */
router.get('/metrics', [
  // authMiddleware.requireAdmin, // Uncomment when auth is implemented
  query('period')
    .optional()
    .isIn(['hour', 'day', 'week', 'month'])
    .withMessage('Invalid period'),
  checkValidation
], aiController.getMetrics);

// Error handling for multer
router.use((error, req, res, next) => {
  if (error instanceof multer.MulterError) {
    if (error.code === 'LIMIT_FILE_SIZE') {
      return res.status(400).json({
        error: 'File too large',
        message: 'Image size must be less than 5MB'
      });
    }
  }
  
  if (error.message === 'Only image files are allowed') {
    return res.status(400).json({
      error: 'Invalid file type',
      message: error.message
    });
  }
  
  next(error);
});

module.exports = router;
