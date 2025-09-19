/**
 * User Store Utility
 * Centralized user storage for the application
 * In production, this would be replaced with a database
 */

const bcrypt = require('bcryptjs');
const { v4: uuidv4 } = require('uuid');
const logger = require('./logger');

// In-memory storage (replace with database in production)
let users = [];
let refreshTokens = new Map();
let passwordResetTokens = new Map();
let emailVerificationTokens = new Map();
let userSessions = new Map();

/**
 * Initialize default admin user
 */
const initializeDefaultAdmin = async () => {
  try {
    const adminExists = users.find(user => user.email === 'admin@visualwebeditor.com');
    if (!adminExists) {
      const hashedPassword = await bcrypt.hash('admin123!', 12);
      const adminUser = {
        id: uuidv4(),
        email: 'admin@visualwebeditor.com',
        name: 'Admin User',
        password: hashedPassword,
        role: 'admin',
        isEmailVerified: true,
        createdAt: new Date().toISOString(),
        updatedAt: new Date().toISOString(),
        preferences: {
          theme: 'light',
          notifications: true,
          autoSave: true
        },
        twoFactorEnabled: false,
        status: 'active'
      };
      
      users.push(adminUser);
      logger.info('Default admin user created: admin@visualwebeditor.com / admin123!');
    }
  } catch (error) {
    logger.error('Failed to initialize default admin:', error);
  }
};

/**
 * User management functions
 */
const userStore = {
  // Get all users
  getAllUsers: () => users,
  
  // Find user by ID
  findById: (id) => users.find(user => user.id === id),
  
  // Find user by email
  findByEmail: (email) => users.find(user => user.email === email),
  
  // Create new user
  create: (userData) => {
    const user = {
      id: uuidv4(),
      ...userData,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
      status: 'active'
    };
    users.push(user);
    return user;
  },
  
  // Update user
  update: (id, updates) => {
    const userIndex = users.findIndex(user => user.id === id);
    if (userIndex === -1) return null;
    
    users[userIndex] = {
      ...users[userIndex],
      ...updates,
      updatedAt: new Date().toISOString()
    };
    
    return users[userIndex];
  },
  
  // Delete user
  delete: (id) => {
    const userIndex = users.findIndex(user => user.id === id);
    if (userIndex === -1) return false;
    
    users.splice(userIndex, 1);
    return true;
  },
  
  // Refresh token management
  refreshTokens: {
    set: (token, data) => refreshTokens.set(token, data),
    get: (token) => refreshTokens.get(token),
    delete: (token) => refreshTokens.delete(token),
    clear: () => refreshTokens.clear()
  },
  
  // Password reset token management
  passwordResetTokens: {
    set: (token, data) => passwordResetTokens.set(token, data),
    get: (token) => passwordResetTokens.get(token),
    delete: (token) => passwordResetTokens.delete(token),
    clear: () => passwordResetTokens.clear()
  },
  
  // Email verification token management
  emailVerificationTokens: {
    set: (token, data) => emailVerificationTokens.set(token, data),
    get: (token) => emailVerificationTokens.get(token),
    delete: (token) => emailVerificationTokens.delete(token),
    clear: () => emailVerificationTokens.clear()
  },
  
  // User session management
  userSessions: {
    set: (userId, sessions) => userSessions.set(userId, sessions),
    get: (userId) => userSessions.get(userId) || [],
    delete: (userId) => userSessions.delete(userId),
    clear: () => userSessions.clear(),
    addSession: (userId, sessionData) => {
      const sessions = userSessions.get(userId) || [];
      sessions.push(sessionData);
      userSessions.set(userId, sessions);
    },
    removeSession: (userId, sessionId) => {
      const sessions = userSessions.get(userId) || [];
      const filteredSessions = sessions.filter(session => session.id !== sessionId);
      userSessions.set(userId, filteredSessions);
    }
  }
};

// Initialize on module load
initializeDefaultAdmin();

module.exports = userStore;
