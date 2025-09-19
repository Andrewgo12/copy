/**
 * Project Controller
 * Handles all project-related business logic
 */

const fs = require('fs-extra');
const path = require('path');
const { v4: uuidv4 } = require('uuid');
const archiver = require('archiver');
const moment = require('moment');

const logger = require('../utils/logger');
const codeGeneratorUtils = require('../utils/codeGenerator');

// In-memory storage (replace with database in production)
let projects = [];
let projectAssets = new Map();
let sharedProjects = new Map();
let projectBackups = new Map();

// Load projects from file system on startup
const loadProjectsFromDisk = async () => {
  try {
    const projectsPath = path.join(__dirname, '../../projects/projects.json');
    if (await fs.pathExists(projectsPath)) {
      const data = await fs.readJson(projectsPath);
      projects = data.projects || [];
      logger.info(`Loaded ${projects.length} projects from disk`);
    }
  } catch (error) {
    logger.error('Failed to load projects from disk:', error);
  }
};

// Save projects to file system
const saveProjectsToDisk = async () => {
  try {
    const projectsPath = path.join(__dirname, '../../projects/projects.json');
    await fs.ensureDir(path.dirname(projectsPath));
    await fs.writeJson(projectsPath, { projects }, { spaces: 2 });
  } catch (error) {
    logger.error('Failed to save projects to disk:', error);
  }
};

// Initialize projects on module load
loadProjectsFromDisk();

/**
 * Get all projects with filtering and pagination
 */
const getAllProjects = async (req, res) => {
  try {
    const {
      page = 1,
      limit = 20,
      sort = 'updatedAt',
      order = 'desc',
      search = ''
    } = req.query;

    let filteredProjects = [...projects];

    // Apply search filter
    if (search) {
      const searchLower = search.toLowerCase();
      filteredProjects = filteredProjects.filter(project =>
        project.name.toLowerCase().includes(searchLower) ||
        (project.description && project.description.toLowerCase().includes(searchLower))
      );
    }

    // Apply sorting
    filteredProjects.sort((a, b) => {
      const aValue = a[sort];
      const bValue = b[sort];
      
      if (order === 'asc') {
        return aValue > bValue ? 1 : -1;
      } else {
        return aValue < bValue ? 1 : -1;
      }
    });

    // Apply pagination
    const startIndex = (page - 1) * limit;
    const endIndex = startIndex + parseInt(limit);
    const paginatedProjects = filteredProjects.slice(startIndex, endIndex);

    // Calculate pagination info
    const totalProjects = filteredProjects.length;
    const totalPages = Math.ceil(totalProjects / limit);
    const hasNextPage = page < totalPages;
    const hasPrevPage = page > 1;

    res.json({
      projects: paginatedProjects,
      pagination: {
        currentPage: parseInt(page),
        totalPages,
        totalProjects,
        hasNextPage,
        hasPrevPage,
        limit: parseInt(limit)
      }
    });
  } catch (error) {
    logger.error('Error getting projects:', error);
    res.status(500).json({
      error: 'Failed to retrieve projects',
      message: error.message
    });
  }
};

/**
 * Get a specific project by ID
 */
const getProjectById = async (req, res) => {
  try {
    const { id } = req.params;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    res.json(project);
  } catch (error) {
    logger.error('Error getting project:', error);
    res.status(500).json({
      error: 'Failed to retrieve project',
      message: error.message
    });
  }
};

/**
 * Create a new project
 */
const createProject = async (req, res) => {
  try {
    const { name, description, elements = [], settings = {} } = req.body;
    
    const project = {
      id: uuidv4(),
      name,
      description,
      elements,
      settings,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
      version: 1,
      status: 'active',
      metadata: {
        elementCount: elements.length,
        lastModified: new Date().toISOString(),
        size: JSON.stringify(elements).length
      }
    };

    projects.push(project);
    await saveProjectsToDisk();

    logger.info(`Created new project: ${project.name} (${project.id})`);
    
    res.status(201).json(project);
  } catch (error) {
    logger.error('Error creating project:', error);
    res.status(500).json({
      error: 'Failed to create project',
      message: error.message
    });
  }
};

