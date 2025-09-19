"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "../../ui/card";
import { BarChart3, TrendingUp, TrendingDown, AlertCircle, Package } from "lucide-react";

export default function UIModalConsolidarRepuesto({ isOpen, onClose }) {
  const [selectedPeriod, setSelectedPeriod] = useState("mensual");

  const consolidacionData = {
    resumen: {
      totalRepuestos: 156,
      valorTotal: 45680000,
      stockBajo: 12,
      agotados: 3,
      rotacionPromedio: 2.4
    },
    categorias: [
      { nombre: "FILTROS", cantidad: 45, valor: 12500000, rotacion: 3.2, tendencia: "up" },
      { nombre: "BOMBAS", cantidad: 23, valor: 18900000, rotacion: 1.8, tendencia: "down" },
      { nombre: "SENSORES", cantidad: 34, valor: 8200000, rotacion: 2.1, tendencia: "up" },
      { nombre: "VÁLVULAS", cantidad: 28, valor: 4800000, rotacion: 2.8, tendencia: "stable" },
      { nombre: "ELECTRÓNICA", cantidad: 26, valor: 1280000, rotacion: 1.2, tendencia: "down" }
    ],
    alertas: [
      { tipo: "STOCK_BAJO", mensaje: "12 repuestos por debajo del stock mínimo", prioridad: "alta" },
      { tipo: "AGOTADO", mensaje: "3 repuestos completamente agotados", prioridad: "critica" },
      { tipo: "ROTACION", mensaje: "5 repuestos con baja rotación", prioridad: "media" },
      { tipo: "COSTO", mensaje: "Incremento del 15% en costos vs mes anterior", prioridad: "alta" }
    ]
  };

  const getTendenciaIcon = (tendencia) => {
    switch (tendencia) {
      case "up": return <TrendingUp className="w-4 h-4 text-green-600" />;
      case "down": return <TrendingDown className="w-4 h-4 text-red-600" />;
      default: return <div className="w-4 h-4 bg-gray-400 rounded-full" />;
    }
  };

  const getPrioridadColor = (prioridad) => {
    switch (prioridad) {
      case "critica": return "bg-red-100 text-red-800";
      case "alta": return "bg-orange-100 text-orange-800";
      case "media": return "bg-yellow-100 text-yellow-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const handleExportReport = () => {
    console.log("Exportando reporte consolidado");
    // Lógica para exportar reporte
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[900px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <BarChart3 className="w-5 h-5 text-teal-600" />
            Consolidación de Inventario
          </DialogTitle>
          <DialogDescription>
            Análisis consolidado del inventario de repuestos con métricas y tendencias.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-6">
          {/* Período de Análisis */}
          <div className="flex space-x-2">
            {["semanal", "mensual", "trimestral"].map((period) => (
              <Button
                key={period}
                variant={selectedPeriod === period ? "default" : "outline"}
                size="sm"
                onClick={() => setSelectedPeriod(period)}
                className={selectedPeriod === period ? "bg-teal-500" : ""}
              >
                {period.charAt(0).toUpperCase() + period.slice(1)}
              </Button>
            ))}
          </div>

          {/* Resumen General */}
          <div className="grid grid-cols-2 md:grid-cols-5 gap-4">
            <Card>
              <CardContent className="p-4 text-center">
                <Package className="w-6 h-6 mx-auto mb-2 text-blue-600" />
                <div className="text-2xl font-bold text-blue-600">{consolidacionData.resumen.totalRepuestos}</div>
                <div className="text-xs text-gray-500">Total Repuestos</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <div className="text-lg font-bold text-green-600">
                  ${(consolidacionData.resumen.valorTotal / 1000000).toFixed(1)}M
                </div>
                <div className="text-xs text-gray-500">Valor Total</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <div className="text-2xl font-bold text-yellow-600">{consolidacionData.resumen.stockBajo}</div>
                <div className="text-xs text-gray-500">Stock Bajo</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <div className="text-2xl font-bold text-red-600">{consolidacionData.resumen.agotados}</div>
                <div className="text-xs text-gray-500">Agotados</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <div className="text-2xl font-bold text-purple-600">{consolidacionData.resumen.rotacionPromedio}</div>
                <div className="text-xs text-gray-500">Rotación Prom.</div>
              </CardContent>
            </Card>
          </div>

          {/* Análisis por Categorías */}
          <Card>
            <CardHeader>
              <CardTitle className="text-lg">Análisis por Categorías</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="space-y-3">
                {consolidacionData.categorias.map((categoria, index) => (
                  <div key={index} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div className="flex items-center space-x-3">
                      <div className="font-medium">{categoria.nombre}</div>
                      {getTendenciaIcon(categoria.tendencia)}
                    </div>
                    <div className="flex items-center space-x-6 text-sm">
                      <div>
                        <span className="text-gray-500">Cantidad:</span>
                        <span className="font-medium ml-1">{categoria.cantidad}</span>
                      </div>
                      <div>
                        <span className="text-gray-500">Valor:</span>
                        <span className="font-medium ml-1">${(categoria.valor / 1000000).toFixed(1)}M</span>
                      </div>
                      <div>
                        <span className="text-gray-500">Rotación:</span>
                        <span className="font-medium ml-1">{categoria.rotacion}</span>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>

          {/* Alertas y Recomendaciones */}
          <Card>
            <CardHeader>
              <CardTitle className="text-lg flex items-center gap-2">
                <AlertCircle className="w-5 h-5 text-orange-600" />
                Alertas y Recomendaciones
              </CardTitle>
            </CardHeader>
            <CardContent>
              <div className="space-y-2">
                {consolidacionData.alertas.map((alerta, index) => (
                  <div key={index} className="flex items-center justify-between p-3 border rounded-lg">
                    <div className="flex items-center space-x-3">
                      <AlertCircle className="w-4 h-4 text-orange-600" />
                      <span className="text-sm">{alerta.mensaje}</span>
                    </div>
                    <Badge className={`${getPrioridadColor(alerta.prioridad)} text-xs`}>
                      {alerta.prioridad.toUpperCase()}
                    </Badge>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>

          {/* Acciones */}
          <div className="flex justify-between items-center pt-4">
            <Button
              onClick={handleExportReport}
              variant="outline"
              className="flex items-center gap-2"
            >
              <BarChart3 className="w-4 h-4" />
              Exportar Reporte
            </Button>
            
            <div className="flex space-x-3">
              <Button type="button" variant="outline" onClick={onClose}>
                Cerrar
              </Button>
              <Button className="bg-teal-500 hover:bg-teal-600">
                Generar Reporte Detallado
              </Button>
            </div>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}