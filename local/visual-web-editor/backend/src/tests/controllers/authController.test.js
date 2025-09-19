/**
 * Auth Controller Tests
 * Unit tests for authentication functionality
 */

const request = require('supertest');
const app = require('../../server');
const userStore = require('../../utils/userStore');

// Mock logger
jest.mock('../../utils/logger', () => ({
  info: jest.fn(),
  error: jest.fn(),
  warn: jest.fn(),
  debug: jest.fn()
}));

describe('Auth Controller', () => {
  beforeEach(() => {
    // Clear user store before each test
    const users = userStore.getAllUsers();
    users.forEach(user => {
      if (user.email !== 'admin@visualwebeditor.com') {
        userStore.delete(user.id);
      }
    });
    userStore.refreshTokens.clear();
    userStore.passwordResetTokens.clear();
    userStore.emailVerificationTokens.clear();
  });

  describe('POST /api/auth/register', () => {
    test('should register a new user successfully', async () => {
      const userData = {
        email: 'test@example.com',
        password: 'TestPassword123!',
        name: 'Test User',
        confirmPassword: 'TestPassword123!'
      };

      const response = await request(app)
        .post('/api/auth/register')
        .send(userData)
        .expect(201);

      expect(response.body).toHaveProperty('message', 'User registered successfully');
      expect(response.body).toHaveProperty('user');
      expect(response.body).toHaveProperty('tokens');
      expect(response.body.user).toHaveProperty('email', userData.email);
      expect(response.body.user).toHaveProperty('name', userData.name);
      expect(response.body.user).not.toHaveProperty('password');
      expect(response.body.tokens).toHaveProperty('accessToken');
      expect(response.body.tokens).toHaveProperty('refreshToken');
    });

    test('should reject registration with existing email', async () => {
      const userData = {
        email: 'admin@visualwebeditor.com', // Already exists
        password: 'TestPassword123!',
        name: 'Test User',
        confirmPassword: 'TestPassword123!'
      };

      const response = await request(app)
        .post('/api/auth/register')
        .send(userData)
        .expect(400);

      expect(response.body).toHaveProperty('error', 'User already exists');
    });

    test('should reject registration with invalid data', async () => {
      const userData = {
        email: 'invalid-email',
        password: '123', // Too short
        name: '',
        confirmPassword: '456' // Doesn't match
      };

      const response = await request(app)
        .post('/api/auth/register')
        .send(userData)
        .expect(400);

      expect(response.body).toHaveProperty('error');
    });
  });

  describe('POST /api/auth/login', () => {
    test('should login with valid credentials', async () => {
      // First register a user
      const userData = {
        email: 'login-test@example.com',
        password: 'TestPassword123!',
        name: 'Login Test User',
        confirmPassword: 'TestPassword123!'
      };

      await request(app)
        .post('/api/auth/register')
        .send(userData);

      // Then login
      const loginData = {
        email: userData.email,
        password: userData.password
      };

      const response = await request(app)
        .post('/api/auth/login')
        .send(loginData)
        .expect(200);

      expect(response.body).toHaveProperty('message', 'Login successful');
      expect(response.body).toHaveProperty('user');
      expect(response.body).toHaveProperty('tokens');
      expect(response.body.tokens).toHaveProperty('accessToken');
      expect(response.body.tokens).toHaveProperty('refreshToken');
      expect(response.body).toHaveProperty('sessionId');
    });

    test('should reject login with invalid credentials', async () => {
      const loginData = {
        email: 'nonexistent@example.com',
        password: 'wrongpassword'
      };

      const response = await request(app)
        .post('/api/auth/login')
        .send(loginData)
        .expect(401);

      expect(response.body).toHaveProperty('error', 'Invalid credentials');
    });

    test('should login with admin credentials', async () => {
      const loginData = {
        email: 'admin@visualwebeditor.com',
        password: 'admin123!'
      };

      const response = await request(app)
        .post('/api/auth/login')
        .send(loginData)
        .expect(200);

      expect(response.body.user).toHaveProperty('role', 'admin');
    });
  });

  describe('GET /api/auth/me', () => {
    let authToken;

    beforeEach(async () => {
      // Register and login to get token
      const userData = {
        email: 'profile-test@example.com',
        password: 'TestPassword123!',
        name: 'Profile Test User',
        confirmPassword: 'TestPassword123!'
      };

      await request(app)
        .post('/api/auth/register')
        .send(userData);

      const loginResponse = await request(app)
        .post('/api/auth/login')
        .send({
          email: userData.email,
          password: userData.password
        });

      authToken = loginResponse.body.tokens.accessToken;
    });

    test('should return user profile when authenticated', async () => {
      const response = await request(app)
        .get('/api/auth/me')
        .set('Authorization', `Bearer ${authToken}`)
        .expect(200);

      expect(response.body).toHaveProperty('email', 'profile-test@example.com');
      expect(response.body).toHaveProperty('name', 'Profile Test User');
      expect(response.body).not.toHaveProperty('password');
    });

    test('should reject request without token', async () => {
      const response = await request(app)
        .get('/api/auth/me')
        .expect(401);

      expect(response.body).toHaveProperty('error', 'Authentication required');
    });

    test('should reject request with invalid token', async () => {
      const response = await request(app)
        .get('/api/auth/me')
        .set('Authorization', 'Bearer invalid-token')
        .expect(401);

      expect(response.body).toHaveProperty('error');
    });
  });

  describe('POST /api/auth/refresh', () => {
    let refreshToken;

    beforeEach(async () => {
      // Register and login to get refresh token
      const userData = {
        email: 'refresh-test@example.com',
        password: 'TestPassword123!',
        name: 'Refresh Test User',
        confirmPassword: 'TestPassword123!'
      };

      await request(app)
        .post('/api/auth/register')
        .send(userData);

      const loginResponse = await request(app)
        .post('/api/auth/login')
        .send({
          email: userData.email,
          password: userData.password
        });

      refreshToken = loginResponse.body.tokens.refreshToken;
    });

    test('should refresh access token with valid refresh token', async () => {
      const response = await request(app)
        .post('/api/auth/refresh')
        .send({ refreshToken })
        .expect(200);

      expect(response.body).toHaveProperty('accessToken');
    });

    test('should reject refresh with invalid token', async () => {
      const response = await request(app)
        .post('/api/auth/refresh')
        .send({ refreshToken: 'invalid-token' })
        .expect(401);

      expect(response.body).toHaveProperty('error');
    });
  });

  describe('PUT /api/auth/profile', () => {
    let authToken;

    beforeEach(async () => {
      // Register and login to get token
      const userData = {
        email: 'update-test@example.com',
        password: 'TestPassword123!',
        name: 'Update Test User',
        confirmPassword: 'TestPassword123!'
      };

      await request(app)
        .post('/api/auth/register')
        .send(userData);

      const loginResponse = await request(app)
        .post('/api/auth/login')
        .send({
          email: userData.email,
          password: userData.password
        });

      authToken = loginResponse.body.tokens.accessToken;
    });

    test('should update user profile', async () => {
      const updateData = {
        name: 'Updated Name',
        bio: 'Updated bio'
      };

      const response = await request(app)
        .put('/api/auth/profile')
        .set('Authorization', `Bearer ${authToken}`)
        .send(updateData)
        .expect(200);

      expect(response.body).toHaveProperty('message', 'Profile updated successfully');
      expect(response.body.user).toHaveProperty('name', 'Updated Name');
      expect(response.body.user).toHaveProperty('bio', 'Updated bio');
    });

    test('should reject profile update without authentication', async () => {
      const updateData = {
        name: 'Updated Name'
      };

      const response = await request(app)
        .put('/api/auth/profile')
        .send(updateData)
        .expect(401);

      expect(response.body).toHaveProperty('error', 'Authentication required');
    });
  });

  describe('POST /api/auth/logout', () => {
    test('should logout successfully', async () => {
      const response = await request(app)
        .post('/api/auth/logout')
        .send({ refreshToken: 'some-token' })
        .expect(200);

      expect(response.body).toHaveProperty('message', 'Logout successful');
    });
  });
});

// Cleanup after all tests
afterAll(async () => {
  // Clean up any test data
  const users = userStore.getAllUsers();
  users.forEach(user => {
    if (user.email !== 'admin@visualwebeditor.com') {
      userStore.delete(user.id);
    }
  });
});
