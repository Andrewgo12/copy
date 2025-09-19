function CTA() {
  return (
    <section className="bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 text-white py-16">
      <div className="container mx-auto px-6 text-center">
        <h2 className="text-3xl font-bold mb-4">¿Listo para optimizar tu retail?</h2>
        <p className="text-xl mb-8 opacity-90">
          Únete a más de 500 retailers que ya confían en OpenCatman
        </p>
        <div className="flex justify-center space-x-4">
          <button className="bg-white text-purple-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
            Comenzar Prueba Gratuita
          </button>
          <button className="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-purple-600 transition-colors">
            Hablar con Ventas
          </button>
        </div>
      </div>
    </section>
  )
}

export default CTA