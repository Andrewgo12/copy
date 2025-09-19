function Hero() {
  return (
    <section className="bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 text-white py-20">
      <div className="container mx-auto px-6 text-center">
        <h1 className="text-5xl font-bold mb-6">
          Revoluciona tu Category Management
        </h1>
        <p className="text-xl mb-8 max-w-3xl mx-auto opacity-90">
          La plataforma líder para optimizar planogramas, analizar performance y maximizar ventas en retail
        </p>
        <div className="flex justify-center space-x-4">
          <button className="bg-white text-purple-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 shadow-lg transition-colors">
            Ver Demo en Vivo
          </button>
          <button className="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-purple-600 transition-colors">
            Solicitar Cotización
          </button>
        </div>
      </div>
    </section>
  )
}

export default Hero