/**
 * Update an existing project
 */
const updateProject = async (req, res) => {
  try {
    const { id } = req.params;
    const { name, description, elements, settings } = req.body;
    
    const projectIndex = projects.findIndex(p => p.id === id);
    if (projectIndex === -1) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const existingProject = projects[projectIndex];
    
    // Update project
    const updatedProject = {
      ...existingProject,
      ...(name && { name }),
      ...(description !== undefined && { description }),
      ...(elements && { elements }),
      ...(settings && { settings }),
      updatedAt: new Date().toISOString(),
      version: existingProject.version + 1,
      metadata: {
        ...existingProject.metadata,
        elementCount: elements ? elements.length : existingProject.metadata.elementCount,
        lastModified: new Date().toISOString(),
        size: elements ? JSON.stringify(elements).length : existingProject.metadata.size
      }
    };

    projects[projectIndex] = updatedProject;
    await saveProjectsToDisk();

    logger.info(`Updated project: ${updatedProject.name} (${id})`);
    
    res.json(updatedProject);
  } catch (error) {
    logger.error('Error updating project:', error);
    res.status(500).json({
      error: 'Failed to update project',
      message: error.message
    });
  }
};

/**
 * Delete a project
 */
const deleteProject = async (req, res) => {
  try {
    const { id } = req.params;
    
    const projectIndex = projects.findIndex(p => p.id === id);
    if (projectIndex === -1) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const deletedProject = projects[projectIndex];
    projects.splice(projectIndex, 1);
    
    // Clean up associated data
    projectAssets.delete(id);
    projectBackups.delete(id);
    
    await saveProjectsToDisk();

    logger.info(`Deleted project: ${deletedProject.name} (${id})`);
    
    res.json({
      message: 'Project deleted successfully',
      project: deletedProject
    });
  } catch (error) {
    logger.error('Error deleting project:', error);
    res.status(500).json({
      error: 'Failed to delete project',
      message: error.message
    });
  }
};

/**
 * Duplicate a project
 */
const duplicateProject = async (req, res) => {
  try {
    const { id } = req.params;
    const { name } = req.body;
    
    const originalProject = projects.find(p => p.id === id);
    if (!originalProject) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const duplicatedProject = {
      ...originalProject,
      id: uuidv4(),
      name: name || `${originalProject.name} (Copy)`,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
      version: 1
    };

    projects.push(duplicatedProject);
    await saveProjectsToDisk();

    logger.info(`Duplicated project: ${originalProject.name} -> ${duplicatedProject.name}`);
    
    res.status(201).json(duplicatedProject);
  } catch (error) {
    logger.error('Error duplicating project:', error);
    res.status(500).json({
      error: 'Failed to duplicate project',
      message: error.message
    });
  }
};

/**
 * Export project as JSON
 */
const exportProject = async (req, res) => {
  try {
    const { id } = req.params;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const exportData = {
      ...project,
      exportedAt: new Date().toISOString(),
      exportVersion: '2.0.0'
    };

    res.setHeader('Content-Type', 'application/json');
    res.setHeader('Content-Disposition', `attachment; filename="${project.name.replace(/[^a-z0-9]/gi, '_').toLowerCase()}.json"`);
    
    res.json(exportData);
  } catch (error) {
    logger.error('Error exporting project:', error);
    res.status(500).json({
      error: 'Failed to export project',
      message: error.message
    });
  }
};

/**
 * Import project from JSON file
 */
