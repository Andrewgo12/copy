"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { Input } from "../../ui/input";
import { Label } from "../../ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "../../ui/select";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "../../ui/table";
import { Textarea } from "../../ui/textarea";
import { Settings, Calendar, CheckCircle, AlertTriangle, Plus, FileText } from "lucide-react";

export default function UIModalCalibraciones({ isOpen, onClose }) {
  const [activeTab, setActiveTab] = useState("pendientes");
  const [showAddForm, setShowAddForm] = useState(false);

  const calibracionesData = {
    pendientes: [
      {
        id: 1,
        repuesto: "SENSOR TEMPERATURA",
        codigo: "REP003",
        ultimaCalibracion: "2023-12-15",
        proximaCalibracion: "2024-04-15",
        frecuencia: "TRIMESTRAL",
        proveedor: "HONEYWELL SERVICES",
        estado: "PENDIENTE",
        diasRestantes: 20,
        criticidad: "ALTA"
      },
      {
        id: 2,
        repuesto: "BOMBA PERISTALTICA",
        codigo: "REP002",
        ultimaCalibracion: "2024-01-10",
        proximaCalibracion: "2024-04-10",
        frecuencia: "TRIMESTRAL",
        proveedor: "WATSON MARLOW SERVICE",
        estado: "PROGRAMADA",
        diasRestantes: 15,
        criticidad: "MEDIA"
      },
      {
        id: 3,
        repuesto: "PLACA ELECTRONICA",
        codigo: "REP006",
        ultimaCalibracion: "2023-11-20",
        proximaCalibracion: "2024-03-25",
        frecuencia: "SEMESTRAL",
        proveedor: "SIEMENS CALIBRATION",
        estado: "VENCIDA",
        diasRestantes: -5,
        criticidad: "CRITICA"
      }
    ],
    completadas: [
      {
        id: 4,
        repuesto: "VÁLVULA SOLENOIDE",
        codigo: "REP004",
        fechaCalibracion: "2024-03-18",
        proveedor: "ASCO SERVICES",
        tecnico: "Ing. Roberto Silva",
        certificado: "CERT-2024-0318-001",
        resultado: "CONFORME",
        proximaCalibracion: "2024-09-18"
      }
    ]
  };

  const [newCalibracion, setNewCalibracion] = useState({
    repuesto: "",
    frecuencia: "",
    proximaFecha: "",
    proveedor: "",
    criticidad: "MEDIA",
    observaciones: ""
  });

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "PENDIENTE": return "bg-yellow-100 text-yellow-800";
      case "PROGRAMADA": return "bg-blue-100 text-blue-800";
      case "VENCIDA": return "bg-red-100 text-red-800";
      case "CONFORME": return "bg-green-100 text-green-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const getCriticidadColor = (criticidad) => {
    switch (criticidad) {
      case "CRITICA": return "bg-red-100 text-red-800";
      case "ALTA": return "bg-orange-100 text-orange-800";
      case "MEDIA": return "bg-yellow-100 text-yellow-800";
      case "BAJA": return "bg-green-100 text-green-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const getDiasColor = (dias) => {
    if (dias < 0) return "text-red-600 font-bold";
    if (dias <= 7) return "text-orange-600 font-bold";
    return "text-green-600";
  };

  const handleAddCalibracion = () => {
    console.log("Programando calibración:", newCalibracion);
    setShowAddForm(false);
    setNewCalibracion({
      repuesto: "",
      frecuencia: "",
      proximaFecha: "",
      proveedor: "",
      criticidad: "MEDIA",
      observaciones: ""
    });
  };

  const handleCompleteCalibracion = (id) => {
    console.log("Completando calibración:", id);
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[900px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Settings className="w-5 h-5 text-orange-600" />
            Calibraciones de Repuestos
          </DialogTitle>
          <DialogDescription>
            Gestión de calibraciones programadas para repuestos que requieren certificación.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-4">
          {/* Tabs */}
          <div className="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <Button
              variant={activeTab === "pendientes" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("pendientes")}
              className={activeTab === "pendientes" ? "bg-orange-500" : ""}
            >
              Pendientes ({calibracionesData.pendientes.length})
            </Button>
            <Button
              variant={activeTab === "completadas" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("completadas")}
              className={activeTab === "completadas" ? "bg-orange-500" : ""}
            >
              Completadas ({calibracionesData.completadas.length})
            </Button>
          </div>

          {/* Botón Agregar */}
          {activeTab === "pendientes" && (
            <div className="flex justify-end">
              <Button
                onClick={() => setShowAddForm(!showAddForm)}
                className="bg-orange-500 hover:bg-orange-600 flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                Programar Calibración
              </Button>
            </div>
          )}

          {/* Formulario Agregar */}
          {showAddForm && (
            <div className="border rounded-lg p-4 bg-gray-50">
              <h4 className="font-medium mb-3">Programar Nueva Calibración</h4>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label>Repuesto</Label>
                  <Select onValueChange={(value) => setNewCalibracion(prev => ({...prev, repuesto: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar repuesto" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="REP003">SENSOR TEMPERATURA</SelectItem>
                      <SelectItem value="REP002">BOMBA PERISTALTICA</SelectItem>
                      <SelectItem value="REP006">PLACA ELECTRONICA</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Frecuencia</Label>
                  <Select onValueChange={(value) => setNewCalibracion(prev => ({...prev, frecuencia: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar frecuencia" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="MENSUAL">MENSUAL</SelectItem>
                      <SelectItem value="TRIMESTRAL">TRIMESTRAL</SelectItem>
                      <SelectItem value="SEMESTRAL">SEMESTRAL</SelectItem>
                      <SelectItem value="ANUAL">ANUAL</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Próxima Fecha</Label>
                  <Input
                    type="date"
                    value={newCalibracion.proximaFecha}
                    onChange={(e) => setNewCalibracion(prev => ({...prev, proximaFecha: e.target.value}))}
                  />
                </div>
                <div>
                  <Label>Criticidad</Label>
                  <Select 
                    value={newCalibracion.criticidad}
                    onValueChange={(value) => setNewCalibracion(prev => ({...prev, criticidad: value}))}
                  >
                    <SelectTrigger>
                      <SelectValue />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="BAJA">BAJA</SelectItem>
                      <SelectItem value="MEDIA">MEDIA</SelectItem>
                      <SelectItem value="ALTA">ALTA</SelectItem>
                      <SelectItem value="CRITICA">CRÍTICA</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div className="col-span-2">
                  <Label>Proveedor de Calibración</Label>
                  <Input
                    placeholder="Nombre del proveedor certificado"
                    value={newCalibracion.proveedor}
                    onChange={(e) => setNewCalibracion(prev => ({...prev, proveedor: e.target.value}))}
                  />
                </div>
                <div className="col-span-2">
                  <Label>Observaciones</Label>
                  <Textarea
                    placeholder="Observaciones adicionales..."
                    value={newCalibracion.observaciones}
                    onChange={(e) => setNewCalibracion(prev => ({...prev, observaciones: e.target.value}))}
                    rows={2}
                  />
                </div>
              </div>
              <div className="flex justify-end space-x-2 mt-4">
                <Button variant="outline" onClick={() => setShowAddForm(false)}>
                  Cancelar
                </Button>
                <Button onClick={handleAddCalibracion} className="bg-orange-500 hover:bg-orange-600">
                  Programar
                </Button>
              </div>
            </div>
          )}

          {/* Tabla Pendientes */}
          {activeTab === "pendientes" && (
            <div className="border rounded-lg">
              <Table>
                <TableHeader className="bg-gray-50">
                  <TableRow>
                    <TableHead>Repuesto</TableHead>
                    <TableHead>Última/Próxima</TableHead>
                    <TableHead>Proveedor</TableHead>
                    <TableHead className="text-center">Criticidad</TableHead>
                    <TableHead className="text-center">Estado</TableHead>
                    <TableHead className="text-center">Acciones</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {calibracionesData.pendientes.map((item) => (
                    <TableRow key={item.id}>
                      <TableCell>
                        <div>
                          <div className="font-medium">{item.repuesto}</div>
                          <div className="text-xs text-gray-500">{item.codigo}</div>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="text-xs space-y-1">
                          <div>Última: {item.ultimaCalibracion}</div>
                          <div className="flex items-center gap-1">
                            <Calendar className="w-3 h-3 text-gray-400" />
                            <span>Próxima: {item.proximaCalibracion}</span>
                          </div>
                          <div className={`${getDiasColor(item.diasRestantes)}`}>
                            {item.diasRestantes > 0 ? `${item.diasRestantes} días` : `Vencida hace ${Math.abs(item.diasRestantes)} días`}
                          </div>
                        </div>
                      </TableCell>
                      <TableCell className="text-sm">{item.proveedor}</TableCell>
                      <TableCell className="text-center">
                        <Badge className={`${getCriticidadColor(item.criticidad)} text-xs`}>
                          {item.criticidad}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-center">
                        <Badge className={`${getEstadoColor(item.estado)} text-xs`}>
                          {item.estado}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-center">
                        <div className="flex gap-1 justify-center">
                          <Button
                            size="sm"
                            onClick={() => handleCompleteCalibracion(item.id)}
                            className="bg-orange-500 hover:bg-orange-600 h-6 px-2"
                          >
                            <CheckCircle className="w-3 h-3" />
                          </Button>
                          <Button
                            size="sm"
                            variant="outline"
                            className="h-6 px-2"
                          >
                            <FileText className="w-3 h-3" />
                          </Button>
                        </div>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </div>
          )}

          {/* Tabla Completadas */}
          {activeTab === "completadas" && (
            <div className="border rounded-lg">
              <Table>
                <TableHeader className="bg-gray-50">
                  <TableRow>
                    <TableHead>Repuesto</TableHead>
                    <TableHead>Fecha Calibración</TableHead>
                    <TableHead>Proveedor/Técnico</TableHead>
                    <TableHead>Certificado</TableHead>
                    <TableHead className="text-center">Resultado</TableHead>
                    <TableHead>Próxima</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {calibracionesData.completadas.map((item) => (
                    <TableRow key={item.id}>
                      <TableCell>
                        <div>
                          <div className="font-medium">{item.repuesto}</div>
                          <div className="text-xs text-gray-500">{item.codigo}</div>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="flex items-center gap-2">
                          <CheckCircle className="w-4 h-4 text-green-600" />
                          <span className="text-sm">{item.fechaCalibracion}</span>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="text-sm">
                          <div>{item.proveedor}</div>
                          <div className="text-xs text-gray-500">{item.tecnico}</div>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="flex items-center gap-1">
                          <FileText className="w-3 h-3 text-blue-600" />
                          <span className="text-xs font-mono">{item.certificado}</span>
                        </div>
                      </TableCell>
                      <TableCell className="text-center">
                        <Badge className={`${getEstadoColor(item.resultado)} text-xs`}>
                          {item.resultado}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-sm">{item.proximaCalibracion}</TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </div>
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