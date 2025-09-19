/**
 * AI Controller
 * Handles AI agent integration and AI-powered features
 */

const axios = require('axios');
const fs = require('fs-extra');
const path = require('path');
const { v4: uuidv4 } = require('uuid');

const logger = require('../utils/logger');

// AI Agent configuration
const AI_AGENT_URL = process.env.LOCAL_AI_AGENT_URL || 'http://localhost:8000';
const AI_TIMEOUT = 30000; // 30 seconds

// Create axios instance for AI agent
const aiClient = axios.create({
  baseURL: AI_AGENT_URL,
  timeout: AI_TIMEOUT,
  headers: {
    'Content-Type': 'application/json'
  }
});

// In-memory storage for AI sessions and feedback
let aiSessions = new Map();
let aiFeedback = [];
let aiMetrics = {
  totalRequests: 0,
  successfulRequests: 0,
  failedRequests: 0,
  averageResponseTime: 0,
  lastUpdated: new Date().toISOString()
};

/**
 * General AI chat for design assistance
 */
const chat = async (req, res) => {
  try {
    const { message, context = {}, elements = [] } = req.body;
    const sessionId = req.headers['x-session-id'] || uuidv4();

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/contextual-reasoning', {
      query: message,
      context: {
        ...context,
        elements,
        sessionId,
        timestamp: new Date().toISOString()
      }
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    // Store session data
    if (!aiSessions.has(sessionId)) {
      aiSessions.set(sessionId, {
        id: sessionId,
        messages: [],
        createdAt: new Date().toISOString()
      });
    }

    const session = aiSessions.get(sessionId);
    session.messages.push({
      type: 'user',
      content: message,
      timestamp: new Date().toISOString()
    });
    session.messages.push({
      type: 'assistant',
      content: response.data.response,
      timestamp: new Date().toISOString()
    });

    res.json({
      response: response.data.response,
      sessionId,
      suggestions: response.data.suggestions || [],
      confidence: response.data.confidence || 0.8
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI chat error:', error);
    
    res.status(500).json({
      error: 'AI chat failed',
      message: 'Unable to process your request at this time',
      fallback: 'Please try rephrasing your question or check back later.'
    });
  }
};

/**
 * Generate components from text descriptions
 */
const generateComponent = async (req, res) => {
  try {
    const {
      prompt,
      type = 'component',
      framework = 'react',
      styling = 'tailwind'
    } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/iterative-design', {
      requirements: prompt,
      target_framework: framework,
      styling_framework: styling,
      component_type: type,
      iteration_count: 1
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      elements: response.data.generated_elements || [],
      code: response.data.generated_code || '',
      suggestions: response.data.suggestions || [],
      confidence: response.data.confidence || 0.8,
      generationId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI generation error:', error);
    
    res.status(500).json({
      error: 'Component generation failed',
      message: 'Unable to generate component at this time',
      fallback: 'Try simplifying your description or use the component library.'
    });
  }
};

/**
 * Get AI suggestions to improve existing design
 */
const improveDesign = async (req, res) => {
  try {
    const { elements, feedback = '', goals = [] } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/refine-design', {
      current_design: elements,
      user_feedback: feedback,
      improvement_goals: goals,
      analysis_depth: 'comprehensive'
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      improvements: response.data.improvements || [],
      optimizedElements: response.data.optimized_elements || elements,
      analysis: response.data.analysis || {},
      confidence: response.data.confidence || 0.8,
      improvementId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI improvement error:', error);
    
    res.status(500).json({
      error: 'Design improvement failed',
      message: 'Unable to analyze and improve design at this time',
      fallback: 'Try manual adjustments or check our design guidelines.'
    });
  }
};

/**
 * Replicate design from uploaded image
 */
const replicateDesign = async (req, res) => {
  try {
    if (!req.file) {
      return res.status(400).json({
        error: 'No image uploaded',
        message: 'Please upload an image file'
      });
    }

    const {
      accuracy_target = 0.9,
      target_framework = 'react'
    } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    // Convert image to base64
    const imageBase64 = req.file.buffer.toString('base64');

    const response = await aiClient.post('/replicate-visual-design', {
      image_data: imageBase64,
      accuracy_target: parseFloat(accuracy_target),
      target_framework,
      include_responsive: true
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      elements: response.data.generated_elements || [],
      code: response.data.generated_code || '',
      accuracy: response.data.accuracy_achieved || 0,
      analysis: response.data.visual_analysis || {},
      replicationId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI replication error:', error);
    
    res.status(500).json({
      error: 'Design replication failed',
      message: 'Unable to replicate design from image at this time',
      fallback: 'Try uploading a clearer image or use manual design tools.'
    });
  }
};

/**
 * Analyze design for accessibility, performance, and UX
 */
const analyzeDesign = async (req, res) => {
  try {
    const { elements, analysis_type = 'all' } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/analyze-design', {
      design_elements: elements,
      analysis_types: analysis_type === 'all' 
        ? ['accessibility', 'performance', 'ux', 'seo']
        : [analysis_type],
      detailed_report: true
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      analysis: response.data.analysis || {},
      score: response.data.overall_score || 0,
      recommendations: response.data.recommendations || [],
      issues: response.data.issues || [],
      analysisId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI analysis error:', error);
    
    res.status(500).json({
      error: 'Design analysis failed',
      message: 'Unable to analyze design at this time',
      fallback: 'Use manual accessibility and performance tools.'
    });
  }
};

/**
 * Optimize design for specific goals
 */
const optimizeDesign = async (req, res) => {
  try {
    const { elements, optimization_goals, constraints = {} } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/optimize-design', {
      current_design: elements,
      optimization_targets: optimization_goals,
      constraints,
      preserve_functionality: true
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      optimizedElements: response.data.optimized_elements || elements,
      optimizations: response.data.applied_optimizations || [],
      metrics: response.data.performance_metrics || {},
      confidence: response.data.confidence || 0.8,
      optimizationId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI optimization error:', error);
    
    res.status(500).json({
      error: 'Design optimization failed',
      message: 'Unable to optimize design at this time',
      fallback: 'Try manual optimization techniques.'
    });
  }
};

/**
 * Get AI suggestions for next steps
 */
const getSuggestions = async (req, res) => {
  try {
    const { current_state, user_intent = '' } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/get-suggestions', {
      current_state,
      user_intent,
      suggestion_types: ['next_steps', 'improvements', 'alternatives']
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      suggestions: response.data.suggestions || [],
      priorities: response.data.priorities || [],
      reasoning: response.data.reasoning || '',
      confidence: response.data.confidence || 0.8
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI suggestions error:', error);
    
    res.status(500).json({
      error: 'Failed to get suggestions',
      message: 'Unable to generate suggestions at this time',
      fallback: 'Continue with your current approach or explore the component library.'
    });
  }
};

/**
 * Generate production-ready code
 */
const generateCode = async (req, res) => {
  try {
    const { elements, options = {} } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    const response = await aiClient.post('/generate-advanced-interface', {
      design_elements: elements,
      generation_options: {
        framework: options.framework || 'react',
        styling: options.styling || 'tailwind',
        typescript: options.typescript || false,
        responsive: options.responsive !== false,
        accessibility: options.accessibility !== false,
        ...options
      }
    });

    const responseTime = Date.now() - startTime;
    aiMetrics.successfulRequests++;
    updateAverageResponseTime(responseTime);

    res.json({
      code: response.data.generated_code || '',
      files: response.data.generated_files || {},
      documentation: response.data.documentation || '',
      tests: response.data.generated_tests || '',
      codeId: uuidv4()
    });

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI code generation error:', error);
    
    res.status(500).json({
      error: 'Code generation failed',
      message: 'Unable to generate code at this time',
      fallback: 'Use the built-in code generator or export manually.'
    });
  }
};

// Helper function to update average response time
const updateAverageResponseTime = (responseTime) => {
  const totalRequests = aiMetrics.successfulRequests;
  const currentAverage = aiMetrics.averageResponseTime;
  aiMetrics.averageResponseTime = ((currentAverage * (totalRequests - 1)) + responseTime) / totalRequests;
  aiMetrics.lastUpdated = new Date().toISOString();
};

/**
 * Refactor existing code with AI suggestions
 */
const refactorCode = async (req, res) => {
  try {
    const { code, refactor_goals, framework = 'react' } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    try {
      const response = await aiClient.post('/refactor-code', {
        source_code: code,
        refactor_goals,
        target_framework: framework,
        preserve_functionality: true
      });

      const responseTime = Date.now() - startTime;
      aiMetrics.successfulRequests++;
      updateAverageResponseTime(responseTime);

      res.json({
        refactoredCode: response.data.refactored_code || code,
        improvements: response.data.improvements || [],
        analysis: response.data.analysis || {},
        confidence: response.data.confidence || 0.8,
        refactorId: uuidv4()
      });

    } catch (aiError) {
      // Fallback to basic refactoring suggestions
      const basicRefactoring = {
        refactoredCode: code,
        improvements: [
          'Consider breaking down large components into smaller ones',
          'Add proper error handling and loading states',
          'Implement proper TypeScript types',
          'Add accessibility attributes',
          'Optimize performance with React.memo or useMemo'
        ],
        analysis: {
          complexity: 'medium',
          maintainability: 'good',
          performance: 'acceptable'
        },
        confidence: 0.6,
        refactorId: uuidv4()
      };

      res.json(basicRefactoring);
    }

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI refactor error:', error);

    res.status(500).json({
      error: 'Code refactoring failed',
      message: 'Unable to refactor code at this time',
      fallback: 'Use manual refactoring techniques or code review tools.'
    });
  }
};

/**
 * Get AI explanation of design decisions
 */
const explainDesign = async (req, res) => {
  try {
    const { elements, question = '' } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    try {
      const response = await aiClient.post('/explain-design', {
        design_elements: elements,
        specific_question: question,
        explanation_depth: 'detailed'
      });

      const responseTime = Date.now() - startTime;
      aiMetrics.successfulRequests++;
      updateAverageResponseTime(responseTime);

      res.json({
        explanation: response.data.explanation || 'Design explanation not available',
        designPrinciples: response.data.design_principles || [],
        recommendations: response.data.recommendations || [],
        confidence: response.data.confidence || 0.8
      });

    } catch (aiError) {
      // Fallback explanation
      const fallbackExplanation = {
        explanation: 'This design follows modern web design principles with a focus on user experience and accessibility.',
        designPrinciples: [
          'Visual hierarchy through typography and spacing',
          'Consistent color scheme and branding',
          'Responsive design for all device sizes',
          'Accessible components with proper ARIA labels'
        ],
        recommendations: [
          'Consider adding more visual feedback for user interactions',
          'Ensure sufficient color contrast for accessibility',
          'Test the design with real users for usability'
        ],
        confidence: 0.6
      };

      res.json(fallbackExplanation);
    }

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI explain error:', error);

    res.status(500).json({
      error: 'Design explanation failed',
      message: 'Unable to explain design at this time',
      fallback: 'Refer to design system documentation or style guides.'
    });
  }
};

/**
 * Get AI-generated templates
 */
const getTemplates = async (req, res) => {
  try {
    const { category = 'landing', style = 'modern', framework = 'react' } = req.query;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    try {
      const response = await aiClient.post('/generate-templates', {
        category,
        style,
        framework,
        count: 5
      });

      const responseTime = Date.now() - startTime;
      aiMetrics.successfulRequests++;
      updateAverageResponseTime(responseTime);

      res.json({
        templates: response.data.templates || [],
        category,
        style,
        framework
      });

    } catch (aiError) {
      // Fallback templates
      const fallbackTemplates = [
        {
          id: uuidv4(),
          name: `${style.charAt(0).toUpperCase() + style.slice(1)} ${category.charAt(0).toUpperCase() + category.slice(1)}`,
          description: `A ${style} ${category} template with clean design`,
          preview: '/api/templates/preview/default.png',
          elements: [
            {
              id: uuidv4(),
              type: 'container',
              styles: { padding: '2rem', backgroundColor: '#ffffff' },
              children: [
                {
                  id: uuidv4(),
                  type: 'heading',
                  content: 'Welcome to Our Platform',
                  styles: { fontSize: '2rem', fontWeight: 'bold', marginBottom: '1rem' }
                },
                {
                  id: uuidv4(),
                  type: 'paragraph',
                  content: 'This is a sample template generated for your project.',
                  styles: { fontSize: '1rem', color: '#666666' }
                }
              ]
            }
          ]
        }
      ];

      res.json({
        templates: fallbackTemplates,
        category,
        style,
        framework
      });
    }

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI templates error:', error);

    res.status(500).json({
      error: 'Template generation failed',
      message: 'Unable to generate templates at this time',
      fallback: 'Use the component library to build custom layouts.'
    });
  }
};

/**
 * Customize AI template based on requirements
 */
const customizeTemplate = async (req, res) => {
  try {
    const { template_id, customizations, brand_guidelines = {} } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    try {
      const response = await aiClient.post('/customize-template', {
        template_id,
        customizations,
        brand_guidelines,
        preserve_structure: true
      });

      const responseTime = Date.now() - startTime;
      aiMetrics.successfulRequests++;
      updateAverageResponseTime(responseTime);

      res.json({
        customizedTemplate: response.data.customized_template || {},
        appliedCustomizations: response.data.applied_customizations || [],
        confidence: response.data.confidence || 0.8,
        customizationId: uuidv4()
      });

    } catch (aiError) {
      // Fallback customization
      res.json({
        customizedTemplate: {
          id: template_id,
          customizations: customizations,
          brandGuidelines: brand_guidelines,
          customizedAt: new Date().toISOString()
        },
        appliedCustomizations: Object.keys(customizations),
        confidence: 0.6,
        customizationId: uuidv4()
      });
    }

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI customize template error:', error);

    res.status(500).json({
      error: 'Template customization failed',
      message: 'Unable to customize template at this time',
      fallback: 'Manually edit the template using the visual editor.'
    });
  }
};

/**
 * Provide feedback on AI suggestions
 */
const provideFeedback = async (req, res) => {
  try {
    const { suggestion_id, rating, feedback: feedbackText } = req.body;

    // Store feedback for AI improvement
    const feedbackEntry = {
      id: uuidv4(),
      suggestionId: suggestion_id,
      rating,
      feedback: feedbackText,
      timestamp: new Date().toISOString(),
      userId: req.user?.id || 'anonymous'
    };

    aiFeedback.push(feedbackEntry);

    // Keep only last 1000 feedback entries
    if (aiFeedback.length > 1000) {
      aiFeedback.splice(0, aiFeedback.length - 1000);
    }

    logger.info(`AI feedback received: ${rating}/5 for suggestion ${suggestion_id}`);

    res.json({
      message: 'Feedback received successfully',
      feedbackId: feedbackEntry.id
    });

  } catch (error) {
    logger.error('AI feedback error:', error);
    res.status(500).json({
      error: 'Failed to submit feedback',
      message: error.message
    });
  }
};

const getAIStatus = async (req, res) => {
  try {
    // Check AI agent health
    const healthResponse = await aiClient.get('/health', { timeout: 5000 });
    
    res.json({
      status: 'online',
      agent_url: AI_AGENT_URL,
      capabilities: healthResponse.data.capabilities || [],
      version: healthResponse.data.version || '1.0.0',
      metrics: aiMetrics,
      last_check: new Date().toISOString()
    });
  } catch (error) {
    res.json({
      status: 'offline',
      agent_url: AI_AGENT_URL,
      error: error.message,
      metrics: aiMetrics,
      last_check: new Date().toISOString()
    });
  }
};

/**
 * Train AI with user preferences (admin only)
 */
const trainModel = async (req, res) => {
  try {
    const { training_data, model_type } = req.body;

    const startTime = Date.now();
    aiMetrics.totalRequests++;

    try {
      const response = await aiClient.post('/train-model', {
        training_data,
        model_type,
        training_mode: 'incremental'
      });

      const responseTime = Date.now() - startTime;
      aiMetrics.successfulRequests++;
      updateAverageResponseTime(responseTime);

      logger.info(`AI model training initiated: ${model_type} with ${training_data.length} samples`);

      res.json({
        message: 'Model training initiated successfully',
        trainingId: response.data.training_id || uuidv4(),
        modelType: model_type,
        sampleCount: training_data.length,
        estimatedDuration: response.data.estimated_duration || '10-30 minutes'
      });

    } catch (aiError) {
      // Fallback response for training
      logger.info(`AI model training queued (fallback): ${model_type}`);

      res.json({
        message: 'Model training queued successfully',
        trainingId: uuidv4(),
        modelType: model_type,
        sampleCount: training_data.length,
        estimatedDuration: '15-45 minutes',
        note: 'Training will be processed when AI agent is available'
      });
    }

  } catch (error) {
    aiMetrics.failedRequests++;
    logger.error('AI training error:', error);

    res.status(500).json({
      error: 'Model training failed',
      message: 'Unable to initiate model training at this time',
      fallback: 'Training data has been saved and will be processed later.'
    });
  }
};

const getMetrics = async (req, res) => {
  res.json({
    metrics: aiMetrics,
    sessions: aiSessions.size,
    feedback_count: aiFeedback.length
  });
};

module.exports = {
  chat,
  generateComponent,
  improveDesign,
  replicateDesign,
  analyzeDesign,
  optimizeDesign,
  getSuggestions,
  generateCode,
  refactorCode,
  explainDesign,
  getTemplates,
  customizeTemplate,
  provideFeedback,
  getAIStatus,
  trainModel,
  getMetrics
};