const importProject = async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({
        error: 'No file uploaded',
        message: 'Please upload a JSON file'
      });
    }

    const fileContent = req.file.buffer.toString('utf8');
    const importedData = JSON.parse(fileContent);

    // Validate imported data
    if (!importedData.name || !importedData.elements) {
      return res.status(400).json({
        error: 'Invalid project file',
        message: 'Project file must contain name and elements'
      });
    }

    const project = {
      id: uuidv4(),
      name: `${importedData.name} (Imported)`,
      description: importedData.description || '',
      elements: importedData.elements,
      settings: importedData.settings || {},
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
      version: 1,
      status: 'active',
      metadata: {
        elementCount: importedData.elements.length,
        lastModified: new Date().toISOString(),
        size: JSON.stringify(importedData.elements).length,
        imported: true,
        originalId: importedData.id
      }
    };

    projects.push(project);
    await saveProjectsToDisk();

    logger.info(`Imported project: ${project.name} (${project.id})`);
    
    res.status(201).json(project);
  } catch (error) {
    logger.error('Error importing project:', error);
    res.status(500).json({
      error: 'Failed to import project',
      message: error.message
    });
  }
};

/**
 * Generate code for project
 */
const generateCode = async (req, res) => {
  try {
    const { id } = req.params;
    const {
      framework = 'react',
      styling = 'tailwind',
      typescript = false
    } = req.query;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const codeOptions = {
      framework,
      styling,
      typescript: typescript === 'true',
      componentName: project.name.replace(/[^a-zA-Z0-9]/g, ''),
      includeImports: true,
      includeExport: true
    };

    const generatedCode = await codeGeneratorUtils.generateCode(project.elements, codeOptions);

    res.json({
      code: generatedCode,
      options: codeOptions,
      generatedAt: new Date().toISOString(),
      projectId: id,
      projectName: project.name
    });
  } catch (error) {
    logger.error('Error generating code:', error);
    res.status(500).json({
      error: 'Failed to generate code',
      message: error.message
    });
  }
};

/**
 * Upload assets for a project
 */
const uploadAssets = async (req, res) => {
  try {
    const { id } = req.params;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    if (!req.files || req.files.length === 0) {
      return res.status(400).json({
        error: 'No files uploaded',
        message: 'Please upload at least one file'
      });
    }

    const assets = req.files.map(file => ({
      id: uuidv4(),
      filename: file.filename,
      originalName: file.originalname,
      mimetype: file.mimetype,
      size: file.size,
      path: file.path,
      url: `/uploads/projects/${file.filename}`,
      uploadedAt: new Date().toISOString()
    }));

    // Store assets for the project
    if (!projectAssets.has(id)) {
      projectAssets.set(id, []);
    }
    projectAssets.get(id).push(...assets);

    logger.info(`Uploaded ${assets.length} assets for project ${id}`);
    
    res.status(201).json({
      message: 'Assets uploaded successfully',
      assets
    });
  } catch (error) {
    logger.error('Error uploading assets:', error);
    res.status(500).json({
      error: 'Failed to upload assets',
      message: error.message
    });
  }
};

/**
 * Get project assets
 */
const getProjectAssets = async (req, res) => {
  try {
    const { id } = req.params;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const assets = projectAssets.get(id) || [];
    
    res.json({
      projectId: id,
      assets,
      totalAssets: assets.length,
      totalSize: assets.reduce((sum, asset) => sum + asset.size, 0)
    });
  } catch (error) {
    logger.error('Error getting project assets:', error);
    res.status(500).json({
      error: 'Failed to retrieve project assets',
      message: error.message
    });
  }
};

/**
 * Delete a project asset
 */
