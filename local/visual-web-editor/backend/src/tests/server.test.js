/**
 * Server Integration Tests
 * Tests for the main server functionality
 */

const request = require('supertest');
const app = require('../server');

// Mock external dependencies
jest.mock('../utils/logger', () => ({
  info: jest.fn(),
  error: jest.fn(),
  warn: jest.fn(),
  debug: jest.fn()
}));

describe('Server Integration Tests', () => {
  describe('Health Check', () => {
    test('GET /api/health should return server status', async () => {
      const response = await request(app)
        .get('/api/health')
        .expect(200);

      expect(response.body).toHaveProperty('status', 'healthy');
      expect(response.body).toHaveProperty('timestamp');
      expect(response.body).toHaveProperty('version');
      expect(response.body).toHaveProperty('environment');
      expect(response.body).toHaveProperty('uptime');
      expect(response.body).toHaveProperty('memory');
      expect(response.body).toHaveProperty('services');
    });
  });

  describe('Authentication Endpoints', () => {
    test('POST /api/auth/register should create a new user', async () => {
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
    });

    test('POST /api/auth/login should authenticate user', async () => {
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
    });

    test('GET /api/auth/me should return user profile when authenticated', async () => {
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

      const token = loginResponse.body.tokens.accessToken;

      const response = await request(app)
        .get('/api/auth/me')
        .set('Authorization', `Bearer ${token}`)
        .expect(200);

      expect(response.body).toHaveProperty('email', userData.email);
      expect(response.body).toHaveProperty('name', userData.name);
      expect(response.body).not.toHaveProperty('password');
    });
  });

  describe('Project Endpoints', () => {
    let authToken;

    beforeEach(async () => {
      // Create and login user for project tests
      const userData = {
        email: 'project-test@example.com',
        password: 'TestPassword123!',
        name: 'Project Test User',
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

    test('GET /api/projects should return projects list', async () => {
      const response = await request(app)
        .get('/api/projects')
        .expect(200);

      expect(response.body).toHaveProperty('projects');
      expect(response.body).toHaveProperty('pagination');
      expect(Array.isArray(response.body.projects)).toBe(true);
    });

    test('POST /api/projects should create a new project', async () => {
      const projectData = {
        name: 'Test Project',
        description: 'A test project',
        elements: [
          {
            id: 'test-element-1',
            type: 'heading',
            content: 'Test Heading',
            styles: { fontSize: '2rem' }
          }
        ]
      };

      const response = await request(app)
        .post('/api/projects')
        .send(projectData)
        .expect(201);

      expect(response.body).toHaveProperty('name', projectData.name);
      expect(response.body).toHaveProperty('description', projectData.description);
      expect(response.body).toHaveProperty('elements');
      expect(response.body).toHaveProperty('id');
      expect(response.body).toHaveProperty('createdAt');
      expect(response.body).toHaveProperty('updatedAt');
    });

    test('GET /api/projects/:id should return specific project', async () => {
      // First create a project
      const projectData = {
        name: 'Get Test Project',
        description: 'A project for get testing',
        elements: []
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      const projectId = createResponse.body.id;

      // Then get it
      const response = await request(app)
        .get(`/api/projects/${projectId}`)
        .expect(200);

      expect(response.body).toHaveProperty('id', projectId);
      expect(response.body).toHaveProperty('name', projectData.name);
      expect(response.body).toHaveProperty('description', projectData.description);
    });
  });

  describe('AI Endpoints', () => {
    test('GET /api/ai/status should return AI agent status', async () => {
      const response = await request(app)
        .get('/api/ai/status')
        .expect(200);

      expect(response.body).toHaveProperty('status');
      expect(response.body).toHaveProperty('agent_url');
      expect(response.body).toHaveProperty('metrics');
      expect(response.body).toHaveProperty('last_check');
    });

    test('POST /api/ai/chat should handle AI chat requests', async () => {
      const chatData = {
        message: 'Help me design a button',
        context: {},
        elements: []
      };

      const response = await request(app)
        .post('/api/ai/chat')
        .send(chatData);

      // Should return either success (200) or fallback error (500)
      expect([200, 500]).toContain(response.status);

      if (response.status === 200) {
        expect(response.body).toHaveProperty('response');
        expect(response.body).toHaveProperty('sessionId');
      }
    });
  });

  describe('Error Handling', () => {
    test('GET /api/nonexistent should return 404', async () => {
      const response = await request(app)
        .get('/api/nonexistent')
        .expect(404);

      expect(response.body).toHaveProperty('error', 'API endpoint not found');
    });

    test('POST /api/auth/login with invalid credentials should return 401', async () => {
      const invalidData = {
        email: 'nonexistent@example.com',
        password: 'wrongpassword'
      };

      const response = await request(app)
        .post('/api/auth/login')
        .send(invalidData)
        .expect(401);

      expect(response.body).toHaveProperty('error', 'Invalid credentials');
    });
  });
});

// Cleanup after tests
afterAll(async () => {
  // Close any open connections
  if (app && app.close) {
    await app.close();
  }
});
