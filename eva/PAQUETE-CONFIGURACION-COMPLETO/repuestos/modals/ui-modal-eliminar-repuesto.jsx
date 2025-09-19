"use client";

import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { AlertTriangle, Trash2 } from "lucide-react";

export default function UIModalEliminarRepuesto({ isOpen, onClose, repuesto }) {
  const handleConfirmDelete = () => {
    console.log("Eliminando repuesto:", repuesto);
    onClose();
  };

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "DISPONIBLE":
        return "bg-green-100 text-green-800";
      case "STOCK_BAJO":
        return "bg-yellow-100 text-yellow-800";
      case "AGOTADO":
        return "bg-red-100 text-red-800";
      default:
        return "bg-gray-100 text-gray-800";
    }
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[500px]">
        <DialogHeader>
          <DialogTitle className="text-lg font-semibold text-gray-800 border-b-2 border-red-500 pb-2">
            Eliminar Repuesto
          </DialogTitle>
          <DialogDescription>
            Esta acción eliminará permanentemente el repuesto del inventario.
          </DialogDescription>
        </DialogHeader>

        <div className="mt-6">
          <div className="flex items-center space-x-3 mb-4">
            <div className="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
              <AlertTriangle className="w-6 h-6 text-red-600" />
            </div>
            <div>
              <h3 className="text-lg font-semibold text-gray-800">¿Confirmar eliminación?</h3>
              <p className="text-sm text-gray-600">Esta acción no se puede deshacer</p>
            </div>
          </div>

          {repuesto && (
            <div className="bg-gray-50 p-4 rounded-lg mb-6">
              <h4 className="font-medium text-gray-800 mb-3">Repuesto a eliminar:</h4>
              <div className="space-y-3 text-sm text-gray-600">
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <span className="font-medium text-gray-700">Código:</span>
                    <div className="font-mono">{repuesto.codigo}</div>
                  </div>
                  <div>
                    <span className="font-medium text-gray-700">Categoría:</span>
                    <div>{repuesto.categoria}</div>
                  </div>
                </div>
                
                <div>
                  <span className="font-medium text-gray-700">Nombre:</span>
                  <div className="break-words">{repuesto.nombre}</div>
                </div>
                
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <span className="font-medium text-gray-700">Marca/Modelo:</span>
                    <div>{repuesto.marca} {repuesto.modelo}</div>
                  </div>
                  <div>
                    <span className="font-medium text-gray-700">Stock Actual:</span>
                    <div className="font-bold">{repuesto.stock} unidades</div>
                  </div>
                </div>
                
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <span className="font-medium text-gray-700">Precio Unitario:</span>
                    <div className="font-bold text-green-600">${repuesto.precio?.toLocaleString()}</div>
                  </div>
                  <div>
                    <span className="font-medium text-gray-700">Valor Total:</span>
                    <div className="font-bold text-green-600">
                      ${((repuesto.precio || 0) * (repuesto.stock || 0)).toLocaleString()}
                    </div>
                  </div>
                </div>
                
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <span className="font-medium text-gray-700">Ubicación:</span>
                    <div>{repuesto.ubicacion}</div>
                  </div>
                  <div>
                    <span className="font-medium text-gray-700">Estado:</span>
                    <Badge className={`${getEstadoColor(repuesto.estado)} text-xs mt-1`}>
                      {repuesto.estado}
                    </Badge>
                  </div>
                </div>
                
                {repuesto.proveedor && (
                  <div>
                    <span className="font-medium text-gray-700">Proveedor:</span>
                    <div>{repuesto.proveedor}</div>
                  </div>
                )}
              </div>
            </div>
          )}

          <div className="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div className="flex items-start space-x-2">
              <Trash2 className="w-5 h-5 text-red-600 mt-0.5" />
              <div>
                <h4 className="text-sm font-medium text-red-800">Consecuencias de la eliminación</h4>
                <ul className="text-sm text-red-700 mt-1 list-disc list-inside space-y-1">
                  <li>Se perderá el historial de movimientos del repuesto</li>
                  <li>Se eliminarán las programaciones de mantenimiento asociadas</li>
                  <li>No se podrán generar reportes históricos de este repuesto</li>
                  <li>Esta acción es permanente y no se puede revertir</li>
                </ul>
              </div>
            </div>
          </div>

          <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <div className="flex items-start space-x-2">
              <AlertTriangle className="w-5 h-5 text-yellow-600 mt-0.5" />
              <div>
                <h4 className="text-sm font-medium text-yellow-800">Alternativa recomendada</h4>
                <p className="text-sm text-yellow-700 mt-1">
                  Considere marcar el repuesto como "INACTIVO" en lugar de eliminarlo para mantener 
                  el historial y poder reactivarlo en el futuro si es necesario.
                </p>
              </div>
            </div>
          </div>

          <div className="flex justify-end space-x-3">
            <Button type="button" variant="outline" onClick={onClose} className="px-6">
              Cancelar
            </Button>

            <Button
              type="button"
              onClick={handleConfirmDelete}
              className="bg-red-500 hover:bg-red-600 text-white px-6"
            >
              Eliminar Permanentemente
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}