const deleteAsset = async (req, res) => {
  try {
    const { id, assetId } = req.params;
    
    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const assets = projectAssets.get(id) || [];
    const assetIndex = assets.findIndex(asset => asset.id === assetId);
    
    if (assetIndex === -1) {
      return res.status(404).json({
        error: 'Asset not found',
        message: `Asset with ID ${assetId} does not exist`
      });
    }

    const deletedAsset = assets[assetIndex];
    assets.splice(assetIndex, 1);

    // Delete file from disk
    try {
      await fs.remove(deletedAsset.path);
    } catch (fileError) {
      logger.warn('Failed to delete asset file:', fileError);
    }

    logger.info(`Deleted asset ${assetId} from project ${id}`);
    
    res.json({
      message: 'Asset deleted successfully',
      asset: deletedAsset
    });
  } catch (error) {
    logger.error('Error deleting asset:', error);
    res.status(500).json({
      error: 'Failed to delete asset',
      message: error.message
    });
  }
};

/**
 * Share project with others
 */
const shareProject = async (req, res) => {
  try {
    const { id } = req.params;
    const { permissions = 'view', expiresAt } = req.body;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const shareId = uuidv4();
    const shareData = {
      id: shareId,
      projectId: id,
      permissions,
      createdAt: new Date().toISOString(),
      expiresAt: expiresAt || new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toISOString(), // 30 days default
      accessCount: 0
    };

    sharedProjects.set(shareId, shareData);

    logger.info(`Project shared: ${project.name} (${id}) with permissions: ${permissions}`);

    res.json({
      message: 'Project shared successfully',
      shareId,
      shareUrl: `${req.protocol}://${req.get('host')}/shared/${shareId}`,
      permissions,
      expiresAt: shareData.expiresAt
    });
  } catch (error) {
    logger.error('Error sharing project:', error);
    res.status(500).json({
      error: 'Failed to share project',
      message: error.message
    });
  }
};

/**
 * Get shared project
 */
const getSharedProject = async (req, res) => {
  try {
    const { shareId } = req.params;

    const shareData = sharedProjects.get(shareId);
    if (!shareData) {
      return res.status(404).json({
        error: 'Shared project not found',
        message: 'This shared link is invalid or has expired'
      });
    }

    // Check if share has expired
    if (new Date() > new Date(shareData.expiresAt)) {
      sharedProjects.delete(shareId);
      return res.status(410).json({
        error: 'Shared project expired',
        message: 'This shared link has expired'
      });
    }

    const project = projects.find(p => p.id === shareData.projectId);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: 'The shared project no longer exists'
      });
    }

    // Increment access count
    shareData.accessCount++;

    // Return project data based on permissions
    const projectData = shareData.permissions === 'view'
      ? { ...project, elements: project.elements } // Read-only
      : project; // Full access

    res.json({
      project: projectData,
      shareInfo: {
        permissions: shareData.permissions,
        expiresAt: shareData.expiresAt,
        accessCount: shareData.accessCount
      }
    });
  } catch (error) {
    logger.error('Error getting shared project:', error);
    res.status(500).json({
      error: 'Failed to retrieve shared project',
      message: error.message
    });
  }
};

/**
 * Create project backup
 */
const createBackup = async (req, res) => {
  try {
    const { id } = req.params;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const backupId = uuidv4();
    const backup = {
      id: backupId,
      projectId: id,
      projectData: { ...project },
      createdAt: new Date().toISOString(),
      description: req.body.description || `Backup created on ${new Date().toLocaleDateString()}`,
      size: JSON.stringify(project).length
    };

    if (!projectBackups.has(id)) {
      projectBackups.set(id, []);
    }

    const backups = projectBackups.get(id);
    backups.push(backup);

    // Keep only last 10 backups
    if (backups.length > 10) {
      backups.splice(0, backups.length - 10);
    }

    logger.info(`Backup created for project: ${project.name} (${id})`);

    res.status(201).json({
      message: 'Backup created successfully',
      backup: {
        id: backup.id,
        createdAt: backup.createdAt,
        description: backup.description,
        size: backup.size
      }
    });
  } catch (error) {
    logger.error('Error creating backup:', error);
    res.status(500).json({
      error: 'Failed to create backup',
      message: error.message
    });
  }
};

/**
 * Get project backups
 */
