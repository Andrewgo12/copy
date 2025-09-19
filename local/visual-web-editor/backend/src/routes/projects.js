/**
 * Projects Routes
 * Handles all project-related API endpoints
 */

const express = require('express');
const { body, param, query, validationResult } = require('express-validator');
const multer = require('multer');
const path = require('path');
const fs = require('fs-extra');
const archiver = require('archiver');
const { v4: uuidv4 } = require('uuid');

const projectController = require('../controllers/projectController');
const authMiddleware = require('../middleware/auth');
const logger = require('../utils/logger');

const router = express.Router();

// Configure multer for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    const uploadPath = path.join(__dirname, '../../uploads/projects');
    fs.ensureDirSync(uploadPath);
    cb(null, uploadPath);
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    cb(null, file.fieldname + '-' + uniqueSuffix + path.extname(file.originalname));
  }
});

const upload = multer({
  storage: storage,
  limits: {
    fileSize: 10 * 1024 * 1024, // 10MB limit
    files: 5
  },
  fileFilter: (req, file, cb) => {
    // Allow images and JSON files
    const allowedTypes = /jpeg|jpg|png|gif|svg|json/;
    const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
    const mimetype = allowedTypes.test(file.mimetype);

    if (mimetype && extname) {
      return cb(null, true);
    } else {
      cb(new Error('Only images and JSON files are allowed'));
    }
  }
});

// Validation middleware
const validateProject = [
  body('name')
    .trim()
    .isLength({ min: 1, max: 100 })
    .withMessage('Project name must be between 1 and 100 characters'),
  body('description')
    .optional()
    .trim()
    .isLength({ max: 500 })
    .withMessage('Description must be less than 500 characters'),
  body('elements')
    .optional()
    .isArray()
    .withMessage('Elements must be an array'),
  body('settings')
    .optional()
    .isObject()
    .withMessage('Settings must be an object')
];

