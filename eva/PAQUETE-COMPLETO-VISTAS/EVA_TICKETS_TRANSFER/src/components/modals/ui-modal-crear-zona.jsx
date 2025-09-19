"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { MapPin, X } from "lucide-react";

export default function UIModalCrearZona({ isOpen, onClose }) {
  const [formData, setFormData] = useState({
    nombre: "",
    codigo: "",
    piso: "",
    descripcion: "",
    responsable: "",
    ubicacion: ""
  });

  const handleInputChange = (field, value) => {
    setFormData(prev => ({ ...prev, [field]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    
    if (!formData.nombre || !formData.codigo) {
      alert("Por favor complete los campos obligatorios");
      return;
    }

    const zonaData = {
      id: Date.now(),
      ...formData,
      fechaCreacion: new Date().toISOString()
    };

    console.log("Nueva zona creada:", zonaData);
    alert(`✅ Zona "${formData.nombre}" creada exitosamente`);
    
    // Reset form
    setFormData({
      nombre: "",
      codigo: "",
      piso: "",
      descripcion: "",
      responsable: "",
      ubicacion: ""
    });
    
    onClose();
  };

  const handleClose = () => {
    setFormData({
      nombre: "",
      codigo: "",
      piso: "",
      descripcion: "",
      responsable: "",
      ubicacion: ""
    });
    onClose();
  };

  return (
    <Dialog open={isOpen} onOpenChange={handleClose}>
      <DialogContent className="max-w-md">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <MapPin className="w-5 h-5 text-green-600" />
            Crear Nueva Zona
          </DialogTitle>
          <Button
            variant="ghost"
            size="sm"
            className="absolute right-4 top-4"
            onClick={handleClose}
          >
            <X className="w-4 h-4" />
          </Button>
        </DialogHeader>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="nombre" className="text-sm font-medium">
                Nombre de la Zona *
              </Label>
              <Input
                id="nombre"
                value={formData.nombre}
                onChange={(e) => handleInputChange("nombre", e.target.value)}
                placeholder="Ej: ZONA MOLANO1"
                className="mt-1"
                required
              />
            </div>
            <div>
              <Label htmlFor="codigo" className="text-sm font-medium">
                Código *
              </Label>
              <Input
                id="codigo"
                value={formData.codigo}
                onChange={(e) => handleInputChange("codigo", e.target.value)}
                placeholder="Ej: ZM01"
                className="mt-1"
                required
              />
            </div>
          </div>

          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="piso" className="text-sm font-medium">
                Piso
              </Label>
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
              <Label htmlFor="responsable" className="text-sm font-medium">
                Responsable
              </Label>
              <Input
                id="responsable"
                value={formData.responsable}
                onChange={(e) => handleInputChange("responsable", e.target.value)}
                placeholder="Nombre del responsable"
                className="mt-1"
              />
            </div>
          </div>

          <div>
            <Label htmlFor="ubicacion" className="text-sm font-medium">
              Ubicación
            </Label>
            <Input
              id="ubicacion"
              value={formData.ubicacion}
              onChange={(e) => handleInputChange("ubicacion", e.target.value)}
              placeholder="Ubicación física"
              className="mt-1"
            />
          </div>

          <div>
            <Label htmlFor="descripcion" className="text-sm font-medium">
              Descripción
            </Label>
            <Textarea
              id="descripcion"
              value={formData.descripcion}
              onChange={(e) => handleInputChange("descripcion", e.target.value)}
              placeholder="Descripción de la zona..."
              rows={3}
              className="mt-1"
            />
          </div>

          <div className="flex justify-end gap-2 pt-4">
            <Button type="button" variant="outline" onClick={handleClose}>
              Cancelar
            </Button>
            <Button type="submit" className="bg-green-600 hover:bg-green-700">
              Crear Zona
            </Button>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  );
}