const getBackups = async (req, res) => {
  try {
    const { id } = req.params;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const backups = projectBackups.get(id) || [];

    // Return backup metadata only (not full project data)
    const backupList = backups.map(backup => ({
      id: backup.id,
      createdAt: backup.createdAt,
      description: backup.description,
      size: backup.size
    }));

    res.json({
      projectId: id,
      backups: backupList,
      totalBackups: backupList.length
    });
  } catch (error) {
    logger.error('Error getting backups:', error);
    res.status(500).json({
      error: 'Failed to retrieve backups',
      message: error.message
    });
  }
};

/**
 * Restore project from backup
 */
const restoreBackup = async (req, res) => {
  try {
    const { id, backupId } = req.params;

    const projectIndex = projects.findIndex(p => p.id === id);
    if (projectIndex === -1) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const backups = projectBackups.get(id) || [];
    const backup = backups.find(b => b.id === backupId);

    if (!backup) {
      return res.status(404).json({
        error: 'Backup not found',
        message: `Backup with ID ${backupId} does not exist`
      });
    }

    // Create a backup of current state before restoring
    const currentBackup = {
      id: uuidv4(),
      projectId: id,
      projectData: { ...projects[projectIndex] },
      createdAt: new Date().toISOString(),
      description: 'Auto-backup before restore',
      size: JSON.stringify(projects[projectIndex]).length
    };
    backups.push(currentBackup);

    // Restore from backup
    const restoredProject = {
      ...backup.projectData,
      updatedAt: new Date().toISOString(),
      version: projects[projectIndex].version + 1
    };

    projects[projectIndex] = restoredProject;
    await saveProjectsToDisk();

    logger.info(`Project restored from backup: ${restoredProject.name} (${id})`);

    res.json({
      message: 'Project restored successfully',
      project: restoredProject,
      restoredFrom: {
        backupId: backup.id,
        backupDate: backup.createdAt
      }
    });
  } catch (error) {
    logger.error('Error restoring backup:', error);
    res.status(500).json({
      error: 'Failed to restore backup',
      message: error.message
    });
  }
};

/**
 * Get project analytics
 */
const getProjectAnalytics = async (req, res) => {
  try {
    const { id } = req.params;
    const { period = 'week' } = req.query;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    // Generate mock analytics data (in production, this would come from actual usage data)
    const now = new Date();
    const periodMs = {
      day: 24 * 60 * 60 * 1000,
      week: 7 * 24 * 60 * 60 * 1000,
      month: 30 * 24 * 60 * 60 * 1000,
      year: 365 * 24 * 60 * 60 * 1000
    };

    const analytics = {
      projectId: id,
      period,
      generatedAt: new Date().toISOString(),
      metrics: {
        totalViews: Math.floor(Math.random() * 1000) + 100,
        uniqueVisitors: Math.floor(Math.random() * 500) + 50,
        editSessions: Math.floor(Math.random() * 200) + 20,
        codeGenerations: Math.floor(Math.random() * 100) + 10,
        averageSessionDuration: Math.floor(Math.random() * 1800) + 300, // seconds
        elementCount: project.elements?.length || 0,
        projectSize: JSON.stringify(project).length,
        lastModified: project.updatedAt
      },
      trends: {
        viewsChange: (Math.random() - 0.5) * 100, // percentage change
        visitorsChange: (Math.random() - 0.5) * 100,
        engagementChange: (Math.random() - 0.5) * 50
      },
      topElements: [
        { type: 'button', count: Math.floor(Math.random() * 20) + 5 },
        { type: 'container', count: Math.floor(Math.random() * 15) + 3 },
        { type: 'heading', count: Math.floor(Math.random() * 10) + 2 },
        { type: 'paragraph', count: Math.floor(Math.random() * 8) + 1 }
      ]
    };

    res.json(analytics);
  } catch (error) {
    logger.error('Error getting project analytics:', error);
    res.status(500).json({
      error: 'Failed to retrieve project analytics',
      message: error.message
    });
  }
};

