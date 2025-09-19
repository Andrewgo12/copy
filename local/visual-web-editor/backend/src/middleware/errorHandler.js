/**
 * Global Error Handler Middleware
 * Handles all errors in the application
 */

const logger = require('../utils/logger');

/**
 * Development error response
 */
const sendErrorDev = (err, res) => {
  res.status(err.statusCode || 500).json({
    status: 'error',
    error: err,
    message: err.message,
    stack: err.stack,
    timestamp: new Date().toISOString()
  });
};

/**
 * Production error response
 */
const sendErrorProd = (err, res) => {
  // Operational, trusted error: send message to client
  if (err.isOperational) {
    res.status(err.statusCode || 500).json({
      status: 'error',
      message: err.message,
      timestamp: new Date().toISOString()
    });
  } else {
    // Programming or other unknown error: don't leak error details
    logger.error('ERROR:', err);
    
    res.status(500).json({
      status: 'error',
      message: 'Something went wrong!',
      timestamp: new Date().toISOString()
    });
  }
};

/**
 * Handle cast errors (invalid IDs)
 */
const handleCastErrorDB = (err) => {
  const message = `Invalid ${err.path}: ${err.value}`;
  return new AppError(message, 400);
};

/**
 * Handle duplicate field errors
 */
const handleDuplicateFieldsDB = (err) => {
  const value = err.errmsg?.match(/(["'])(\\?.)*?\1/)?.[0];
  const message = `Duplicate field value: ${value}. Please use another value!`;
  return new AppError(message, 400);
};

/**
 * Handle validation errors
 */
const handleValidationErrorDB = (err) => {
  const errors = Object.values(err.errors).map(el => el.message);
  const message = `Invalid input data. ${errors.join('. ')}`;
  return new AppError(message, 400);
};

/**
 * Handle JWT errors
 */
const handleJWTError = () =>
  new AppError('Invalid token. Please log in again!', 401);

/**
 * Handle JWT expired errors
 */
const handleJWTExpiredError = () =>
  new AppError('Your token has expired! Please log in again.', 401);

/**
 * Handle multer errors
 */
const handleMulterError = (err) => {
  if (err.code === 'LIMIT_FILE_SIZE') {
    return new AppError('File too large', 400);
  }
  if (err.code === 'LIMIT_FILE_COUNT') {
    return new AppError('Too many files', 400);
  }
  if (err.code === 'LIMIT_UNEXPECTED_FILE') {
    return new AppError('Unexpected file field', 400);
  }
  return new AppError('File upload error', 400);
};

/**
 * Custom Application Error class
 */
class AppError extends Error {
  constructor(message, statusCode) {
    super(message);
    
    this.statusCode = statusCode;
    this.status = `${statusCode}`.startsWith('4') ? 'fail' : 'error';
    this.isOperational = true;
    
    Error.captureStackTrace(this, this.constructor);
  }
}

/**
 * Main error handling middleware
 */
const errorHandler = (err, req, res, next) => {
  err.statusCode = err.statusCode || 500;
  err.status = err.status || 'error';

  // Log error
  logger.error('Error occurred:', {
    message: err.message,
    stack: err.stack,
    statusCode: err.statusCode,
    url: req.url,
    method: req.method,
    ip: req.ip,
    userAgent: req.headers['user-agent'],
    userId: req.user?.id,
    timestamp: new Date().toISOString()
  });

  if (process.env.NODE_ENV === 'development') {
    sendErrorDev(err, res);
  } else {
    let error = { ...err };
    error.message = err.message;

    // Handle specific error types
    if (error.name === 'CastError') error = handleCastErrorDB(error);
    if (error.code === 11000) error = handleDuplicateFieldsDB(error);
    if (error.name === 'ValidationError') error = handleValidationErrorDB(error);
    if (error.name === 'JsonWebTokenError') error = handleJWTError();
    if (error.name === 'TokenExpiredError') error = handleJWTExpiredError();
    if (error.name === 'MulterError') error = handleMulterError(error);

    sendErrorProd(error, res);
  }
};

/**
 * Handle 404 errors for undefined routes
 */
const notFound = (req, res, next) => {
  const err = new AppError(`Can't find ${req.originalUrl} on this server!`, 404);
  next(err);
};

/**
 * Async error wrapper
 */
const catchAsync = (fn) => {
  return (req, res, next) => {
    fn(req, res, next).catch(next);
  };
};

/**
 * Validation error handler
 */
const handleValidationError = (errors) => {
  const formattedErrors = errors.array().map(error => ({
    field: error.param,
    message: error.msg,
    value: error.value
  }));

  return new AppError(`Validation failed: ${formattedErrors.map(e => e.message).join(', ')}`, 400);
};

/**
 * Rate limit error handler
 */
const handleRateLimitError = (req, res) => {
  logger.warn('Rate limit exceeded:', {
    ip: req.ip,
    url: req.url,
    method: req.method,
    userAgent: req.headers['user-agent'],
    timestamp: new Date().toISOString()
  });

  res.status(429).json({
    status: 'error',
    message: 'Too many requests from this IP, please try again later.',
    timestamp: new Date().toISOString()
  });
};

/**
 * CORS error handler
 */
const handleCORSError = (err, req, res, next) => {
  if (err.message && err.message.includes('CORS')) {
    return res.status(403).json({
      status: 'error',
      message: 'CORS policy violation',
      timestamp: new Date().toISOString()
    });
  }
  next(err);
};

/**
 * Database connection error handler
 */
const handleDBError = (err, req, res, next) => {
  if (err.name === 'MongoError' || err.name === 'MongooseError') {
    logger.error('Database error:', err);
    return res.status(503).json({
      status: 'error',
      message: 'Database service temporarily unavailable',
      timestamp: new Date().toISOString()
    });
  }
  next(err);
};

/**
 * File system error handler
 */
const handleFileSystemError = (err, req, res, next) => {
  if (err.code === 'ENOENT') {
    return res.status(404).json({
      status: 'error',
      message: 'File not found',
      timestamp: new Date().toISOString()
    });
  }
  
  if (err.code === 'EACCES') {
    return res.status(403).json({
      status: 'error',
      message: 'File access denied',
      timestamp: new Date().toISOString()
    });
  }
  
  if (err.code === 'ENOSPC') {
    return res.status(507).json({
      status: 'error',
      message: 'Insufficient storage space',
      timestamp: new Date().toISOString()
    });
  }
  
  next(err);
};

/**
 * Timeout error handler
 */
const handleTimeoutError = (err, req, res, next) => {
  if (err.code === 'ETIMEDOUT' || err.message.includes('timeout')) {
    return res.status(408).json({
      status: 'error',
      message: 'Request timeout',
      timestamp: new Date().toISOString()
    });
  }
  next(err);
};

module.exports = {
  errorHandler,
  notFound,
  catchAsync,
  AppError,
  handleValidationError,
  handleRateLimitError,
  handleCORSError,
  handleDBError,
  handleFileSystemError,
  handleTimeoutError
};
