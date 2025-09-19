function Features() {
  const features = [
    { icon: '📊', title: 'Analytics Avanzados', desc: 'Métricas en tiempo real de performance de productos' },
    { icon: '🎯', title: 'Optimización Automática', desc: 'IA que sugiere mejores ubicaciones de productos' },
    { icon: '📱', title: 'Mobile First', desc: 'Acceso completo desde cualquier dispositivo' },
    { icon: '🔄', title: 'Sincronización', desc: 'Datos actualizados en tiempo real en todas las tiendas' },
    { icon: '📈', title: 'ROI Tracking', desc: 'Seguimiento del retorno de inversión por categoría' },
    { icon: '🛡️', title: 'Seguridad Enterprise', desc: 'Protección de datos nivel empresarial' }
  ]

  return (
    <section className="bg-gray-100 py-16">
      <div className="container mx-auto px-6">
        <div className="text-center mb-12">
          <h2 className="text-3xl font-bold text-gray-800 mb-4">¿Por qué OpenCatman?</h2>
          <p className="text-gray-600 max-w-2xl mx-auto">
            La plataforma más completa para category management, diseñada por expertos en retail
          </p>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          {features.map((feature, idx) => (
            <div key={idx} className="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow hover:scale-105 transform transition-transform">
              <div className="text-4xl mb-4">{feature.icon}</div>
              <h3 className="text-xl font-bold text-gray-800 mb-2">{feature.title}</h3>
              <p className="text-gray-600">{feature.desc}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

export default Features