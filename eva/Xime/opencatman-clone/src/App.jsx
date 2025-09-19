import { useState } from 'react'
import Header from './components/Header'
import Hero from './components/Hero'
import Navigation from './components/Navigation'
import PlanogramViewer from './components/PlanogramViewer'
import Features from './components/Features'
import CTA from './components/CTA'
import Footer from './components/Footer'

// Import JSON data
import gondolaData from '../../../01_Gondola_Tradicional.json'
import endcapData from '../../../02_EndCap_Promocional.json'
import islandData from '../../../03_Isla_Promocional.json'
import crossData from '../../../04_Cross_Merchandising.json'
import verticalData from '../../../05_Vertical_Por_Marca.json'
import horizontalData from '../../../06_Horizontal_Por_Precio.json'
import seasonalData from '../../../07_Tematica_Estacional.json'

function App() {
  const [activeTab, setActiveTab] = useState('planograms')

  const planogramData = {
    traditional: gondolaData.planogram,
    endcap: endcapData.planogram,
    island: islandData.planogram,
    cross: crossData.planogram,
    vertical: verticalData.planogram,
    horizontal: horizontalData.planogram,
    seasonal: seasonalData.planogram
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <Header />
      <Hero />
      <Navigation activeTab={activeTab} setActiveTab={setActiveTab} />
      
      {activeTab === 'planograms' && (
        <PlanogramViewer planogramData={planogramData} />
      )}
      
      {activeTab === 'analytics' && (
        <div className="container mx-auto px-6 py-20 text-center">
          <div className="text-6xl mb-4">📊</div>
          <h2 className="text-3xl font-bold text-gray-800 mb-4">Analytics Avanzados</h2>
          <p className="text-gray-600 max-w-2xl mx-auto">
            Obtén insights profundos sobre el performance de tus productos con dashboards interactivos y reportes en tiempo real.
          </p>
        </div>
      )}
      
      {activeTab === 'optimization' && (
        <div className="container mx-auto px-6 py-20 text-center">
          <div className="text-6xl mb-4">🎯</div>
          <h2 className="text-3xl font-bold text-gray-800 mb-4">Optimización Inteligente</h2>
          <p className="text-gray-600 max-w-2xl mx-auto">
            Nuestra IA analiza patrones de compra y sugiere la ubicación óptima para cada producto, maximizando tus ventas.
          </p>
        </div>
      )}
      
      {activeTab === 'reports' && (
        <div className="container mx-auto px-6 py-20 text-center">
          <div className="text-6xl mb-4">📋</div>
          <h2 className="text-3xl font-bold text-gray-800 mb-4">Reportes Ejecutivos</h2>
          <p className="text-gray-600 max-w-2xl mx-auto">
            Genera reportes detallados para stakeholders con métricas clave y recomendaciones estratégicas.
          </p>
        </div>
      )}

      <Features />
      <CTA />
      <Footer />
    </div>
  )
}

export default App