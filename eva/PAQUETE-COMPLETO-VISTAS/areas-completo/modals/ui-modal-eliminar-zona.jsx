"use client"

import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog"
import { Button } from "@/components/ui/button"
import { AlertTriangle } from "lucide-react"

export default function UIModalEliminarZona({ isOpen, onClose, zona }) {
  const handleConfirmDelete = () => {
    // Aquí iría la lógica para eliminar la zona
    console.log("Eliminando zona:", zona)
    onClose()
  }

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[500px] max-w-[95vw] max-h-[90vh] overflow-y-auto mx-4">
        <DialogHeader>
          <DialogTitle className="text-lg font-semibold text-gray-800 border-b-2 border-red-500 pb-2">
            Eliminar Zona
          </DialogTitle>
        </DialogHeader>

        <div className="mt-6">
          <div className="flex items-center space-x-3 mb-4">
            <div className="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full flex-shrink-0">
              <AlertTriangle className="w-6 h-6 text-red-600" />
            </div>
            <div>
              <h3 className="text-lg font-semibold text-gray-800">¿Confirmar eliminación?</h3>
              <p className="text-sm text-gray-600">Esta acción no se puede deshacer</p>
            </div>
          </div>

          {zona && (
            <div className="bg-gray-50 p-4 rounded-lg mb-6">
              <h4 className="font-medium text-gray-800 mb-3">Zona a eliminar:</h4>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-600">
                <div className="space-y-2">
                  <p className="break-words">
                    <span className="font-medium text-gray-700">Nombre:</span><br />
                    {zona.nombre}
                  </p>
                  <p>
                    <span className="font-medium text-gray-700">Código:</span><br />
                    {zona.codigo}
                  </p>
                  <p className="break-words">
                    <span className="font-medium text-gray-700">Sede:</span><br />
                    {zona.sede}
                  </p>
                </div>
                <div className="space-y-2">
                  <p>
                    <span className="font-medium text-gray-700">Piso(s):</span><br />
                    {zona.piso}
                  </p>
                  <p className="break-words">
                    <span className="font-medium text-gray-700">Jefe de Zona:</span><br />
                    {zona.jefeZona}
                  </p>
                  <p>
                    <span className="font-medium text-gray-700">Estado:</span><br />
                    {zona.estado}
                  </p>
                </div>
              </div>
              
              <div className="mt-3 pt-3 border-t border-gray-200">
                <div className="grid grid-cols-2 gap-4 text-sm">
                  <p className="text-gray-600">
                    <span className="font-medium text-gray-700">Áreas asociadas:</span> {zona.areasAsociadas}
                  </p>
                  <p className="text-gray-600">
                    <span className="font-medium text-gray-700">Equipos asociados:</span> {zona.equiposAsociados}
                  </p>
                </div>
              </div>
            </div>
          )}

          <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <div className="flex items-start space-x-2">
              <AlertTriangle className="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" />
              <div>
                <h4 className="text-sm font-medium text-yellow-800">Advertencia Crítica</h4>
                <p className="text-sm text-yellow-700 mt-1">
                  Al eliminar esta zona, también se eliminarán <strong>todas las áreas asociadas</strong> ({zona?.areasAsociadas} áreas) 
                  y <strong>todos los equipos vinculados</strong> ({zona?.equiposAsociados} equipos). Esta acción es permanente 
                  y no se puede revertir.
                </p>
              </div>
            </div>
          </div>

          {/* Botones */}
          <div className="flex flex-col sm:flex-row justify-end gap-3">
            <Button
              type="button"
              variant="outline"
              onClick={onClose}
              className="px-6 w-full sm:w-auto order-2 sm:order-1"
            >
              Cancelar
            </Button>

            <Button
              type="button"
              onClick={handleConfirmDelete}
              className="bg-red-500 hover:bg-red-600 text-white px-6 w-full sm:w-auto order-1 sm:order-2"
            >
              Eliminar Zona
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  )
}