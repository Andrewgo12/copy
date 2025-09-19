function Header() {
  return (
    <header className="bg-white shadow-sm border-b">
      <div className="container mx-auto px-6 py-4">
        <div className="flex items-center justify-between">
          <div className="flex items-center space-x-4">
            <div className="bg-gradient-to-r from-purple-600 to-blue-600 p-3 rounded-xl">
              <span className="text-2xl text-white font-bold">OC</span>
            </div>
            <div>
              <h1 className="text-2xl font-bold text-gray-800">OpenCatman</h1>
              <p className="text-sm text-gray-600">Category Management Platform</p>
            </div>
          </div>
          <div className="flex items-center space-x-4">
            <button className="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors">
              Iniciar Sesión
            </button>
            <button className="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg hover:opacity-90 transition-opacity">
              Prueba Gratis
            </button>
          </div>
        </div>
      </div>
    </header>
  )
}

export default Header