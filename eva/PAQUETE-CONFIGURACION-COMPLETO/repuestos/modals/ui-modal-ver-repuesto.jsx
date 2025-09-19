"use client";

import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "../../ui/card";
import { Eye, Package, DollarSign, MapPin, Calendar, Truck, Settings, TrendingUp, AlertTriangle } from "lucide-react";

export default function UIModalVerRepuesto({ isOpen, onClose, repuesto }) {
  if (!repuesto) return null;

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

  const getStockStatus = () => {
    if (repuesto.stock === 0) return { color: "text-red-600", status: "CRÍTICO" };
    if (repuesto.stock <= repuesto.stockMinimo) return { color: "text-yellow-600", status: "BAJO" };
    return { color: "text-green-600", status: "NORMAL" };
  };

  const stockStatus = getStockStatus();
  const valorTotal = (repuesto.precio || 0) * (repuesto.stock || 0);

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl w-[95vw] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Eye className="w-5 h-5 text-blue-600" />
            Detalles del Repuesto
          </DialogTitle>
          <DialogDescription>
            Información completa del repuesto seleccionado.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-6 p-2">
          {/* Header del repuesto */}
          <div className="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-xl font-semibold text-blue-800 mb-1">{repuesto.nombre}</h3>
                <div className="flex items-center gap-4 text-sm text-blue-600">
                  <span className="font-mono">{repuesto.codigo}</span>
                  <span>•</span>
                  <span>{repuesto.categoria}</span>
                  <span>•</span>
                  <span>{repuesto.marca} {repuesto.modelo}</span>
                </div>
              </div>
              <Badge className={`${getEstadoColor(repuesto.estado)} text-sm px-3 py-1`}>
                {repuesto.estado}
              </Badge>
            </div>
          </div>

          {/* Métricas principales */}
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
            <Card>
              <CardContent className="p-4 text-center">
                <Package className="w-6 h-6 mx-auto mb-2 text-blue-600" />
                <div className={`text-2xl font-bold ${stockStatus.color}`}>
                  {repuesto.stock}
                </div>
                <div className="text-xs text-gray-500">Stock Actual</div>
                <div className={`text-xs font-medium ${stockStatus.color}`}>
                  {stockStatus.status}
                </div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <AlertTriangle className="w-6 h-6 mx-auto mb-2 text-yellow-600" />
                <div className="text-2xl font-bold text-yellow-600">
                  {repuesto.stockMinimo}
                </div>
                <div className="text-xs text-gray-500">Stock Mínimo</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <DollarSign className="w-6 h-6 mx-auto mb-2 text-green-600" />
                <div className="text-lg font-bold text-green-600">
                  ${repuesto.precio?.toLocaleString()}
                </div>
                <div className="text-xs text-gray-500">Precio Unitario</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <TrendingUp className="w-6 h-6 mx-auto mb-2 text-purple-600" />
                <div className="text-lg font-bold text-purple-600">
                  ${valorTotal.toLocaleString()}
                </div>
                <div className="text-xs text-gray-500">Valor Total</div>
              </CardContent>
            </Card>
          </div>

          {/* Información detallada */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {/* Información del producto */}
            <Card>
              <CardHeader>
                <CardTitle className="text-lg flex items-center gap-2">
                  <Package className="w-5 h-5 text-blue-600" />
                  Información del Producto
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-3">
                <div>
                  <label className="text-sm font-medium text-gray-600">Código</label>
                  <p className="text-sm font-mono bg-gray-100 px-2 py-1 rounded">{repuesto.codigo}</p>
                </div>
                <div>
                  <label className="text-sm font-medium text-gray-600">Nombre</label>
                  <p className="text-sm text-gray-800">{repuesto.nombre}</p>
                </div>
                <div>
                  <label className="text-sm font-medium text-gray-600">Categoría</label>
                  <Badge variant="outline" className="text-xs bg-blue-50 text-blue-700">
                    {repuesto.categoria}
                  </Badge>
                </div>
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <label className="text-sm font-medium text-gray-600">Marca</label>
                    <p className="text-sm text-gray-800">{repuesto.marca}</p>
                  </div>
                  <div>
                    <label className="text-sm font-medium text-gray-600">Modelo</label>
                    <p className="text-sm text-gray-800">{repuesto.modelo}</p>
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Información de inventario */}
            <Card>
              <CardHeader>
                <CardTitle className="text-lg flex items-center gap-2">
                  <MapPin className="w-5 h-5 text-green-600" />
                  Información de Inventario
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-3">
                <div>
                  <label className="text-sm font-medium text-gray-600">Ubicación</label>
                  <div className="flex items-center gap-2 mt-1">
                    <MapPin className="w-4 h-4 text-green-600" />
                    <span className="text-sm text-gray-800">{repuesto.ubicacion}</span>
                  </div>
                </div>
                <div>
                  <label className="text-sm font-medium text-gray-600">Proveedor</label>
                  <div className="flex items-center gap-2 mt-1">
                    <Truck className="w-4 h-4 text-purple-600" />
                    <span className="text-sm text-gray-800">{repuesto.proveedor}</span>
                  </div>
                </div>
                <div>
                  <label className="text-sm font-medium text-gray-600">Fecha de Ingreso</label>
                  <div className="flex items-center gap-2 mt-1">
                    <Calendar className="w-4 h-4 text-blue-600" />
                    <span className="text-sm text-gray-800">{repuesto.fechaIngreso}</span>
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>

          {/* Información de mantenimiento */}
          {(repuesto.ultimoMantenimiento || repuesto.proximoMantenimiento) && (
            <Card>
              <CardHeader>
                <CardTitle className="text-lg flex items-center gap-2">
                  <Settings className="w-5 h-5 text-orange-600" />
                  Información de Mantenimiento
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {repuesto.ultimoMantenimiento && (
                    <div>
                      <label className="text-sm font-medium text-gray-600">Último Mantenimiento</label>
                      <div className="flex items-center gap-2 mt-1">
                        <Calendar className="w-4 h-4 text-green-600" />
                        <span className="text-sm text-gray-800">{repuesto.ultimoMantenimiento}</span>
                      </div>
                    </div>
                  )}
                  {repuesto.proximoMantenimiento && (
                    <div>
                      <label className="text-sm font-medium text-gray-600">Próximo Mantenimiento</label>
                      <div className="flex items-center gap-2 mt-1">
                        <Calendar className="w-4 h-4 text-orange-600" />
                        <span className="text-sm text-gray-800">{repuesto.proximoMantenimiento}</span>
                      </div>
                    </div>
                  )}
                </div>
              </CardContent>
            </Card>
          )}

          {/* Historial reciente (simulado) */}
          <Card>
            <CardHeader>
              <CardTitle className="text-lg flex items-center gap-2">
                <TrendingUp className="w-5 h-5 text-indigo-600" />
                Historial Reciente
              </CardTitle>
            </CardHeader>
            <CardContent>
              <div className="space-y-2 text-sm">
                <div className="flex justify-between items-center p-2 bg-green-50 rounded">
                  <span>Entrada de inventario</span>
                  <span className="text-green-600 font-medium">+10 unidades</span>
                  <span className="text-gray-500">2024-03-15</span>
                </div>
                <div className="flex justify-between items-center p-2 bg-red-50 rounded">
                  <span>Uso en mantenimiento</span>
                  <span className="text-red-600 font-medium">-2 unidades</span>
                  <span className="text-gray-500">2024-03-10</span>
                </div>
                <div className="flex justify-between items-center p-2 bg-blue-50 rounded">
                  <span>Ajuste de inventario</span>
                  <span className="text-blue-600 font-medium">+1 unidad</span>
                  <span className="text-gray-500">2024-03-05</span>
                </div>
              </div>
            </CardContent>
          </Card>

          {/* Botón cerrar */}
          <div className="flex justify-end pt-6 border-t">
            <Button onClick={onClose} className="bg-gray-600 hover:bg-gray-700 px-6">
              Cerrar
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}