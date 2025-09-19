import React, { useState, useCallback } from 'react';
import { useDropzone } from 'react-dropzone';
import { Upload, File, AlertCircle, CheckCircle, X } from 'lucide-react';
import axios from 'axios';

const FileUpload = ({ onFileUploaded }) => {
  const [uploadProgress, setUploadProgress] = useState(0);
  const [isUploading, setIsUploading] = useState(false);
  const [error, setError] = useState(null);
  const [selectedFile, setSelectedFile] = useState(null);

  const acceptedFormats = {
    'audio/*': ['.mp3', '.wav', '.m4a', '.aac', '.ogg', '.flac'],
    'video/*': ['.mp4', '.mov', '.avi', '.mkv', '.webm', '.m4v']
  };

  const onDrop = useCallback((acceptedFiles, rejectedFiles) => {
    setError(null);
    
    if (rejectedFiles.length > 0) {
      setError('Formato de archivo no compatible. Por favor, selecciona un archivo de audio o video válido.');
      return;
    }

    if (acceptedFiles.length > 0) {
      const file = acceptedFiles[0];
      
      // Verificar tamaño (máximo 500MB)
      if (file.size > 500 * 1024 * 1024) {
        setError('El archivo es demasiado grande. El tamaño máximo permitido es 500MB.');
        return;
      }

      setSelectedFile(file);
    }
  }, []);

  const { getRootProps, getInputProps, isDragActive } = useDropzone({
    onDrop,
    accept: acceptedFormats,
    multiple: false,
    maxSize: 500 * 1024 * 1024 // 500MB
  });

  const uploadFile = async () => {
    if (!selectedFile) return;

    setIsUploading(true);
    setUploadProgress(0);
    setError(null);

    const formData = new FormData();
    formData.append('file', selectedFile);

    try {
      const response = await axios.post('/api/upload', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        onUploadProgress: (progressEvent) => {
          const progress = Math.round(
            (progressEvent.loaded * 100) / progressEvent.total
          );
          setUploadProgress(progress);
        },
      });

      if (response.data.task_id) {
        onFileUploaded(response.data.task_id);
      }
    } catch (err) {
      setError(
        err.response?.data?.detail || 
        'Error al subir el archivo. Por favor, inténtalo de nuevo.'
      );
    } finally {
      setIsUploading(false);
    }
  };

  const removeFile = () => {
    setSelectedFile(null);
    setError(null);
    setUploadProgress(0);
  };

  const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  };

  return (
    <div className="animate-fadeInUp">
      {/* Título y descripción */}
      <div className="text-center mb-8">
        <h2 className="text-3xl font-bold text-gray-900 dark:text-white mb-4">
          Sube tu archivo de audio o video
        </h2>
        <p className="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Transcribe automáticamente archivos de hasta 4 horas con separación por voces 
          y exportación en múltiples formatos profesionales.
        </p>
      </div>

      {/* Zona de carga */}
      <div className="card p-8 mb-6">
        <div
          {...getRootProps()}
          className={`
            border-2 border-dashed rounded-xl p-12 text-center cursor-pointer transition-all duration-300
            ${isDragActive 
              ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' 
              : 'border-gray-300 dark:border-gray-600 hover:border-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700/50'
            }
          `}
        >
          <input {...getInputProps()} />
          
          <div className="flex flex-col items-center space-y-4">
            <div className={`
              w-16 h-16 rounded-full flex items-center justify-center transition-colors duration-300
              ${isDragActive 
                ? 'bg-primary-100 dark:bg-primary-900/30' 
                : 'bg-gray-100 dark:bg-gray-700'
              }
            `}>
              <Upload className={`w-8 h-8 ${isDragActive ? 'text-primary-600' : 'text-gray-500'}`} />
            </div>
            
            <div>
              <p className="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                {isDragActive ? 'Suelta el archivo aquí' : 'Arrastra tu archivo aquí'}
              </p>
              <p className="text-gray-600 dark:text-gray-400 mb-4">
                o haz clic para seleccionar
              </p>
              <p className="text-sm text-gray-500 dark:text-gray-500">
                Formatos soportados: MP3, WAV, MP4, MOV, AVI, MKV (máx. 500MB)
              </p>
            </div>
          </div>
        </div>

        {/* Archivo seleccionado */}
        {selectedFile && (
          <div className="mt-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
            <div className="flex items-center justify-between">
              <div className="flex items-center space-x-3">
                <File className="w-8 h-8 text-primary-600" />
                <div>
                  <p className="font-medium text-gray-900 dark:text-white">
                    {selectedFile.name}
                  </p>
                  <p className="text-sm text-gray-600 dark:text-gray-400">
                    {formatFileSize(selectedFile.size)}
                  </p>
                </div>
              </div>
              
              {!isUploading && (
                <button
                  onClick={removeFile}
                  className="p-2 text-gray-500 hover:text-red-500 transition-colors duration-200"
                >
                  <X className="w-5 h-5" />
                </button>
              )}
            </div>

            {/* Barra de progreso */}
            {isUploading && (
              <div className="mt-4">
                <div className="flex justify-between text-sm text-gray-600 dark:text-gray-400 mb-2">
                  <span>Subiendo archivo...</span>
                  <span>{uploadProgress}%</span>
                </div>
                <div className="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                  <div
                    className="bg-primary-600 h-2 rounded-full transition-all duration-300"
                    style={{ width: `${uploadProgress}%` }}
                  ></div>
                </div>
              </div>
            )}

            {/* Botón de subida */}
            {!isUploading && (
              <div className="mt-4 flex justify-end">
                <button
                  onClick={uploadFile}
                  className="btn-primary flex items-center space-x-2"
                >
                  <Upload className="w-4 h-4" />
                  <span>Subir y procesar</span>
                </button>
              </div>
            )}
          </div>
        )}

        {/* Mensajes de error */}
        {error && (
          <div className="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <div className="flex items-center space-x-2">
              <AlertCircle className="w-5 h-5 text-red-500" />
              <p className="text-red-700 dark:text-red-400">{error}</p>
            </div>
          </div>
        )}
      </div>

      {/* Información adicional */}
      <div className="grid md:grid-cols-3 gap-6 text-center">
        <div className="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
          <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
            <CheckCircle className="w-6 h-6 text-blue-600" />
          </div>
          <h3 className="font-semibold text-gray-900 dark:text-white mb-2">
            Separación por voces
          </h3>
          <p className="text-sm text-gray-600 dark:text-gray-400">
            Identifica automáticamente diferentes hablantes en tu audio
          </p>
        </div>

        <div className="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
          <div className="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
            <File className="w-6 h-6 text-green-600" />
          </div>
          <h3 className="font-semibold text-gray-900 dark:text-white mb-2">
            Múltiples formatos
          </h3>
          <p className="text-sm text-gray-600 dark:text-gray-400">
            Exporta en PDF, DOCX o TXT con formato APA, BOEM o libre
          </p>
        </div>

        <div className="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
          <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mx-auto mb-4">
            <Upload className="w-6 h-6 text-purple-600" />
          </div>
          <h3 className="font-semibold text-gray-900 dark:text-white mb-2">
            Archivos largos
          </h3>
          <p className="text-sm text-gray-600 dark:text-gray-400">
            Procesa audios y videos de hasta 4 horas o más
          </p>
        </div>
      </div>
    </div>
  );
};

export default FileUpload;
