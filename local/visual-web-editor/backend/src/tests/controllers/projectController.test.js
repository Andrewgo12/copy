/**
 * Project Controller Tests
 * Unit tests for project management functionality
 */

const request = require('supertest');
const app = require('../../server');
const fs = require('fs-extra');
const path = require('path');

// Mock logger
jest.mock('../../utils/logger', () => ({
  info: jest.fn(),
  error: jest.fn(),
  warn: jest.fn(),
  debug: jest.fn()
}));

describe('Project Controller', () => {
  let authToken;
  let testProjectId;

  beforeAll(async () => {
    // Register and login to get auth token
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

  beforeEach(async () => {
    // Clean up projects directory
    const projectsDir = path.join(__dirname, '../../../projects');
    if (await fs.pathExists(projectsDir)) {
      await fs.emptyDir(projectsDir);
    }
  });

  describe('GET /api/projects', () => {
    test('should return projects list', async () => {
      const response = await request(app)
        .get('/api/projects')
        .expect(200);

      expect(response.body).toHaveProperty('projects');
      expect(response.body).toHaveProperty('pagination');
      expect(Array.isArray(response.body.projects)).toBe(true);
    });

    test('should support pagination', async () => {
      const response = await request(app)
        .get('/api/projects?page=1&limit=10')
        .expect(200);

      expect(response.body.pagination).toHaveProperty('page', 1);
      expect(response.body.pagination).toHaveProperty('limit', 10);
    });

    test('should support search', async () => {
      const response = await request(app)
        .get('/api/projects?search=test')
        .expect(200);

      expect(response.body).toHaveProperty('projects');
    });
  });

  describe('POST /api/projects', () => {
    test('should create a new project', async () => {
      const projectData = {
        name: 'Test Project',
        description: 'A test project for verification',
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

      testProjectId = response.body.id;
    });

    test('should reject project with invalid data', async () => {
      const projectData = {
        // Missing required name field
        description: 'A test project'
      };

      const response = await request(app)
        .post('/api/projects')
        .send(projectData)
        .expect(400);

      expect(response.body).toHaveProperty('error');
    });

    test('should create project with minimal data', async () => {
      const projectData = {
        name: 'Minimal Project'
      };

      const response = await request(app)
        .post('/api/projects')
        .send(projectData)
        .expect(201);

      expect(response.body).toHaveProperty('name', projectData.name);
      expect(response.body).toHaveProperty('elements');
      expect(Array.isArray(response.body.elements)).toBe(true);
    });
  });

  describe('GET /api/projects/:id', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Get Test Project',
        description: 'A project for get testing',
        elements: []
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should return specific project', async () => {
      const response = await request(app)
        .get(`/api/projects/${testProjectId}`)
        .expect(200);

      expect(response.body).toHaveProperty('id', testProjectId);
      expect(response.body).toHaveProperty('name', 'Get Test Project');
      expect(response.body).toHaveProperty('description', 'A project for get testing');
    });

    test('should return 404 for non-existent project', async () => {
      const response = await request(app)
        .get('/api/projects/non-existent-id')
        .expect(404);

      expect(response.body).toHaveProperty('error', 'Project not found');
    });
  });

  describe('PUT /api/projects/:id', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Update Test Project',
        description: 'A project for update testing',
        elements: []
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should update project successfully', async () => {
      const updateData = {
        name: 'Updated Project Name',
        description: 'Updated description',
        elements: [
          {
            id: 'new-element',
            type: 'button',
            content: 'New Button'
          }
        ]
      };

      const response = await request(app)
        .put(`/api/projects/${testProjectId}`)
        .send(updateData)
        .expect(200);

      expect(response.body).toHaveProperty('name', updateData.name);
      expect(response.body).toHaveProperty('description', updateData.description);
      expect(response.body.elements).toHaveLength(1);
    });

    test('should return 404 for non-existent project', async () => {
      const updateData = {
        name: 'Updated Name'
      };

      const response = await request(app)
        .put('/api/projects/non-existent-id')
        .send(updateData)
        .expect(404);

      expect(response.body).toHaveProperty('error', 'Project not found');
    });
  });

  describe('DELETE /api/projects/:id', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Delete Test Project',
        description: 'A project for delete testing',
        elements: []
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should delete project successfully', async () => {
      const response = await request(app)
        .delete(`/api/projects/${testProjectId}`)
        .expect(200);

      expect(response.body).toHaveProperty('message', 'Project deleted successfully');

      // Verify project is deleted
      await request(app)
        .get(`/api/projects/${testProjectId}`)
        .expect(404);
    });

    test('should return 404 for non-existent project', async () => {
      const response = await request(app)
        .delete('/api/projects/non-existent-id')
        .expect(404);

      expect(response.body).toHaveProperty('error', 'Project not found');
    });
  });

  describe('POST /api/projects/:id/duplicate', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Duplicate Test Project',
        description: 'A project for duplicate testing',
        elements: [
          {
            id: 'element-1',
            type: 'heading',
            content: 'Original Heading'
          }
        ]
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should duplicate project successfully', async () => {
      const response = await request(app)
        .post(`/api/projects/${testProjectId}/duplicate`)
        .expect(201);

      expect(response.body).toHaveProperty('name', 'Duplicate Test Project (Copy)');
      expect(response.body).toHaveProperty('description', 'A project for duplicate testing');
      expect(response.body.elements).toHaveLength(1);
      expect(response.body.id).not.toBe(testProjectId);
    });
  });

  describe('POST /api/projects/:id/export', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Export Test Project',
        description: 'A project for export testing',
        elements: [
          {
            id: 'element-1',
            type: 'button',
            content: 'Export Button'
          }
        ]
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should export project as JSON', async () => {
      const response = await request(app)
        .post(`/api/projects/${testProjectId}/export`)
        .send({ format: 'json' })
        .expect(200);

      expect(response.body).toHaveProperty('format', 'json');
      expect(response.body).toHaveProperty('data');
      expect(response.body.data).toHaveProperty('name', 'Export Test Project');
    });

    test('should export project as React code', async () => {
      const response = await request(app)
        .post(`/api/projects/${testProjectId}/export`)
        .send({ 
          format: 'react',
          options: {
            framework: 'react',
            styling: 'tailwind'
          }
        })
        .expect(200);

      expect(response.body).toHaveProperty('format', 'react');
      expect(response.body).toHaveProperty('files');
      expect(response.body.files).toHaveProperty('App.jsx');
    });
  });

  describe('GET /api/projects/:id/analytics', () => {
    beforeEach(async () => {
      // Create a test project
      const projectData = {
        name: 'Analytics Test Project',
        elements: []
      };

      const createResponse = await request(app)
        .post('/api/projects')
        .send(projectData);

      testProjectId = createResponse.body.id;
    });

    test('should return project analytics', async () => {
      const response = await request(app)
        .get(`/api/projects/${testProjectId}/analytics`)
        .expect(200);

      expect(response.body).toHaveProperty('projectId', testProjectId);
      expect(response.body).toHaveProperty('metrics');
      expect(response.body).toHaveProperty('trends');
      expect(response.body).toHaveProperty('topElements');
    });
  });
});

// Cleanup after all tests
afterAll(async () => {
  // Clean up test projects
  const projectsDir = path.join(__dirname, '../../../projects');
  if (await fs.pathExists(projectsDir)) {
    await fs.emptyDir(projectsDir);
  }
});
