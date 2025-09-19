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
import { AlertTriangle, Clock, CheckCircle, XCircle, Plus, Wrench, User } from "lucide-react";

export default function UIModalCorrectivos({ isOpen, onClose }) {
  const [activeTab, setActiveTab] = useState("pendientes");
  const [showAddForm, setShowAddForm] = useState(false);

  const correctivosData = {
    pendientes: [
      {
        id: 1,
        repuesto: "BOMBA PERISTALTICA",
        codigo: "REP002",
        falla: "Pérdida de presión en el sistema",
        fechaReporte: "2024-03-20",
        prioridad: "ALTA",
        tecnicoAsignado: "Ing. Carlos Molano",
        equipoAfectado: "VENTILADOR UCI-001",
        tiempoEstimado: "4 horas",
        estado: "EN_PROCESO"
      },
      {
        id: 2,
        repuesto: "SENSOR TEMPERATURA",
        codigo: "REP003",
        falla: "Lecturas inconsistentes de temperatura",
        fechaReporte: "2024-03-22",
        prioridad: "MEDIA",
        tecnicoAsignado: "Téc. María González",
        equipoAfectado: "INCUBADORA NEO-005",
        tiempoEstimado: "2 horas",
        estado: "PENDIENTE"
      },
      {
        id: 3,
        repuesto: "PLACA ELECTRONICA",
        codigo: "REP006",
        falla: "Fallo en circuito de control principal",
        fechaReporte: "2024-03-25",
        prioridad: "CRITICA",
        tecnicoAsignado: "Ing. Luis Pérez",
        equipoAfectado: "MONITOR SIGNOS VITALES",
        tiempoEstimado: "8 horas",
        estado: "URGENTE"
      }
    ],
    completados: [
      {
        id: 4,
        repuesto: "VÁLVULA SOLENOIDE",
        codigo: "REP004",
        falla: "Válvula no abre completamente",
        fechaReporte: "2024-03-15",
        fechaCompletado: "2024-03-16",
        tecnico: "Téc. Ana López",
        solucion: "Reemplazo de válvula solenoide y limpieza del sistema",
        tiempoReal: "3 horas",
        costo: 320000,
        estado: "COMPLETADO"
      },
      {
        id: 5,
        repuesto: "FILTRO HEPA H14",
        codigo: "REP001",
        falla: "Filtro saturado, flujo de aire reducido",
        fechaReporte: "2024-03-10",
        fechaCompletado: "2024-03-11",
        tecnico: "Ing. Roberto Silva",
        solucion: "Reemplazo de filtro HEPA y verificación del sistema",
        tiempoReal: "1.5 horas",
        costo: 450000,
        estado: "COMPLETADO"
      }
    ]
  };

  const [newCorrectivo, setNewCorrectivo] = useState({
    repuesto: "",
    falla: "",
    prioridad: "MEDIA",
    equipoAfectado: "",
    tecnicoAsignado: "",
    tiempoEstimado: "",
    observaciones: ""
  });

  const getPrioridadColor = (prioridad) => {
    switch (prioridad) {
      case "CRITICA": return "bg-red-100 text-red-800";
      case "ALTA": return "bg-orange-100 text-orange-800";
      case "MEDIA": return "bg-yellow-100 text-yellow-800";
      case "BAJA": return "bg-green-100 text-green-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "URGENTE": return "bg-red-100 text-red-800";
      case "EN_PROCESO": return "bg-blue-100 text-blue-800";
      case "PENDIENTE": return "bg-yellow-100 text-yellow-800";
      case "COMPLETADO": return "bg-green-100 text-green-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const getEstadoIcon = (estado) => {
    switch (estado) {
      case "URGENTE": return <AlertTriangle className="w-4 h-4 text-red-600" />;
      case "EN_PROCESO": return <Clock className="w-4 h-4 text-blue-600" />;
      case "PENDIENTE": return <Clock className="w-4 h-4 text-yellow-600" />;
      case "COMPLETADO": return <CheckCircle className="w-4 h-4 text-green-600" />;
      default: return <XCircle className="w-4 h-4 text-gray-600" />;
    }
  };

  const handleAddCorrectivo = () => {
    console.log("Creando correctivo:", newCorrectivo);
    setShowAddForm(false);
    setNewCorrectivo({
      repuesto: "",
      falla: "",
      prioridad: "MEDIA",
      equipoAfectado: "",
      tecnicoAsignado: "",
      tiempoEstimado: "",
      observaciones: ""
    });
  };

  const handleCompleteCorrectivo = (id) => {
    console.log("Completando correctivo:", id);
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[1000px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <AlertTriangle className="w-5 h-5 text-red-600" />
            Mantenimientos Correctivos
          </DialogTitle>
          <DialogDescription>
            Gestión de mantenimientos correctivos y reparaciones de emergencia.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-4">
          {/* Tabs */}
          <div className="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <Button
              variant={activeTab === "pendientes" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("pendientes")}
              className={activeTab === "pendientes" ? "bg-red-500" : ""}
            >
              Pendientes ({correctivosData.pendientes.length})
            </Button>
            <Button
              variant={activeTab === "completados" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("completados")}
              className={activeTab === "completados" ? "bg-red-500" : ""}
            >
              Completados ({correctivosData.completados.length})
            </Button>
          </div>

          {/* Botón Agregar */}
          {activeTab === "pendientes" && (
            <div className="flex justify-end">
              <Button
                onClick={() => setShowAddForm(!showAddForm)}
                className="bg-red-500 hover:bg-red-600 flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                Reportar Correctivo
              </Button>
            </div>
          )}

          {/* Formulario Agregar */}
          {showAddForm && (
            <div className="border rounded-lg p-4 bg-red-50 border-red-200">
              <h4 className="font-medium mb-3 text-red-800">Reportar Nuevo Correctivo</h4>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label>Repuesto Afectado</Label>
                  <Select onValueChange={(value) => setNewCorrectivo(prev => ({...prev, repuesto: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar repuesto" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="REP001">FILTRO HEPA H14</SelectItem>
                      <SelectItem value="REP002">BOMBA PERISTALTICA</SelectItem>
                      <SelectItem value="REP003">SENSOR TEMPERATURA</SelectItem>
                      <SelectItem value="REP006">PLACA ELECTRONICA</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Prioridad</Label>
                  <Select 
                    value={newCorrectivo.prioridad}
                    onValueChange={(value) => setNewCorrectivo(prev => ({...prev, prioridad: value}))}
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
                <div>
                  <Label>Equipo Afectado</Label>
                  <Input
                    placeholder="Código o nombre del equipo"
                    value={newCorrectivo.equipoAfectado}
                    onChange={(e) => setNewCorrectivo(prev => ({...prev, equipoAfectado: e.target.value}))}
                  />
                </div>
                <div>
                  <Label>Técnico Asignado</Label>
                  <Select onValueChange={(value) => setNewCorrectivo(prev => ({...prev, tecnicoAsignado: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar técnico" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="Ing. Carlos Molano">Ing. Carlos Molano</SelectItem>
                      <SelectItem value="Téc. María González">Téc. María González</SelectItem>
                      <SelectItem value="Ing. Luis Pérez">Ing. Luis Pérez</SelectItem>
                      <SelectItem value="Téc. Ana López">Téc. Ana López</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Tiempo Estimado</Label>
                  <Input
                    placeholder="ej: 2 horas"
                    value={newCorrectivo.tiempoEstimado}
                    onChange={(e) => setNewCorrectivo(prev => ({...prev, tiempoEstimado: e.target.value}))}
                  />
                </div>
                <div className="col-span-2">
                  <Label>Descripción de la Falla</Label>
                  <Textarea
                    placeholder="Describa detalladamente la falla o problema..."
                    value={newCorrectivo.falla}
                    onChange={(e) => setNewCorrectivo(prev => ({...prev, falla: e.target.value}))}
                    rows={3}
                  />
                </div>
              </div>
              <div className="flex justify-end space-x-2 mt-4">
                <Button variant="outline" onClick={() => setShowAddForm(false)}>
                  Cancelar
                </Button>
                <Button onClick={handleAddCorrectivo} className="bg-red-500 hover:bg-red-600">
                  Reportar Correctivo
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
                    <TableHead>Repuesto/Falla</TableHead>
                    <TableHead>Equipo Afectado</TableHead>
                    <TableHead>Técnico</TableHead>
                    <TableHead className="text-center">Prioridad</TableHead>
                    <TableHead className="text-center">Estado</TableHead>
                    <TableHead className="text-center">Tiempo Est.</TableHead>
                    <TableHead className="text-center">Acciones</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {correctivosData.pendientes.map((item) => (
                    <TableRow key={item.id}>
                      <TableCell>
                        <div className="space-y-1">
                          <div className="font-medium">{item.repuesto}</div>
                          <div className="text-xs text-gray-500">{item.codigo}</div>
                          <div className="text-xs text-red-600 font-medium">{item.falla}</div>
                          <div className="text-xs text-gray-400">Reportado: {item.fechaReporte}</div>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="flex items-center gap-2">
                          <Wrench className="w-4 h-4 text-gray-400" />
                          <span className="text-sm">{item.equipoAfectado}</span>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="flex items-center gap-2">
                          <User className="w-4 h-4 text-gray-400" />
                          <span className="text-sm">{item.tecnicoAsignado}</span>
                        </div>
                      </TableCell>
                      <TableCell className="text-center">
                        <Badge className={`${getPrioridadColor(item.prioridad)} text-xs`}>
                          {item.prioridad}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-center">
                        <div className="flex items-center justify-center gap-1">
                          {getEstadoIcon(item.estado)}
                          <Badge className={`${getEstadoColor(item.estado)} text-xs`}>
                            {item.estado}
                          </Badge>
                        </div>
                      </TableCell>
                      <TableCell className="text-center text-sm">{item.tiempoEstimado}</TableCell>
                      <TableCell className="text-center">
                        <Button
                          size="sm"
                          onClick={() => handleCompleteCorrectivo(item.id)}
                          className="bg-red-500 hover:bg-red-600 h-6 px-2"
                        >
                          <CheckCircle className="w-3 h-3" />
                        </Button>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </div>
          )}

          {/* Tabla Completados */}
          {activeTab === "completados" && (
            <div className="border rounded-lg">
              <Table>
                <TableHeader className="bg-gray-50">
                  <TableRow>
                    <TableHead>Repuesto/Falla</TableHead>
                    <TableHead>Solución</TableHead>
                    <TableHead>Técnico</TableHead>
                    <TableHead className="text-center">Tiempo Real</TableHead>
                    <TableHead className="text-center">Costo</TableHead>
                    <TableHead className="text-center">Fecha</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {correctivosData.completados.map((item) => (
                    <TableRow key={item.id}>
                      <TableCell>
                        <div className="space-y-1">
                          <div className="font-medium">{item.repuesto}</div>
                          <div className="text-xs text-gray-500">{item.codigo}</div>
                          <div className="text-xs text-gray-600">{item.falla}</div>
                        </div>
                      </TableCell>
                      <TableCell className="text-sm">{item.solucion}</TableCell>
                      <TableCell>
                        <div className="flex items-center gap-2">
                          <CheckCircle className="w-4 h-4 text-green-600" />
                          <span className="text-sm">{item.tecnico}</span>
                        </div>
                      </TableCell>
                      <TableCell className="text-center text-sm font-medium">{item.tiempoReal}</TableCell>
                      <TableCell className="text-center text-sm font-medium text-green-600">
                        ${item.costo.toLocaleString()}
                      </TableCell>
                      <TableCell className="text-center text-sm">{item.fechaCompletado}</TableCell>
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