const validateProjectId = [
  param('id')
    .isUUID()
    .withMessage('Invalid project ID format')
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
 * GET /api/projects
 * Get all projects with optional filtering and pagination
 */
router.get('/', [
  query('page').optional().isInt({ min: 1 }).withMessage('Page must be a positive integer'),
  query('limit').optional().isInt({ min: 1, max: 100 }).withMessage('Limit must be between 1 and 100'),
  query('sort').optional().isIn(['name', 'createdAt', 'updatedAt']).withMessage('Invalid sort field'),
  query('order').optional().isIn(['asc', 'desc']).withMessage('Order must be asc or desc'),
  query('search').optional().trim().isLength({ max: 100 }).withMessage('Search term too long'),
  checkValidation
], projectController.getAllProjects);

/**
 * GET /api/projects/:id
 * Get a specific project by ID
 */
router.get('/:id', [
  ...validateProjectId,
  checkValidation
], projectController.getProjectById);

/**
 * POST /api/projects
 * Create a new project
 */
router.post('/', [
  ...validateProject,
  checkValidation
], projectController.createProject);

/**
 * PUT /api/projects/:id
 * Update an existing project
 */
router.put('/:id', [
  ...validateProjectId,
  ...validateProject,
  checkValidation
], projectController.updateProject);

/**
 * DELETE /api/projects/:id
 * Delete a project
 */
router.delete('/:id', [
  ...validateProjectId,
  checkValidation
], projectController.deleteProject);

/**
 * POST /api/projects/:id/duplicate
 * Duplicate a project
 */
router.post('/:id/duplicate', [
  ...validateProjectId,
  body('name')
    .optional()
    .trim()
    .isLength({ min: 1, max: 100 })
    .withMessage('Project name must be between 1 and 100 characters'),
  checkValidation
], projectController.duplicateProject);

/**
 * GET /api/projects/:id/export
 * Export project as JSON
 */
router.get('/:id/export', [
  ...validateProjectId,
  checkValidation
], projectController.exportProject);

/**
 * POST /api/projects/import
 * Import project from JSON file
 */
router.post('/import', 
  upload.single('project'),
  projectController.importProject
);

/**
 * GET /api/projects/:id/code
 * Generate code for project
 */
router.get('/:id/code', [
  ...validateProjectId,
  query('framework').optional().isIn(['react', 'vue', 'angular']).withMessage('Invalid framework'),
  query('styling').optional().isIn(['tailwind', 'css', 'styled-components']).withMessage('Invalid styling option'),
  query('typescript').optional().isBoolean().withMessage('TypeScript flag must be boolean'),
  checkValidation
], projectController.generateCode);

/**
 * POST /api/projects/:id/assets
 * Upload assets for a project
 */
router.post('/:id/assets', [
  ...validateProjectId,
  checkValidation
], upload.array('assets', 10), projectController.uploadAssets);

/**
 * GET /api/projects/:id/assets
 * Get project assets
 */
router.get('/:id/assets', [
  ...validateProjectId,
  checkValidation
], projectController.getProjectAssets);

/**
 * DELETE /api/projects/:id/assets/:assetId
 * Delete a project asset
 */
router.delete('/:id/assets/:assetId', [
  ...validateProjectId,
  param('assetId').isUUID().withMessage('Invalid asset ID'),
  checkValidation
], projectController.deleteAsset);

/**
 * POST /api/projects/:id/share
 * Generate shareable link for project
 */
router.post('/:id/share', [
  ...validateProjectId,
  body('permissions')
    .optional()
    .isIn(['view', 'edit'])
    .withMessage('Permissions must be view or edit'),
  body('expiresAt')
    .optional()
    .isISO8601()
    .withMessage('Invalid expiration date'),
  checkValidation
], projectController.shareProject);

/**
 * GET /api/projects/shared/:shareId
 * Access shared project
 */
router.get('/shared/:shareId', [
  param('shareId').isUUID().withMessage('Invalid share ID'),
  checkValidation
], projectController.getSharedProject);

/**
 * POST /api/projects/:id/backup
 * Create project backup
 */
router.post('/:id/backup', [
  ...validateProjectId,
  checkValidation
], projectController.createBackup);

/**
 * GET /api/projects/:id/backups
 * Get project backups
 */
router.get('/:id/backups', [
  ...validateProjectId,
  checkValidation
], projectController.getBackups);

/**
 * POST /api/projects/:id/restore/:backupId
 * Restore project from backup
 */
router.post('/:id/restore/:backupId', [
  ...validateProjectId,
  param('backupId').isUUID().withMessage('Invalid backup ID'),
  checkValidation
], projectController.restoreBackup);

/**
 * GET /api/projects/:id/analytics
 * Get project analytics
 */
router.get('/:id/analytics', [
  ...validateProjectId,
  query('period').optional().isIn(['day', 'week', 'month', 'year']).withMessage('Invalid period'),
  checkValidation
], projectController.getProjectAnalytics);

/**
 * POST /api/projects/:id/collaborate
 * Add collaborator to project
 */
router.post('/:id/collaborate', [
  ...validateProjectId,
  body('email').isEmail().withMessage('Valid email required'),
  body('role').isIn(['viewer', 'editor', 'admin']).withMessage('Invalid role'),
  checkValidation
], projectController.addCollaborator);

/**
 * GET /api/projects/:id/collaborators
 * Get project collaborators
 */
router.get('/:id/collaborators', [
  ...validateProjectId,
  checkValidation
], projectController.getCollaborators);

/**
 * DELETE /api/projects/:id/collaborators/:userId
 * Remove collaborator from project
 */
router.delete('/:id/collaborators/:userId', [
  ...validateProjectId,
  param('userId').isUUID().withMessage('Invalid user ID'),
  checkValidation
], projectController.removeCollaborator);

// Error handling for multer
router.use((error, req, res, next) => {
  if (error instanceof multer.MulterError) {
    if (error.code === 'LIMIT_FILE_SIZE') {
      return res.status(400).json({
        error: 'File too large',
        message: 'File size must be less than 10MB'
      });
    }
    if (error.code === 'LIMIT_FILE_COUNT') {
      return res.status(400).json({
        error: 'Too many files',
        message: 'Maximum 10 files allowed'
      });
    }
  }
  
  if (error.message === 'Only images and JSON files are allowed') {
    return res.status(400).json({
      error: 'Invalid file type',
      message: error.message
    });
  }
  
  next(error);
});

module.exports = router;
