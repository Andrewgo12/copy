import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Header from './components/Header';
import FileUpload from './components/FileUpload';
import ProcessingView from './components/ProcessingView';
import ResultView from './components/ResultView';
import WelcomeModal from './components/WelcomeModal';
import { Moon, Sun } from 'lucide-react';

function App() {
  const [darkMode, setDarkMode] = useState(false);
  const [currentStep, setCurrentStep] = useState('upload'); // upload, processing, result
  const [taskId, setTaskId] = useState(null);
  const [transcriptionData, setTranscriptionData] = useState(null);
  const [showWelcome, setShowWelcome] = useState(true);

  // Detectar preferencia de tema del sistema
  useEffect(() => {
    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    setDarkMode(isDark);
  }, []);

  // Aplicar tema
  useEffect(() => {
    if (darkMode) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  }, [darkMode]);

  // Verificar si ya se mostró el modal de bienvenida
  useEffect(() => {
    const hasSeenWelcome = localStorage.getItem('transcripto-kd-welcome');
    if (hasSeenWelcome) {
      setShowWelcome(false);
    }
  }, []);

  const toggleDarkMode = () => {
    setDarkMode(!darkMode);
  };

  const handleFileUploaded = (newTaskId) => {
    setTaskId(newTaskId);
    setCurrentStep('processing');
  };

  const handleProcessingComplete = (data) => {
    setTranscriptionData(data);
    setCurrentStep('result');
  };

  const handleStartNew = () => {
    setCurrentStep('upload');
    setTaskId(null);
    setTranscriptionData(null);
  };

  const handleCloseWelcome = () => {
    setShowWelcome(false);
    localStorage.setItem('transcripto-kd-welcome', 'true');
  };

  return (
    <Router>
      <div className="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 transition-colors duration-300">
        <Header darkMode={darkMode} toggleDarkMode={toggleDarkMode} />
        
        <main className="container mx-auto px-4 py-8">
          <Routes>
            <Route path="/" element={
              <div className="max-w-4xl mx-auto">
                {currentStep === 'upload' && (
                  <FileUpload onFileUploaded={handleFileUploaded} />
                )}
                
                {currentStep === 'processing' && (
                  <ProcessingView 
                    taskId={taskId} 
                    onComplete={handleProcessingComplete}
                  />
                )}
                
                {currentStep === 'result' && (
                  <ResultView 
                    taskId={taskId}
                    data={transcriptionData}
                    onStartNew={handleStartNew}
                  />
                )}
              </div>
            } />
          </Routes>
        </main>

        {/* Modal de bienvenida */}
        {showWelcome && (
          <WelcomeModal onClose={handleCloseWelcome} />
        )}

        {/* Botón flotante para cambiar tema */}
        <button
          onClick={toggleDarkMode}
          className="fixed bottom-6 right-6 p-3 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
          aria-label="Cambiar tema"
        >
          {darkMode ? <Sun size={20} /> : <Moon size={20} />}
        </button>
      </div>
    </Router>
  );
}

export default App;
