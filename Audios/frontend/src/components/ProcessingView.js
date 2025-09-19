import React, { useState, useEffect } from 'react';
import { Loader2, Mic, Users, FileText, CheckCircle, Clock } from 'lucide-react';
import axios from 'axios';

const ProcessingView = ({ taskId, onComplete }) => {
  const [status, setStatus] = useState('processing');
  const [progress, setProgress] = useState(0);
  const [currentStep, setCurrentStep] = useState('upload');
  const [estimatedTime, setEstimatedTime] = useState(null);
  const [error, setError] = useState(null);

  const steps = [
    {
      id: 'upload',
      name: 'Archivo recibido',
      description: 'Procesando archivo de audio/video...',
      icon: FileText,
      color: 'blue'
    },
    {
      id: 'audio_extraction',
      name: 'Extrayendo audio',
      description: 'Convirtiendo y optimizando audio...',
      icon: Mic,
      color: 'purple'
    },
    {
      id: 'transcription',
      name: 'Transcribiendo',
      description: 'Convirtiendo audio a texto con IA...',
      icon: FileText,
      color: 'green'
    },
    {
      id: 'speaker_separation',
      name: 'Separando voces',
      description: 'Identificando diferentes hablantes...',
      icon: Users,
      color: 'orange'
    },
    {
      id: 'formatting',
      name: 'Organizando resultado',
      description: 'Aplicando formato y timestamps...',
      icon: CheckCircle,
      color: 'emerald'
    }
  ];

  useEffect(() => {
    if (!taskId) return;

    const checkStatus = async () => {
      try {
        const response = await axios.get(`/api/status/${taskId}`);
        const data = response.data;

        setStatus(data.status);
        setProgress(data.progress || 0);
        setCurrentStep(data.current_step || 'upload');
        setEstimatedTime(data.estimated_time);

        if (data.status === 'completed') {
          // Obtener el resultado completo
          const resultResponse = await axios.get(`/api/result/${taskId}`);
          onComplete(resultResponse.data);
        } else if (data.status === 'failed') {
          setError(data.error || 'Error durante el procesamiento');
        }
      } catch (err) {
        setError('Error al verificar el estado del procesamiento');
      }
    };

    // Verificar estado inmediatamente
    checkStatus();

    // Continuar verificando cada 2 segundos
    const interval = setInterval(checkStatus, 2000);

    return () => clearInterval(interval);
  }, [taskId, onComplete]);

  const getStepStatus = (stepId) => {
    const stepIndex = steps.findIndex(step => step.id === stepId);
    const currentIndex = steps.findIndex(step => step.id === currentStep);
    
    if (stepIndex < currentIndex) return 'completed';
    if (stepIndex === currentIndex) return 'current';
    return 'pending';
  };

  const formatTime = (seconds) => {
    if (!seconds) return '';
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
  };

  if (error) {
    return (
      <div className="animate-fadeInUp">
        <div className="card p-8 text-center">
          <div className="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
            <FileText className="w-8 h-8 text-red-600" />
          </div>
          <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Error en el procesamiento
          </h2>
          <p className="text-gray-600 dark:text-gray-400 mb-6">
            {error}
          </p>
          <button
            onClick={() => window.location.reload()}
            className="btn-primary"
          >
            Intentar de nuevo
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="animate-fadeInUp">
      {/* Encabezado */}
      <div className="text-center mb-8">
        <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
          Procesando tu archivo
        </h2>
        <p className="text-lg text-gray-600 dark:text-gray-400">
          Nuestro sistema de IA está trabajando en tu transcripción
        </p>
      </div>

      {/* Barra de progreso principal */}
      <div className="card p-6 mb-8">
        <div className="flex items-center justify-between mb-4">
          <span className="text-sm font-medium text-gray-700 dark:text-gray-300">
            Progreso general
          </span>
          <span className="text-sm font-medium text-primary-600">
            {progress}%
          </span>
        </div>
        <div className="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
          <div
            className="bg-gradient-to-r from-primary-500 to-primary-600 h-3 rounded-full transition-all duration-500 ease-out"
            style={{ width: `${progress}%` }}
          ></div>
        </div>
        
        {estimatedTime && (
          <div className="flex items-center justify-center mt-4 text-sm text-gray-600 dark:text-gray-400">
            <Clock className="w-4 h-4 mr-2" />
            <span>Tiempo estimado restante: {formatTime(estimatedTime)}</span>
          </div>
        )}
      </div>

      {/* Pasos del procesamiento */}
      <div className="card p-6">
        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-6">
          Pasos del procesamiento
        </h3>
        
        <div className="space-y-4">
          {steps.map((step, index) => {
            const stepStatus = getStepStatus(step.id);
            const Icon = step.icon;
            
            return (
              <div
                key={step.id}
                className={`
                  flex items-center p-4 rounded-lg transition-all duration-300
                  ${stepStatus === 'current' 
                    ? 'bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800' 
                    : stepStatus === 'completed'
                    ? 'bg-green-50 dark:bg-green-900/20'
                    : 'bg-gray-50 dark:bg-gray-700'
                  }
                `}
              >
                <div className={`
                  w-10 h-10 rounded-full flex items-center justify-center mr-4
                  ${stepStatus === 'current'
                    ? 'bg-blue-100 dark:bg-blue-900/30'
                    : stepStatus === 'completed'
                    ? 'bg-green-100 dark:bg-green-900/30'
                    : 'bg-gray-200 dark:bg-gray-600'
                  }
                `}>
                  {stepStatus === 'current' ? (
                    <Loader2 className="w-5 h-5 text-blue-600 animate-spin" />
                  ) : stepStatus === 'completed' ? (
                    <CheckCircle className="w-5 h-5 text-green-600" />
                  ) : (
                    <Icon className="w-5 h-5 text-gray-500" />
                  )}
                </div>
                
                <div className="flex-1">
                  <h4 className={`
                    font-medium
                    ${stepStatus === 'current'
                      ? 'text-gray-900 dark:text-white'
                      : stepStatus === 'completed'
                      ? 'text-green-700 dark:text-green-400'
                      : 'text-gray-600 dark:text-gray-400'
                    }
                  `}>
                    {step.name}
                  </h4>
                  <p className={`
                    text-sm
                    ${stepStatus === 'current'
                      ? 'text-gray-700 dark:text-gray-300'
                      : 'text-gray-500 dark:text-gray-500'
                    }
                  `}>
                    {step.description}
                  </p>
                </div>

                {stepStatus === 'current' && (
                  <div className="ml-4">
                    <div className="flex space-x-1">
                      <div className="w-2 h-2 bg-primary-600 rounded-full animate-bounce"></div>
                      <div className="w-2 h-2 bg-primary-600 rounded-full animate-bounce" style={{ animationDelay: '0.1s' }}></div>
                      <div className="w-2 h-2 bg-primary-600 rounded-full animate-bounce" style={{ animationDelay: '0.2s' }}></div>
                    </div>
                  </div>
                )}
              </div>
            );
          })}
        </div>
      </div>

      {/* Información adicional */}
      <div className="mt-8 text-center">
        <div className="inline-flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
          <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
          <span>Sistema procesando - No cierres esta ventana</span>
        </div>
      </div>
    </div>
  );
};

export default ProcessingView;
