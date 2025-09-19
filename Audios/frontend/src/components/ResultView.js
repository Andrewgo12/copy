import React, { useState } from 'react';
import { 
  Download, 
  Copy, 
  FileText, 
  Users, 
  Clock, 
  CheckCircle,
  RefreshCw,
  Settings
} from 'lucide-react';
import axios from 'axios';

const ResultView = ({ taskId, data, onStartNew }) => {
  const [selectedFormat, setSelectedFormat] = useState('APA');
  const [selectedExport, setSelectedExport] = useState('pdf');
  const [isDownloading, setIsDownloading] = useState(false);
  const [copySuccess, setCopySuccess] = useState(false);

  const formats = [
    { id: 'APA', name: 'APA', description: 'Formato académico estándar' },
    { id: 'BOEM', name: 'BOEM', description: 'Formato de entrevistas' },
    { id: 'FREE', name: 'Libre', description: 'Formato personalizable' }
  ];

  const exportFormats = [
    { id: 'pdf', name: 'PDF', icon: FileText, description: 'Documento portable' },
    { id: 'docx', name: 'Word', icon: FileText, description: 'Microsoft Word' },
    { id: 'txt', name: 'Texto', icon: FileText, description: 'Texto plano' }
  ];

  const handleDownload = async () => {
    setIsDownloading(true);
    try {
      const response = await axios.get(
        `/api/download/${taskId}?format=${selectedExport}&style=${selectedFormat}`,
        { responseType: 'blob' }
      );

      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      
      const extension = selectedExport === 'docx' ? 'docx' : selectedExport;
      link.setAttribute('download', `transcripcion_${taskId}.${extension}`);
      
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(url);
    } catch (error) {
      console.error('Error al descargar:', error);
    } finally {
      setIsDownloading(false);
    }
  };

  const handleCopyText = async () => {
    try {
      const fullText = data.speakers.map(speaker => 
        `${speaker.name}:\n${speaker.segments.map(segment => 
          `[${segment.timestamp}] ${segment.text}`
        ).join('\n')}`
      ).join('\n\n');
      
      await navigator.clipboard.writeText(fullText);
      setCopySuccess(true);
      setTimeout(() => setCopySuccess(false), 2000);
    } catch (error) {
      console.error('Error al copiar:', error);
    }
  };

  const formatDuration = (seconds) => {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = Math.floor(seconds % 60);
    
    if (hours > 0) {
      return `${hours}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
    }
    return `${minutes}:${secs.toString().padStart(2, '0')}`;
  };

  if (!data) {
    return <div>Cargando resultados...</div>;
  }

  return (
    <div className="animate-fadeInUp">
      {/* Encabezado con estadísticas */}
      <div className="card p-6 mb-6">
        <div className="flex items-center justify-between mb-6">
          <div>
            <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-2">
              Transcripción completada
            </h2>
            <p className="text-gray-600 dark:text-gray-400">
              Tu archivo ha sido procesado exitosamente
            </p>
          </div>
          <div className="flex items-center space-x-2">
            <CheckCircle className="w-8 h-8 text-green-500" />
          </div>
        </div>

        {/* Estadísticas */}
        <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div className="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
            <div className="flex items-center space-x-2">
              <Clock className="w-5 h-5 text-blue-600" />
              <span className="text-sm font-medium text-blue-700 dark:text-blue-400">
                Duración
              </span>
            </div>
            <p className="text-lg font-bold text-blue-900 dark:text-blue-300 mt-1">
              {formatDuration(data.duration)}
            </p>
          </div>

          <div className="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
            <div className="flex items-center space-x-2">
              <Users className="w-5 h-5 text-green-600" />
              <span className="text-sm font-medium text-green-700 dark:text-green-400">
                Voces detectadas
              </span>
            </div>
            <p className="text-lg font-bold text-green-900 dark:text-green-300 mt-1">
              {data.speakers.length}
            </p>
          </div>

          <div className="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
            <div className="flex items-center space-x-2">
              <FileText className="w-5 h-5 text-purple-600" />
              <span className="text-sm font-medium text-purple-700 dark:text-purple-400">
                Palabras
              </span>
            </div>
            <p className="text-lg font-bold text-purple-900 dark:text-purple-300 mt-1">
              {data.word_count}
            </p>
          </div>

          <div className="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
            <div className="flex items-center space-x-2">
              <Settings className="w-5 h-5 text-orange-600" />
              <span className="text-sm font-medium text-orange-700 dark:text-orange-400">
                Confianza
              </span>
            </div>
            <p className="text-lg font-bold text-orange-900 dark:text-orange-300 mt-1">
              {Math.round(data.confidence * 100)}%
            </p>
          </div>
        </div>
      </div>

      {/* Controles de formato y descarga */}
      <div className="card p-6 mb-6">
        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
          Opciones de exportación
        </h3>
        
        <div className="grid md:grid-cols-2 gap-6">
          {/* Selector de formato */}
          <div>
            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
              Formato de texto
            </label>
            <div className="space-y-2">
              {formats.map((format) => (
                <label key={format.id} className="flex items-center">
                  <input
                    type="radio"
                    name="format"
                    value={format.id}
                    checked={selectedFormat === format.id}
                    onChange={(e) => setSelectedFormat(e.target.value)}
                    className="mr-3 text-primary-600 focus:ring-primary-500"
                  />
                  <div>
                    <span className="font-medium text-gray-900 dark:text-white">
                      {format.name}
                    </span>
                    <p className="text-sm text-gray-600 dark:text-gray-400">
                      {format.description}
                    </p>
                  </div>
                </label>
              ))}
            </div>
          </div>

          {/* Selector de tipo de archivo */}
          <div>
            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
              Tipo de archivo
            </label>
            <div className="grid grid-cols-3 gap-2">
              {exportFormats.map((format) => {
                const Icon = format.icon;
                return (
                  <button
                    key={format.id}
                    onClick={() => setSelectedExport(format.id)}
                    className={`
                      p-3 rounded-lg border-2 transition-all duration-200 text-center
                      ${selectedExport === format.id
                        ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20'
                        : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500'
                      }
                    `}
                  >
                    <Icon className={`w-6 h-6 mx-auto mb-1 ${
                      selectedExport === format.id ? 'text-primary-600' : 'text-gray-500'
                    }`} />
                    <p className={`text-sm font-medium ${
                      selectedExport === format.id 
                        ? 'text-primary-700 dark:text-primary-400' 
                        : 'text-gray-700 dark:text-gray-300'
                    }`}>
                      {format.name}
                    </p>
                    <p className="text-xs text-gray-500 dark:text-gray-500">
                      {format.description}
                    </p>
                  </button>
                );
              })}
            </div>
          </div>
        </div>

        {/* Botones de acción */}
        <div className="flex flex-wrap gap-3 mt-6">
          <button
            onClick={handleDownload}
            disabled={isDownloading}
            className="btn-primary flex items-center space-x-2"
          >
            {isDownloading ? (
              <RefreshCw className="w-4 h-4 animate-spin" />
            ) : (
              <Download className="w-4 h-4" />
            )}
            <span>
              {isDownloading ? 'Descargando...' : `Descargar ${selectedExport.toUpperCase()}`}
            </span>
          </button>

          <button
            onClick={handleCopyText}
            className="btn-secondary flex items-center space-x-2"
          >
            {copySuccess ? (
              <CheckCircle className="w-4 h-4 text-green-600" />
            ) : (
              <Copy className="w-4 h-4" />
            )}
            <span>{copySuccess ? 'Copiado!' : 'Copiar texto'}</span>
          </button>

          <button
            onClick={onStartNew}
            className="btn-secondary flex items-center space-x-2"
          >
            <RefreshCw className="w-4 h-4" />
            <span>Nueva transcripción</span>
          </button>
        </div>
      </div>

      {/* Transcripción */}
      <div className="card p-6">
        <h3 className="text-lg font-semibold text-gray-900 dark:text-white mb-4">
          Transcripción por voces
        </h3>
        
        <div className="space-y-6">
          {data.speakers.map((speaker, index) => (
            <div key={index} className="border-l-4 border-primary-500 pl-4">
              <h4 className="font-semibold text-primary-700 dark:text-primary-400 mb-3">
                {speaker.name}
              </h4>
              
              <div className="space-y-3">
                {speaker.segments.map((segment, segIndex) => (
                  <div key={segIndex} className="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <div className="flex items-center justify-between mb-2">
                      <span className="text-xs font-mono text-gray-500 dark:text-gray-400">
                        {segment.timestamp}
                      </span>
                      <span className="text-xs text-gray-500 dark:text-gray-400">
                        Confianza: {Math.round(segment.confidence * 100)}%
                      </span>
                    </div>
                    <p className="text-gray-900 dark:text-gray-100 leading-relaxed">
                      {segment.text}
                    </p>
                  </div>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default ResultView;
