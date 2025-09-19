/**
 * Logger Utility
 * Winston-based logging system with multiple transports
 */

const winston = require('winston');
const path = require('path');
const fs = require('fs');

// Ensure logs directory exists
const logsDir = path.join(__dirname, '../../logs');
if (!fs.existsSync(logsDir)) {
  fs.mkdirSync(logsDir, { recursive: true });
}

// Custom log format
const logFormat = winston.format.combine(
  winston.format.timestamp({
    format: 'YYYY-MM-DD HH:mm:ss'
  }),
  winston.format.errors({ stack: true }),
  winston.format.json(),
  winston.format.prettyPrint()
);

// Console format for development
const consoleFormat = winston.format.combine(
  winston.format.colorize(),
  winston.format.timestamp({
    format: 'HH:mm:ss'
  }),
  winston.format.printf(({ timestamp, level, message, ...meta }) => {
    let msg = `${timestamp} [${level}]: ${message}`;
    
    // Add metadata if present
    if (Object.keys(meta).length > 0) {
      msg += '\n' + JSON.stringify(meta, null, 2);
    }
    
    return msg;
  })
);

// Create logger instance
const logger = winston.createLogger({
  level: process.env.LOG_LEVEL || 'info',
  format: logFormat,
  defaultMeta: {
    service: 'visual-web-editor-backend',
    version: process.env.npm_package_version || '2.0.0'
  },
  transports: [
    // Error log file
    new winston.transports.File({
      filename: path.join(logsDir, 'error.log'),
      level: 'error',
      maxsize: 5242880, // 5MB
      maxFiles: 5,
      format: winston.format.combine(
        winston.format.timestamp(),
        winston.format.json()
      )
    }),
    
    // Combined log file
    new winston.transports.File({
      filename: path.join(logsDir, 'combined.log'),
      maxsize: 5242880, // 5MB
      maxFiles: 5,
      format: winston.format.combine(
        winston.format.timestamp(),
        winston.format.json()
      )
    }),
    
    // Access log file
    new winston.transports.File({
      filename: path.join(logsDir, 'access.log'),
      level: 'http',
      maxsize: 5242880, // 5MB
      maxFiles: 5,
      format: winston.format.combine(
        winston.format.timestamp(),
        winston.format.json()
      )
    })
  ],
  
  // Handle exceptions and rejections
  exceptionHandlers: [
    new winston.transports.File({
      filename: path.join(logsDir, 'exceptions.log'),
      maxsize: 5242880, // 5MB
      maxFiles: 5
    })
  ],
  
  rejectionHandlers: [
    new winston.transports.File({
      filename: path.join(logsDir, 'rejections.log'),
      maxsize: 5242880, // 5MB
      maxFiles: 5
    })
  ]
});

// Add console transport for development
if (process.env.NODE_ENV !== 'production') {
  logger.add(new winston.transports.Console({
    format: consoleFormat,
    level: 'debug'
  }));
}

// Add console transport for production (errors only)
if (process.env.NODE_ENV === 'production') {
  logger.add(new winston.transports.Console({
    format: winston.format.combine(
      winston.format.timestamp(),
      winston.format.simple()
    ),
    level: 'error'
  }));
}

// Custom logging methods
logger.request = (req, res, responseTime) => {
  logger.http('HTTP Request', {
    method: req.method,
    url: req.url,
    statusCode: res.statusCode,
    responseTime: `${responseTime}ms`,
    ip: req.ip,
    userAgent: req.headers['user-agent'],
    userId: req.user?.id,
    timestamp: new Date().toISOString()
  });
};

logger.security = (event, details) => {
  logger.warn('Security Event', {
    event,
    ...details,
    timestamp: new Date().toISOString()
  });
};

logger.performance = (operation, duration, details = {}) => {
  logger.info('Performance Metric', {
    operation,
    duration: `${duration}ms`,
    ...details,
    timestamp: new Date().toISOString()
  });
};

logger.audit = (action, userId, details = {}) => {
  logger.info('Audit Log', {
    action,
    userId,
    ...details,
    timestamp: new Date().toISOString()
  });
};

logger.database = (operation, query, duration, error = null) => {
  const logData = {
    operation,
    query: typeof query === 'string' ? query : JSON.stringify(query),
    duration: `${duration}ms`,
    timestamp: new Date().toISOString()
  };
  
  if (error) {
    logger.error('Database Error', { ...logData, error: error.message });
  } else {
    logger.debug('Database Operation', logData);
  }
};

logger.ai = (operation, prompt, response, duration, error = null) => {
  const logData = {
    operation,
    prompt: typeof prompt === 'string' ? prompt.substring(0, 100) + '...' : prompt,
    responseLength: response ? response.length : 0,
    duration: `${duration}ms`,
    timestamp: new Date().toISOString()
  };
  
  if (error) {
    logger.error('AI Operation Error', { ...logData, error: error.message });
  } else {
    logger.info('AI Operation', logData);
  }
};

logger.fileOperation = (operation, filePath, size = null, error = null) => {
  const logData = {
    operation,
    filePath,
    ...(size && { size: `${size} bytes` }),
    timestamp: new Date().toISOString()
  };
  
  if (error) {
    logger.error('File Operation Error', { ...logData, error: error.message });
  } else {
    logger.debug('File Operation', logData);
  }
};

// Log rotation cleanup
const cleanupOldLogs = () => {
  const maxAge = 30 * 24 * 60 * 60 * 1000; // 30 days
  const now = Date.now();
  
  try {
    const files = fs.readdirSync(logsDir);
    
    files.forEach(file => {
      const filePath = path.join(logsDir, file);
      const stats = fs.statSync(filePath);
      
      if (now - stats.mtime.getTime() > maxAge) {
        fs.unlinkSync(filePath);
        logger.info(`Cleaned up old log file: ${file}`);
      }
    });
  } catch (error) {
    logger.error('Log cleanup error:', error);
  }
};

// Run cleanup daily
setInterval(cleanupOldLogs, 24 * 60 * 60 * 1000);

// Stream for Morgan HTTP logging
logger.stream = {
  write: (message) => {
    logger.http(message.trim());
  }
};

// Graceful shutdown
process.on('SIGINT', () => {
  logger.info('Received SIGINT, shutting down gracefully');
  logger.end();
});

process.on('SIGTERM', () => {
  logger.info('Received SIGTERM, shutting down gracefully');
  logger.end();
});

module.exports = logger;
