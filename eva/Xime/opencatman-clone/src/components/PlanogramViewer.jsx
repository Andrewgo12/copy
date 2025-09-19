import { useState } from 'react'

function PlanogramViewer({ planogramData }) {
  const [selectedPlanogram, setSelectedPlanogram] = useState('traditional')

  const planogramTypes = [
    { id: 'traditional', name: 'Góndola Tradicional', icon: '🏪', color: 'bg-blue-500' },
    { id: 'endcap', name: 'End-Cap Promocional', icon: '🎯', color: 'bg-red-500' },
    { id: 'island', name: 'Isla Promocional', icon: '🏝️', color: 'bg-orange-500' },
    { id: 'cross', name: 'Cross Merchandising', icon: '🔄', color: 'bg-green-500' },
    { id: 'vertical', name: 'Vertical por Marca', icon: '📊', color: 'bg-purple-500' },
    { id: 'horizontal', name: 'Horizontal por Precio', icon: '📈', color: 'bg-yellow-500' },
    { id: 'seasonal', name: 'Temática Estacional', icon: '🎄', color: 'bg-pink-500' }
  ]

  const currentPlanogram = planogramData[selectedPlanogram]
  const currentType = planogramTypes.find(t => t.id === selectedPlanogram)

  const renderTraditionalGondola = () => (
    <div className="bg-white rounded-xl p-6 shadow-lg">
      <div className={`${currentType.color} text-white p-4 rounded-lg mb-4`}>
        <div className="flex items-center space-x-3">
          <span className="text-3xl">{currentType.icon}</span>
          <div>
            <h3 className="text-xl font-bold">{currentType.name}</h3>
            <p className="text-sm opacity-90">{currentPlanogram.description}</p>
          </div>
        </div>
      </div>
      
      <div className="space-y-3">
        {currentPlanogram.shelves?.map((shelf, idx) => (
          <div key={idx} className="border-2 border-gray-200 rounded-lg overflow-hidden">
            <div className="bg-gray-100 p-3 border-b">
              <h4 className="font-bold text-gray-800">
                NIVEL {shelf.level} - {shelf.category}
                {shelf.eye_level && <span className="ml-2 text-red-600 text-sm">👁️ NIVEL VISUAL</span>}
              </h4>
            </div>
            <div className="grid grid-cols-5 gap-2 p-4">
              {shelf.products?.map((product, pidx) => (
                <div key={pidx} className="bg-gray-50 border rounded-lg p-3 text-center hover:shadow-md transition-shadow">
                  <div className="text-2xl mb-2">📦</div>
                  <h5 className="font-semibold text-xs mb-1">{product.name}</h5>
                  <p className="text-gray-500 text-xs">{product.brand}</p>
                  <div className="bg-yellow-100 border border-yellow-400 rounded px-2 py-1 mt-2">
                    <div className="text-sm font-bold text-orange-700">${product.price}</div>
                  </div>
                </div>
              ))}
            </div>
          </div>
        ))}
      </div>
    </div>
  )

  const renderGenericPlanogram = () => (
    <div className="bg-white rounded-xl p-6 shadow-lg">
      <div className={`${currentType.color} text-white p-4 rounded-lg mb-4`}>
        <div className="flex items-center space-x-3">
          <span className="text-3xl">{currentType.icon}</span>
          <div>
            <h3 className="text-xl font-bold">{currentType.name}</h3>
            <p className="text-sm opacity-90">{currentPlanogram.description}</p>
          </div>
        </div>
      </div>
      
      <div className="grid grid-cols-5 gap-3 mb-4">
        {[...Array(25)].map((_, i) => (
          <div key={i} className="bg-gray-100 border-2 border-gray-200 rounded-lg p-3 text-center hover:bg-gray-50 cursor-pointer transition-colors">
            <div className="text-2xl mb-1">📦</div>
            <div className="text-xs font-semibold">Producto {i+1}</div>
            <div className="text-xs text-gray-500">$29.99</div>
          </div>
        ))}
      </div>
      
      <div className="flex justify-between items-center">
        <div className="text-sm text-gray-600">
          <span className="font-semibold">25 productos</span> • 
          <span className="font-semibold"> 5 categorías</span>
        </div>
        <button className={`${currentType.color} text-white px-4 py-2 rounded-lg hover:opacity-90 transition-opacity`}>
          Editar Planograma
        </button>
      </div>
    </div>
  )

  return (
    <section className="py-12">
      <div className="container mx-auto px-6">
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          {/* Planogram Types */}
          <div className="lg:col-span-1">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">Tipos de Planogramas</h2>
            <div className="space-y-3">
              {planogramTypes.map(type => (
                <button
                  key={type.id}
                  onClick={() => setSelectedPlanogram(type.id)}
                  className={`w-full flex items-center space-x-3 p-4 rounded-lg border-2 transition-all hover:scale-105 ${
                    selectedPlanogram === type.id
                      ? `${type.color} text-white border-transparent`
                      : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'
                  }`}
                >
                  <span className="text-2xl">{type.icon}</span>
                  <span className="font-medium">{type.name}</span>
                </button>
              ))}
            </div>
          </div>

          {/* Planogram Preview */}
          <div className="lg:col-span-2">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">Vista Previa</h2>
            {selectedPlanogram === 'traditional' && currentPlanogram.shelves 
              ? renderTraditionalGondola() 
              : renderGenericPlanogram()
            }
          </div>
        </div>
      </div>
    </section>
  )
}

export default PlanogramViewer