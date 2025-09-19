"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { Input } from "../../ui/input";
import { Label } from "../../ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "../../ui/select";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "../../ui/table";
import { Calendar, Clock, CheckCircle, AlertCircle, Plus } from "lucide-react";

export default function UIModalPreventivos({ isOpen, onClose }) {
  const [activeTab, setActiveTab] = useState("programados");
  const [showAddForm, setShowAddForm] = useState(false);

  const preventivosData = {
    programados: [
      {
        id: 1,
        repuesto: "FILTRO HEPA H14",
        codigo: "REP001",
        proximaFecha: "2024-04-10",
        frecuencia: "TRIMESTRAL",
        responsable: "Ing. Carlos Molano",
        estado: "PENDIENTE",
        diasRestantes: 15
      },
      {
        id: 2,
        repuesto: "BOMBA PERISTALTICA",
        codigo: "REP002",
        proximaFecha: "2024-04-18",
        frecuencia: "TRIMESTRAL",
        responsable: "Téc. María González",
        estado: "PENDIENTE",
        diasRestantes: 23
      },
      {
        id: 3,
        repuesto: "SENSOR TEMPERATURA",
        codigo: "REP003",
        proximaFecha: "2024-03-28",
        frecuencia: "MENSUAL",
        responsable: "Ing. Luis Pérez",
        estado: "VENCIDO",
        diasRestantes: -2
      }
    ],
    completados: [
      {
        id: 4,
        repuesto: "VÁLVULA SOLENOIDE",
        codigo: "REP004",
        fechaCompletado: "2024-03-20",
        responsable: "Téc. Ana López",
        observaciones: "Mantenimiento preventivo completado sin novedades"
      }
    ]
  };

  const [newPreventivo, setNewPreventivo] = useState({
    repuesto: "",
    frecuencia: "",
    proximaFecha: "",
    responsable: "",
    observaciones: ""
  });

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "PENDIENTE": return "bg-yellow-100 text-yellow-800";
      case "VENCIDO": return "bg-red-100 text-red-800";
      case "COMPLETADO": return "bg-green-100 text-green-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  const getDiasColor = (dias) => {
    if (dias < 0) return "text-red-600 font-bold";
    if (dias <= 7) return "text-orange-600 font-bold";
    return "text-green-600";
  };

  const handleAddPreventivo = () => {
    console.log("Agregando preventivo:", newPreventivo);
    setShowAddForm(false);
    setNewPreventivo({
      repuesto: "",
      frecuencia: "",
      proximaFecha: "",
      responsable: "",
      observaciones: ""
    });
  };

  const handleCompletePreventivo = (id) => {
    console.log("Completando preventivo:", id);
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[800px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Calendar className="w-5 h-5 text-green-600" />
            Mantenimientos Preventivos
          </DialogTitle>
          <DialogDescription>
            Gestión de mantenimientos preventivos programados para repuestos críticos.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-4">
          {/* Tabs */}
          <div className="flex space-x-1 bg-gray-100 p-1 rounded-lg">
            <Button
              variant={activeTab === "programados" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("programados")}
              className={activeTab === "programados" ? "bg-green-500" : ""}
            >
              Programados ({preventivosData.programados.length})
            </Button>
            <Button
              variant={activeTab === "completados" ? "default" : "ghost"}
              size="sm"
              onClick={() => setActiveTab("completados")}
              className={activeTab === "completados" ? "bg-green-500" : ""}
            >
              Completados ({preventivosData.completados.length})
            </Button>
          </div>

          {/* Botón Agregar */}
          {activeTab === "programados" && (
            <div className="flex justify-end">
              <Button
                onClick={() => setShowAddForm(!showAddForm)}
                className="bg-green-500 hover:bg-green-600 flex items-center gap-2"
              >
                <Plus className="w-4 h-4" />
                Programar Preventivo
              </Button>
            </div>
          )}

          {/* Formulario Agregar */}
          {showAddForm && (
            <div className="border rounded-lg p-4 bg-gray-50">
              <h4 className="font-medium mb-3">Programar Nuevo Preventivo</h4>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <Label>Repuesto</Label>
                  <Select onValueChange={(value) => setNewPreventivo(prev => ({...prev, repuesto: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar repuesto" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="REP001">FILTRO HEPA H14</SelectItem>
                      <SelectItem value="REP002">BOMBA PERISTALTICA</SelectItem>
                      <SelectItem value="REP003">SENSOR TEMPERATURA</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Frecuencia</Label>
                  <Select onValueChange={(value) => setNewPreventivo(prev => ({...prev, frecuencia: value}))}>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccionar frecuencia" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="SEMANAL">SEMANAL</SelectItem>
                      <SelectItem value="MENSUAL">MENSUAL</SelectItem>
                      <SelectItem value="TRIMESTRAL">TRIMESTRAL</SelectItem>
                      <SelectItem value="SEMESTRAL">SEMESTRAL</SelectItem>
                    </SelectContent>
                  </Select>
                </div>
                <div>
                  <Label>Próxima Fecha</Label>
                  <Input
                    type="date"
                    value={newPreventivo.proximaFecha}
                    onChange={(e) => setNewPreventivo(prev => ({...prev, proximaFecha: e.target.value}))}
                  />
                </div>
                <div>
                  <Label>Responsable</Label>
                  <Input
                    placeholder="Nombre del responsable"
                    value={newPreventivo.responsable}
                    onChange={(e) => setNewPreventivo(prev => ({...prev, responsable: e.target.value}))}
                  />
                </div>
              </div>
              <div className="flex justify-end space-x-2 mt-4">
                <Button variant="outline" onClick={() => setShowAddForm(false)}>
                  Cancelar
                </Button>
                <Button onClick={handleAddPreventivo} className="bg-green-500 hover:bg-green-600">
                  Programar
                </Button>
              </div>
            </div>
          )}

          {/* Tabla Programados */}
          {activeTab === "programados" && (
            <div className="border rounded-lg">
              <Table>
                <TableHeader className="bg-gray-50">
                  <TableRow>
                    <TableHead>Repuesto</TableHead>
                    <TableHead>Próxima Fecha</TableHead>
                    <TableHead>Frecuencia</TableHead>
                    <TableHead>Responsable</TableHead>
                    <TableHead className="text-center">Estado</TableHead>
                    <TableHead className="text-center">Acciones</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {preventivosData.programados.map((item) => (
                    <TableRow key={item.id}>
                      <TableCell>
                        <div>
                          <div className="font-medium">{item.repuesto}</div>
                          <div className="text-xs text-gray-500">{item.codigo}</div>
                        </div>
                      </TableCell>
                      <TableCell>
                        <div className="flex items-center gap-2">
                          <Calendar className="w-4 h-4 text-gray-400" />
                          <span>{item.proximaFecha}</span>
                        </div>
                        <div className={`text-xs ${getDiasColor(item.diasRestantes)}`}>
                          {item.diasRestantes > 0 ? `${item.diasRestantes} días` : `Vencido hace ${Math.abs(item.diasRestantes)} días`}
                        </div>
                      </TableCell>
                      <TableCell>
                        <Badge variant="outline" className="text-xs">
                          {item.frecuencia}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-sm">{item.responsable}</TableCell>
                      <TableCell className="text-center">
                        <Badge className={`${getEstadoColor(item.estado)} text-xs`}>
                          {item.estado}
                        </Badge>
                      </TableCell>
                      <TableCell className="text-center">
                        <Button
                          size="sm"
                          onClick={() => handleCompletePreventivo(item.id)}
                          className="bg-green-500 hover:bg-green-600 h-6 px-2"
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
                    <TableHead>Repuesto</TableHead>
                    <TableHead>Fecha Completado</TableHead>
                    <TableHead>Responsable</TableHead>
                    <TableHead>Observaciones</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {preventivosData.completados.map((item) => (
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
                          <span>{item.fechaCompletado}</span>
                        </div>
                      </TableCell>
                      <TableCell className="text-sm">{item.responsable}</TableCell>
                      <TableCell className="text-sm text-gray-600">{item.observaciones}</TableCell>
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