/**
 * Add collaborator to project
 */
const addCollaborator = async (req, res) => {
  try {
    const { id } = req.params;
    const { email, role = 'viewer' } = req.body;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    // Initialize collaborators if not exists
    if (!project.collaborators) {
      project.collaborators = [];
    }

    // Check if user is already a collaborator
    const existingCollaborator = project.collaborators.find(c => c.email === email);
    if (existingCollaborator) {
      return res.status(400).json({
        error: 'User already collaborating',
        message: 'This user is already a collaborator on this project'
      });
    }

    const collaborator = {
      id: uuidv4(),
      email,
      role,
      addedAt: new Date().toISOString(),
      status: 'pending' // In production, would send invitation email
    };

    project.collaborators.push(collaborator);
    project.updatedAt = new Date().toISOString();

    await saveProjectsToDisk();

    logger.info(`Collaborator added to project: ${email} as ${role} on ${project.name} (${id})`);

    res.status(201).json({
      message: 'Collaborator added successfully',
      collaborator: {
        id: collaborator.id,
        email: collaborator.email,
        role: collaborator.role,
        addedAt: collaborator.addedAt,
        status: collaborator.status
      }
    });
  } catch (error) {
    logger.error('Error adding collaborator:', error);
    res.status(500).json({
      error: 'Failed to add collaborator',
      message: error.message
    });
  }
};

/**
 * Get project collaborators
 */
const getCollaborators = async (req, res) => {
  try {
    const { id } = req.params;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    const collaborators = project.collaborators || [];

    res.json({
      projectId: id,
      collaborators: collaborators.map(c => ({
        id: c.id,
        email: c.email,
        role: c.role,
        addedAt: c.addedAt,
        status: c.status
      })),
      totalCollaborators: collaborators.length
    });
  } catch (error) {
    logger.error('Error getting collaborators:', error);
    res.status(500).json({
      error: 'Failed to retrieve collaborators',
      message: error.message
    });
  }
};

/**
 * Remove collaborator from project
 */
const removeCollaborator = async (req, res) => {
  try {
    const { id, userId } = req.params;

    const project = projects.find(p => p.id === id);
    if (!project) {
      return res.status(404).json({
        error: 'Project not found',
        message: `Project with ID ${id} does not exist`
      });
    }

    if (!project.collaborators) {
      return res.status(404).json({
        error: 'Collaborator not found',
        message: 'No collaborators found for this project'
      });
    }

    const collaboratorIndex = project.collaborators.findIndex(c => c.id === userId);
    if (collaboratorIndex === -1) {
      return res.status(404).json({
        error: 'Collaborator not found',
        message: `Collaborator with ID ${userId} not found`
      });
    }

    const removedCollaborator = project.collaborators[collaboratorIndex];
    project.collaborators.splice(collaboratorIndex, 1);
    project.updatedAt = new Date().toISOString();

    await saveProjectsToDisk();

    logger.info(`Collaborator removed from project: ${removedCollaborator.email} from ${project.name} (${id})`);

    res.json({
      message: 'Collaborator removed successfully',
      removedCollaborator: {
        id: removedCollaborator.id,
        email: removedCollaborator.email,
        role: removedCollaborator.role
      }
    });
  } catch (error) {
    logger.error('Error removing collaborator:', error);
    res.status(500).json({
      error: 'Failed to remove collaborator',
      message: error.message
    });
  }
};

module.exports = {
  getAllProjects,
  getProjectById,
  createProject,
  updateProject,
  deleteProject,
  duplicateProject,
  exportProject,
  importProject,
  generateCode,
  uploadAssets,
  getProjectAssets,
  deleteAsset,
  shareProject,
  getSharedProject,
  createBackup,
  getBackups,
  restoreBackup,
  getProjectAnalytics,
  addCollaborator,
  getCollaborators,
  removeCollaborator
};
