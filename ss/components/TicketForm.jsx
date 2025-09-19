"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";

export default function TicketForm({ type, onSubmit, onClose, initialData, isEdit }) {
  const [formData, setFormData] = useState({
    priority: initialData?.priority || "",
    description: initialData?.description || "",
    equipment: initialData?.equipment || "",
    location: initialData?.location || "",
    date: initialData?.date || "",
    time: initialData?.time || "",
    technician: initialData?.technician || "",
    observations: initialData?.observations || "",
    status: initialData?.status || "Abierto"
  });

  const equipmentOptions = {
    biomedicos: [
      "Ventilador Mecánico",
      "Monitor de Signos Vitales",
      "Bomba de Infusión",
      "Desfibrilador",
      "Electrocardiografo",
      "Rayos X Portátil"
    ],
    industriales: [
      "Sistema de Aire Acondicionado",
      "Sistema Eléctrico",
      "Ascensor",
      "Planta Eléctrica",
      "Sistema de Gases Medicinales",
      "Calderas"
    ],
    transporte: [
      "Ambulancia Básica",
      "Ambulancia Medicalizada",
      "Vehículo de Transporte",
      "Motocicleta",
      "Camioneta",
      "Bus"
    ]
  };

  const technicians = {
    biomedicos: [
      "Dr. García López - Biomédico",
      "Ing. Martínez Ruiz - Biomédico",
      "Tec. López Herrera - Biomédico"
    ],
    industriales: [
      "Ing. Rodríguez Silva - Industrial",
      "Tec. Fernández Castro - Industrial",
      "Ing. Pérez Morales - Industrial"
    ],
    transporte: [
      "Mec. González Vargas - Transporte",
      "Tec. Ramírez Soto - Transporte",
      "Ing. Torres Jiménez - Transporte"
    ]
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSubmit({
      ...formData,
      type,
      date: formData.date || new Date().toISOString().split('T')[0],
      time: formData.time || new Date().toTimeString().split(' ')[0]
    });
    onClose();
  };

  const handleChange = (field, value) => {
    setFormData(prev => ({ ...prev, [field]: value }));
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <Label htmlFor="number">Número</Label>
          <Input id="number" placeholder="Automático" disabled />
        </div>
        <div>
          <Label htmlFor="priority">Prioridad</Label>
          <Select value={formData.priority} onValueChange={(value) => handleChange("priority", value)}>
            <SelectTrigger>
              <SelectValue placeholder="Seleccionar prioridad" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="alta">Alta</SelectItem>
              <SelectItem value="media">Media</SelectItem>
              <SelectItem value="baja">Baja</SelectItem>
            </SelectContent>
          </Select>
        </div>
      </div>

      <div>
        <Label htmlFor="description">Descripción</Label>
        <Textarea
          id="description"
          placeholder="Describa el trabajo a realizar"
          rows={4}
          value={formData.description}
          onChange={(e) => handleChange("description", e.target.value)}
          required
        />
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <Label htmlFor="equipment">Equipo</Label>
          <Select value={formData.equipment} onValueChange={(value) => handleChange("equipment", value)}>
            <SelectTrigger>
              <SelectValue placeholder="Seleccionar equipo" />
            </SelectTrigger>
            <SelectContent>
              {equipmentOptions[type]?.map((equipment) => (
                <SelectItem key={equipment} value={equipment}>
                  {equipment}
                </SelectItem>
              ))}
            </SelectContent>
          </Select>
        </div>
        <div>
          <Label htmlFor="location">Ubicación</Label>
          <Input
            id="location"
            placeholder="Ubicación del equipo"
            value={formData.location}
            onChange={(e) => handleChange("location", e.target.value)}
          />
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <Label htmlFor="date">Fecha</Label>
          <Input
            id="date"
            type="date"
            value={formData.date}
            onChange={(e) => handleChange("date", e.target.value)}
          />
        </div>
        <div>
          <Label htmlFor="time">Hora</Label>
          <Input
            id="time"
            type="time"
            value={formData.time}
            onChange={(e) => handleChange("time", e.target.value)}
          />
        </div>
      </div>

      <div>
        <Label htmlFor="technician">Técnico responsable</Label>
        <Select value={formData.technician} onValueChange={(value) => handleChange("technician", value)}>
          <SelectTrigger>
            <SelectValue placeholder="Seleccionar técnico" />
          </SelectTrigger>
          <SelectContent>
            {technicians[type]?.map((technician) => (
              <SelectItem key={technician} value={technician}>
                {technician}
              </SelectItem>
            ))}
          </SelectContent>
        </Select>
      </div>

      <div>
        <Label htmlFor="observations">Observaciones</Label>
        <Textarea
          id="observations"
          placeholder="Observaciones adicionales"
          rows={3}
          value={formData.observations}
          onChange={(e) => handleChange("observations", e.target.value)}
        />
      </div>

      {isEdit && (
        <div>
          <Label htmlFor="status">Estado</Label>
          <Select value={formData.status} onValueChange={(value) => handleChange("status", value)}>
            <SelectTrigger>
              <SelectValue placeholder="Seleccionar estado" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="Abierto">Abierto</SelectItem>
              <SelectItem value="En Proceso">En Proceso</SelectItem>
              <SelectItem value="Cerrado">Cerrado</SelectItem>
            </SelectContent>
          </Select>
        </div>
      )}

      <div className="flex justify-end space-x-2 pt-4">
        <Button type="button" variant="outline" onClick={onClose}>
          Cancelar
        </Button>
        <Button type="submit" className="bg-blue-600 hover:bg-blue-700">
          {isEdit ? 'Actualizar Ticket' : 'Crear Ticket'}
        </Button>
      </div>
    </form>
  );
}