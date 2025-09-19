"use client";

import { useState } from "react";
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { Badge } from "@/components/ui/badge";
import { MapPin, Building, Users, Plus, X } from "lucide-react";

export default function UIModalAgregarServicio({ isOpen, onClose }) {
  const [formData, setFormData] = useState({
    nombre: "",
    zona: "",
    piso: "",
    centroCosto: "",
    sede: "",
    equiposAsociados: [],
    areasAsociadas: []
  });

  // Datos simulados - en producción vendrían de la base de datos
  const zonasDisponibles = [
    { id: 1, nombre: "ZONA MOLANO1", codigo: "ZM01" },
    { id: 2, nombre: "ZONA CRISTIAN", codigo: "ZC01" },
    { id: 3, nombre: "ZONA SALUD1", codigo: "ZS01" },
    { id: 4, nombre: "N/R", codigo: "NR" }
  ];

  const sedesDisponibles = [
    { id: 1, nombre: "SEDE PRINCIPAL", codigo: "SP01" },
    { id: 2, nombre: "NORTE", codigo: "NT01" },
    { id: 3, nombre: "CARTAGO", codigo: "CT01" }
  ];

  const areasDisponibles = [
    { id: 1, nombre: "Consulta Externa", codigo: "CE01" },
    { id: 2, nombre: "Hospitalización", codigo: "HP01" },
    { id: 3, nombre: "Urgencias", codigo: "UR01" },
    { id: 4, nombre: "Quirófanos", codigo: "QR01" }
  ];

  const equiposDisponibles = [
    { id: 1, nombre: "Monitor de Signos Vitales", codigo: "MSV001" },
    { id: 2, nombre: "Ventilador Mecánico", codigo: "VM001" },
    { id: 3, nombre: "Desfibrilador", codigo: "DF001" },
    { id: 4, nombre: "Bomba de Infusión", codigo: "BI001" }
  ];

  const centrosCosto = [
    "ADMINISTRACION UES URGENCIAS",
    "ALMACEN GENERAL",
    "GINECOBSTETRICIA",
    "INVENTARIOS",
    "HEMODINAMIA",
    "SALA CIRUGIA PEDIATRICA ANA FR",
    "SALA PEDIATRIA GENERAL"
  ];

  const handleSubmit = (e) => {
    e.preventDefault();
    
    if (!formData.nombre || !formData.zona || !formData.piso || !formData.centroCosto || !formData.sede) {
      alert("Por favor complete todos los campos obligatorios");
      return;
    }

    const servicioData = {
      id: Date.now(),
      ...formData,
      fechaCreacion: new Date().toISOString()
    };

    console.log("Nuevo servicio creado:", servicioData);
    alert(`✅ Servicio "${formData.nombre}" creado exitosamente`);
    
    // Reset form
    setFormData({
      nombre: "",
      zona: "",
      piso: "",
      centroCosto: "",
      sede: "",
      equiposAsociados: [],
      areasAsociadas: []
    });
    
    onClose();
  };

  const handleInputChange = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));
  };

  const handleAddEquipo = (equipo) => {
    if (!formData.equiposAsociados.find(e => e.id === equipo.id)) {
      setFormData(prev => ({
        ...prev,
        equiposAsociados: [...prev.equiposAsociados, equipo]
      }));
    }
  };

  const handleRemoveEquipo = (equipoId) => {
    setFormData(prev => ({
      ...prev,
      equiposAsociados: prev.equiposAsociados.filter(e => e.id !== equipoId)
    }));
  };

  const handleAddArea = (area) => {
    if (!formData.areasAsociadas.find(a => a.id === area.id)) {
      setFormData(prev => ({
        ...prev,
        areasAsociadas: [...prev.areasAsociadas, area]
      }));
    }
  };

  const handleRemoveArea = (areaId) => {
    setFormData(prev => ({
      ...prev,
      areasAsociadas: prev.areasAsociadas.filter(a => a.id !== areaId)
    }));
  };

  const handleClose = () => {
    setFormData({
      nombre: "",
      zona: "",
      piso: "",
      centroCosto: "",
      sede: "",
      equiposAsociados: [],
      areasAsociadas: []
    });
    onClose();
  };

  return (
    <Dialog open={isOpen} onOpenChange={handleClose}>
      <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="text-lg font-semibold text-gray-800 border-b-2 border-teal-500 pb-2">
            Crear Nuevo Servicio
          </DialogTitle>
        </DialogHeader>

        <form onSubmit={handleSubmit} className="space-y-6 mt-4">
          {/* Información Básica */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <Label htmlFor="nombre" className="text-sm font-medium text-gray-700">
                Nombre del Servicio *
              </Label>
              <Input
                id="nombre"
                type="text"
                placeholder="Ingrese el nombre del servicio"
                value={formData.nombre}
                onChange={(e) => handleInputChange("nombre", e.target.value)}
                className="mt-1"
                required
              />
            </div>

            <div>
              <Label htmlFor="centroCosto" className="text-sm font-medium text-gray-700">
                Centro de Costo *
              </Label>
              <Select value={formData.centroCosto} onValueChange={(value) => handleInputChange("centroCosto", value)}>
                <SelectTrigger className="mt-1">
                  <SelectValue placeholder="Seleccionar centro de costo" />
                </SelectTrigger>
                <SelectContent>
                  {centrosCosto.map((centro) => (
                    <SelectItem key={centro} value={centro}>
                      {centro}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            </div>
          </div>

          {/* Zona, Piso y Sede */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
              <Label className="text-sm font-medium text-gray-700 flex items-center gap-2">
                <MapPin className="w-4 h-4 text-green-600" />
                Zona *
              </Label>
              <Select value={formData.zona} onValueChange={(value) => handleInputChange("zona", value)}>
                <SelectTrigger className="mt-1">
                  <SelectValue placeholder="Seleccionar zona" />
                </SelectTrigger>
                <SelectContent>
                  {zonasDisponibles.map((zona) => (
                    <SelectItem key={zona.id} value={zona.nombre}>
                      {zona.nombre} ({zona.codigo})
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            </div>

            <div>
              <Label className="text-sm font-medium text-gray-700">Piso *</Label>
              <Select value={formData.piso} onValueChange={(value) => handleInputChange("piso", value)}>
                <SelectTrigger className="mt-1">
                  <SelectValue placeholder="Seleccionar piso" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="PLANTA BAJA">PLANTA BAJA</SelectItem>
                  <SelectItem value="PISO 1">PISO 1</SelectItem>
                  <SelectItem value="PISO 2">PISO 2</SelectItem>
                  <SelectItem value="PISO 3">PISO 3</SelectItem>
                  <SelectItem value="PISO 4">PISO 4</SelectItem>
                  <SelectItem value="PISO 5">PISO 5</SelectItem>
                  <SelectItem value="N/R">N/R</SelectItem>
                </SelectContent>
              </Select>
            </div>

            <div>
              <Label className="text-sm font-medium text-gray-700 flex items-center gap-2">
                <Building className="w-4 h-4 text-purple-600" />
                Sede *
              </Label>
              <Select value={formData.sede} onValueChange={(value) => handleInputChange("sede", value)}>
                <SelectTrigger className="mt-1">
                  <SelectValue placeholder="Seleccionar sede" />
                </SelectTrigger>
                <SelectContent>
                  {sedesDisponibles.map((sede) => (
                    <SelectItem key={sede.id} value={sede.nombre}>
                      {sede.nombre} ({sede.codigo})
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            </div>
          </div>

          {/* Equipos Asociados */}
          <div>
            <Label className="text-sm font-medium text-gray-700 mb-2 block">
              Equipos Asociados ({formData.equiposAsociados.length})
            </Label>
            <div className="border rounded-lg p-4 bg-gray-50">
              <div className="mb-3">
                <Select onValueChange={(value) => {
                  const equipo = equiposDisponibles.find(e => e.id === parseInt(value));
                  if (equipo) handleAddEquipo(equipo);
                }}>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccionar equipo para asociar" />
                  </SelectTrigger>
                  <SelectContent>
                    {equiposDisponibles.map((equipo) => (
                      <SelectItem key={equipo.id} value={equipo.id.toString()}>
                        {equipo.nombre} ({equipo.codigo})
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="flex flex-wrap gap-2">
                {formData.equiposAsociados.map((equipo) => (
                  <Badge key={equipo.id} variant="secondary" className="flex items-center gap-1">
                    {equipo.nombre}
                    <X 
                      className="w-3 h-3 cursor-pointer hover:text-red-600" 
                      onClick={() => handleRemoveEquipo(equipo.id)}
                    />
                  </Badge>
                ))}
              </div>
            </div>
          </div>

          {/* Áreas Asociadas */}
          <div>
            <Label className="text-sm font-medium text-gray-700 mb-2 block flex items-center gap-2">
              <Users className="w-4 h-4 text-orange-600" />
              Áreas Asociadas ({formData.areasAsociadas.length})
            </Label>
            <div className="border rounded-lg p-4 bg-gray-50">
              <div className="mb-3">
                <Select onValueChange={(value) => {
                  const area = areasDisponibles.find(a => a.id === parseInt(value));
                  if (area) handleAddArea(area);
                }}>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccionar área para asociar" />
                  </SelectTrigger>
                  <SelectContent>
                    {areasDisponibles.map((area) => (
                      <SelectItem key={area.id} value={area.id.toString()}>
                        {area.nombre} ({area.codigo})
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="flex flex-wrap gap-2">
                {formData.areasAsociadas.map((area) => (
                  <Badge key={area.id} variant="secondary" className="flex items-center gap-1">
                    {area.nombre}
                    <X 
                      className="w-3 h-3 cursor-pointer hover:text-red-600" 
                      onClick={() => handleRemoveArea(area.id)}
                    />
                  </Badge>
                ))}
              </div>
            </div>
          </div>

          {/* Botones */}
          <div className="flex justify-end gap-2 pt-6 border-t">
            <Button type="button" variant="outline" onClick={handleClose}>
              Cancelar
            </Button>
            <Button type="submit" className="bg-blue-500 hover:bg-blue-600">
              Crear Servicio
            </Button>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  );
}