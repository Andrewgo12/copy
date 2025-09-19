import React from 'react';
import { Mic, Headphones, FileText } from 'lucide-react';

const Header = ({ darkMode, toggleDarkMode }) => {
  return (
    <header className="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
      <div className="container mx-auto px-4 py-4">
        <div className="flex items-center justify-between">
          {/* Logo y título */}
          <div className="flex items-center space-x-3">
            <div className="relative">
              <div className="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center">
                <Mic className="w-6 h-6 text-white" />
              </div>
              <div className="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full flex items-center justify-center">
                <div className="w-2 h-2 bg-white rounded-full animate-pulse"></div>
              </div>
            </div>
            <div>
              <h1 className="text-2xl font-bold text-gray-900 dark:text-white">
                Transcripto KD
              </h1>
              <p className="text-sm text-gray-600 dark:text-gray-400">
                Transcripción inteligente con IA
              </p>
            </div>
          </div>

          {/* Características destacadas */}
          <div className="hidden md:flex items-center space-x-6">
            <div className="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
              <Headphones className="w-5 h-5" />
              <span className="text-sm font-medium">Separación por voces</span>
            </div>
            <div className="flex items-center space-x-2 text-gray-600 dark:text-gray-400">
              <FileText className="w-5 h-5" />
              <span className="text-sm font-medium">Múltiples formatos</span>
            </div>
          </div>

          {/* Indicador de estado */}
          <div className="flex items-center space-x-3">
            <div className="hidden sm:flex items-center space-x-2">
              <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
              <span className="text-sm text-gray-600 dark:text-gray-400">
                Sistema activo
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
