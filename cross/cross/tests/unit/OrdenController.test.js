const request = require('supertest');
const OrdenController = require('../../app/Controllers/OrdenController');

describe('OrdenController', () => {
  let mockReq, mockRes;

  beforeEach(() => {
    mockReq = {
      user: { usuacodigos: 'test_user', usuanombres: 'Test User' },
      body: {},
      params: {},
      query: {}
    };
    
    mockRes = {
      status: jest.fn().mockReturnThis(),
      json: jest.fn().mockReturnThis()
    };
  });

  describe('create', () => {
    it('should create orden successfully', async () => {
      const controller = new OrdenController();
      
      mockReq.body = {
        ordenData: { ordeobservs: 'Test orden' },
        empresaData: { contidentis: '12345678', tiorcodigos: 'QUEJA' }
      };

      // Mock transaction
      const mockTransaction = {
        commit: jest.fn(),
        rollback: jest.fn()
      };
      
      controller.db = {
        transaction: jest.fn().mockResolvedValue(mockTransaction)
      };

      await controller.create(mockReq, mockRes);

      expect(mockRes.status).toHaveBeenCalledWith(200);
      expect(mockRes.json).toHaveBeenCalledWith(
        expect.objectContaining({
          success: true,
          code: 3
        })
      );
    });

    it('should validate required fields', async () => {
      const controller = new OrdenController();
      
      mockReq.body = {}; // Datos vacíos

      await controller.create(mockReq, mockRes);

      expect(mockRes.status).toHaveBeenCalledWith(400);
      expect(mockRes.json).toHaveBeenCalledWith(
        expect.objectContaining({
          success: false
        })
      );
    });
  });

  describe('index', () => {
    it('should return paginated list', async () => {
      const controller = new OrdenController();
      
      mockReq.query = { page: 1, limit: 10 };

      await controller.index(mockReq, mockRes);

      expect(mockRes.status).toHaveBeenCalledWith(200);
      expect(mockRes.json).toHaveBeenCalledWith(
        expect.objectContaining({
          success: true,
          data: expect.objectContaining({
            ordenes: expect.any(Array),
            pagination: expect.any(Object)
          })
        })
      );
    });
  });

  describe('show', () => {
    it('should return orden by id', async () => {
      const controller = new OrdenController();
      
      mockReq.params = { ordenumeros: '0000000001' };

      await controller.show(mockReq, mockRes);

      expect(mockRes.status).toHaveBeenCalledWith(200);
    });

    it('should return 404 for non-existent orden', async () => {
      const controller = new OrdenController();
      
      mockReq.params = { ordenumeros: 'nonexistent' };

      await controller.show(mockReq, mockRes);

      expect(mockRes.status).toHaveBeenCalledWith(404);
    });
  });
});