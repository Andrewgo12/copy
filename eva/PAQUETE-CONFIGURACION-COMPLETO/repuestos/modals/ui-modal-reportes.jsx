"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "../../ui/card";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "../../ui/select";
import { Input } from "../../ui/input";
import { Label } from "../../ui/label";
import { FileText, Download, BarChart3, TrendingUp, Calendar, Package, DollarSign, AlertTriangle } from "lucide-react";

export default function UIModalReportes({ isOpen, onClose }) {
  const [selectedReport, setSelectedReport] = useState("");
  const [dateRange, setDateRange] = useState({
    inicio: "",
    fin: ""
  });
  const [filters, setFilters] = useState({
    categoria: "",
    proveedor: "",
    estado: ""
  });

  const reportTypes = [
    {
      id: "inventario",
      name: "Reporte de Inventario",
      description: "Estado actual del inventario de repuestos",
      icon: <Package className="w-5 h-5 text-blue-600" />
    },
    {
      id: "movimientos",
      name: "Movimientos de Stock",
      description: "Entradas y salidas de repuestos por período",
      icon: <TrendingUp className="w-5 h-5 text-green-600" />
    },
    {
      id: "valoracion",
      name: "Valoración de Inventario",
      description: "Valor monetario del inventario por categorías",
      icon: <DollarSign className="w-5 h-5 text-yellow-600" />
    },
    {
      id: "rotacion",
      name: "Análisis de Rotación",
      description: "Rotación de repuestos y productos de baja rotación",
      icon: <BarChart3 className="w-5 h-5 text-purple-600" />
    },
    {
      id: "mantenimientos",
      name: "Mantenimientos Realizados",
      description: "Preventivos y correctivos por período",
      icon: <Calendar className="w-5 h-5 text-orange-600" />
    },
    {
      id: "alertas",
      name: "Reporte de Alertas",
      description: "Stock bajo, vencimientos y alertas críticas",
      icon: <AlertTriangle className="w-5 h-5 text-red-600" />
    }
  ];

  const quickStats = {
    totalRepuestos: 156,
    valorInventario: 45680000,
    stockBajo: 12,
    mantenimientosMes: 28,
    costoMantenimiento: 8500000,
    eficienciaStock: 87
  };

  const handleGenerateReport = () => {
    console.log("Generando reporte:", {
      tipo: selectedReport,
      fechas: dateRange,
      filtros: filters
    });
    // Lógica para generar reporte
  };

  const handleExportReport = (format) => {
    console.log(`Exportando reporte en formato ${format}`);
    // Lógica para exportar
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[900px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <FileText className="w-5 h-5 text-indigo-600" />
            Centro de Reportes
          </DialogTitle>
          <DialogDescription>
            Genere reportes detallados sobre inventario, mantenimientos y análisis de repuestos.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-6">
          {/* Estadísticas Rápidas */}
          <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
            <Card>
              <CardContent className="p-4 text-center">
                <Package className="w-6 h-6 mx-auto mb-2 text-blue-600" />
                <div className="text-2xl font-bold text-blue-600">{quickStats.totalRepuestos}</div>
                <div className="text-xs text-gray-500">Total Repuestos</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <DollarSign className="w-6 h-6 mx-auto mb-2 text-green-600" />
                <div className="text-lg font-bold text-green-600">
                  ${(quickStats.valorInventario / 1000000).toFixed(1)}M
                </div>
                <div className="text-xs text-gray-500">Valor Inventario</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <AlertTriangle className="w-6 h-6 mx-auto mb-2 text-red-600" />
                <div className="text-2xl font-bold text-red-600">{quickStats.stockBajo}</div>
                <div className="text-xs text-gray-500">Stock Bajo</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <Calendar className="w-6 h-6 mx-auto mb-2 text-orange-600" />
                <div className="text-2xl font-bold text-orange-600">{quickStats.mantenimientosMes}</div>
                <div className="text-xs text-gray-500">Mantenim. Mes</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <TrendingUp className="w-6 h-6 mx-auto mb-2 text-purple-600" />
                <div className="text-2xl font-bold text-purple-600">{quickStats.eficienciaStock}%</div>
                <div className="text-xs text-gray-500">Eficiencia Stock</div>
              </CardContent>
            </Card>
            
            <Card>
              <CardContent className="p-4 text-center">
                <DollarSign className="w-6 h-6 mx-auto mb-2 text-yellow-600" />
                <div className="text-lg font-bold text-yellow-600">
                  ${(quickStats.costoMantenimiento / 1000000).toFixed(1)}M
                </div>
                <div className="text-xs text-gray-500">Costo Mantenim.</div>
              </CardContent>
            </Card>
          </div>

          {/* Selección de Reporte */}
          <Card>
            <CardHeader>
              <CardTitle className="text-lg">Seleccionar Tipo de Reporte</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                {reportTypes.map((report) => (
                  <div
                    key={report.id}
                    className={`p-4 border rounded-lg cursor-pointer transition-all ${
                      selectedReport === report.id
                        ? "border-indigo-500 bg-indigo-50"
                        : "border-gray-200 hover:border-gray-300"
                    }`}
                    onClick={() => setSelectedReport(report.id)}
                  >
                    <div className="flex items-start space-x-3">
                      {report.icon}
                      <div>
                        <h4 className="font-medium text-gray-900">{report.name}</h4>
                        <p className="text-sm text-gray-600 mt-1">{report.description}</p>
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>

          {/* Configuración del Reporte */}
          {selectedReport && (
            <Card>
              <CardHeader>
                <CardTitle className="text-lg">Configuración del Reporte</CardTitle>
              </CardHeader>
              <CardContent className="space-y-4">
                {/* Rango de Fechas */}
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <Label>Fecha Inicio</Label>
                    <Input
                      type="date"
                      value={dateRange.inicio}
                      onChange={(e) => setDateRange(prev => ({...prev, inicio: e.target.value}))}
                    />
                  </div>
                  <div>
                    <Label>Fecha Fin</Label>
                    <Input
                      type="date"
                      value={dateRange.fin}
                      onChange={(e) => setDateRange(prev => ({...prev, fin: e.target.value}))}
                    />
                  </div>
                </div>

                {/* Filtros */}
                <div className="grid grid-cols-3 gap-4">
                  <div>
                    <Label>Categoría</Label>
                    <Select onValueChange={(value) => setFilters(prev => ({...prev, categoria: value}))}>
                      <SelectTrigger>
                        <SelectValue placeholder="Todas las categorías" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="">Todas</SelectItem>
                        <SelectItem value="FILTROS">FILTROS</SelectItem>
                        <SelectItem value="BOMBAS">BOMBAS</SelectItem>
                        <SelectItem value="SENSORES">SENSORES</SelectItem>
                        <SelectItem value="VALVULAS">VÁLVULAS</SelectItem>
                        <SelectItem value="ELECTRONICA">ELECTRÓNICA</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>
                  
                  <div>
                    <Label>Proveedor</Label>
                    <Select onValueChange={(value) => setFilters(prev => ({...prev, proveedor: value}))}>
                      <SelectTrigger>
                        <SelectValue placeholder="Todos los proveedores" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="">Todos</SelectItem>
                        <SelectItem value="EQUIPOS TECTUM">EQUIPOS TECTUM</SelectItem>
                        <SelectItem value="J.M MEDICOS EQUIPOS S.A.S">J.M MEDICOS EQUIPOS</SelectItem>
                        <SelectItem value="SIEMENS HEALTHINEERS">SIEMENS HEALTHINEERS</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>
                  
                  <div>
                    <Label>Estado</Label>
                    <Select onValueChange={(value) => setFilters(prev => ({...prev, estado: value}))}>
                      <SelectTrigger>
                        <SelectValue placeholder="Todos los estados" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="">Todos</SelectItem>
                        <SelectItem value="DISPONIBLE">DISPONIBLE</SelectItem>
                        <SelectItem value="STOCK_BAJO">STOCK BAJO</SelectItem>
                        <SelectItem value="AGOTADO">AGOTADO</SelectItem>
                      </SelectContent>
                    </Select>
                  </div>
                </div>

                {/* Botones de Acción */}
                <div className="flex justify-between items-center pt-4 border-t">
                  <div className="flex space-x-2">
                    <Button
                      onClick={() => handleExportReport("pdf")}
                      variant="outline"
                      className="flex items-center gap-2"
                    >
                      <Download className="w-4 h-4" />
                      PDF
                    </Button>
                    <Button
                      onClick={() => handleExportReport("excel")}
                      variant="outline"
                      className="flex items-center gap-2"
                    >
                      <Download className="w-4 h-4" />
                      Excel
                    </Button>
                    <Button
                      onClick={() => handleExportReport("csv")}
                      variant="outline"
                      className="flex items-center gap-2"
                    >
                      <Download className="w-4 h-4" />
                      CSV
                    </Button>
                  </div>
                  
                  <Button
                    onClick={handleGenerateReport}
                    className="bg-indigo-500 hover:bg-indigo-600 flex items-center gap-2"
                  >
                    <BarChart3 className="w-4 h-4" />
                    Generar Reporte
                  </Button>
                </div>
              </CardContent>
            </Card>
          )}

          {/* Acciones */}
          <div className="flex justify-end pt-4">
            <Button type="button" variant="outline" onClick={onClose}>
              Cerrar
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}