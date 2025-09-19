import React from 'react';
import { X, Mic, Users, FileText, Download, CheckCircle } from 'lucide-react';

const WelcomeModal = ({ onClose }) => {
  const features = [
    {
      icon: Mic,
      title: 'Transcripción con IA',
      description: 'Convierte audio y video a texto usando tecnología de vanguardia'
    },
    {
      icon: Users,
      title: 'Separación por voces',
      description: 'Identifica automáticamente diferentes hablantes en tu archivo'
    },
    {
      icon: FileText,
      title: 'Múltiples formatos',
      description: 'Exporta en PDF, DOCX o TXT con formato APA, BOEM o libre'
    },
    {
      icon: Download,
      title: 'Archivos largos',
      description: 'Procesa audios y videos de hasta 4 horas o más'
    }
  ];

  const steps = [
    'Sube tu archivo de audio o video',
    'Espera mientras procesamos con IA',
    'Revisa la transcripción organizada',
    'Descarga en el formato que prefieras'
  ];

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div className="bg-white dark:bg-gray-800 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        {/* Header */}
        <div className="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
          <div className="flex items-center space-x-3">
            <div className="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
              <Mic className="w-6 h-6 text-white" />
            </div>
            <div>
              <h2 className="text-xl font-bold text-gray-900 dark:text-white">
                ¡Bienvenido a Transcripto KD!
              </h2>
              <p className="text-sm text-gray-600 dark:text-gray-400">
                Transcripción inteligente con IA
              </p>
            </div>
          </div>
          <button
            onClick={onClose}
            className="p-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-200"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Content */}
        <div className="p-6">
          {/* Descripción principal */}
          <div className="text-center mb-8">
            <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-3">
              Transcripción inteligente de audios y videos largos
            </h3>
            <p className="text-gray-600 dark:text-gray-400 leading-relaxed">
              Convierte tus archivos de audio y video en transcripciones profesionales 
              con separación automática por voces, timestamps y múltiples formatos de exportación.
            </p>
          </div>

          {/* Características */}
          <div className="mb-8">
            <h4 className="text-md font-semibold text-gray-900 dark:text-white mb-4">
              ✨ Características principales
            </h4>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {features.map((feature, index) => {
                const Icon = feature.icon;
                return (
                  <div key={index} className="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div className="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                      <Icon className="w-4 h-4 text-primary-600" />
                    </div>
                    <div>
                      <h5 className="font-medium text-gray-900 dark:text-white text-sm">
                        {feature.title}
                      </h5>
                      <p className="text-xs text-gray-600 dark:text-gray-400 mt-1">
                        {feature.description}
                      </p>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Pasos */}
          <div className="mb-8">
            <h4 className="text-md font-semibold text-gray-900 dark:text-white mb-4">
              🚀 Cómo funciona
            </h4>
            <div className="space-y-3">
              {steps.map((step, index) => (
                <div key={index} className="flex items-center space-x-3">
                  <div className="w-6 h-6 bg-primary-600 text-white rounded-full flex items-center justify-center text-xs font-bold">
                    {index + 1}
                  </div>
                  <span className="text-gray-700 dark:text-gray-300 text-sm">
                    {step}
                  </span>
                </div>
              ))}
            </div>
          </div>

          {/* Formatos soportados */}
          <div className="mb-8">
            <h4 className="text-md font-semibold text-gray-900 dark:text-white mb-4">
              📁 Formatos soportados
            </h4>
            <div className="grid grid-cols-2 gap-4 text-sm">
              <div>
                <h5 className="font-medium text-gray-700 dark:text-gray-300 mb-2">Audio</h5>
                <div className="space-y-1 text-gray-600 dark:text-gray-400">
                  <div>• MP3, WAV, M4A</div>
                  <div>• AAC, OGG, FLAC</div>
                </div>
              </div>
              <div>
                <h5 className="font-medium text-gray-700 dark:text-gray-300 mb-2">Video</h5>
                <div className="space-y-1 text-gray-600 dark:text-gray-400">
                  <div>• MP4, MOV, AVI</div>
                  <div>• MKV, WEBM, M4V</div>
                </div>
              </div>
            </div>
          </div>

          {/* Límites */}
          <div className="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg mb-6">
            <div className="flex items-start space-x-2">
              <CheckCircle className="w-5 h-5 text-blue-600 mt-0.5" />
              <div>
                <h5 className="font-medium text-blue-800 dark:text-blue-300 text-sm">
                  Límites del sistema
                </h5>
                <ul className="text-xs text-blue-700 dark:text-blue-400 mt-1 space-y-1">
                  <li>• Tamaño máximo: 500MB por archivo</li>
                  <li>• Duración máxima: 4+ horas</li>
                  <li>• Idiomas: Español, Inglés y más</li>
                </ul>
              </div>
            </div>
          </div>

          {/* Botón de acción */}
          <div className="text-center">
            <button
              onClick={onClose}
              className="btn-primary px-8 py-3 text-lg"
            >
              ¡Comenzar ahora!
            </button>
            <p className="text-xs text-gray-500 dark:text-gray-500 mt-3">
              Este mensaje no se mostrará nuevamente
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default WelcomeModal;
