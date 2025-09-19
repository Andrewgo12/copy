function Navigation({ activeTab, setActiveTab }) {
  const tabs = [
    { id: 'planograms', name: 'Planogramas', icon: '📊' },
    { id: 'analytics', name: 'Analytics', icon: '📈' },
    { id: 'optimization', name: 'Optimización', icon: '🎯' },
    { id: 'reports', name: 'Reportes', icon: '📋' }
  ]

  return (
    <section className="bg-white border-b">
      <div className="container mx-auto px-6">
        <div className="flex space-x-8">
          {tabs.map(tab => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id)}
              className={`flex items-center space-x-2 py-4 px-6 border-b-2 transition-colors ${
                activeTab === tab.id 
                  ? 'border-purple-500 text-purple-600' 
                  : 'border-transparent text-gray-600 hover:text-gray-800'
              }`}
            >
              <span>{tab.icon}</span>
              <span className="font-medium">{tab.name}</span>
            </button>
          ))}
        </div>
      </div>
    </section>
  )
}

export default Navigation