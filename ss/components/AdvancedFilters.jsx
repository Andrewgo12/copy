"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Card, CardContent } from "@/components/ui/card";
import { Calendar, Filter, X } from "lucide-react";

export default function AdvancedFilters({ onApplyFilters, onClearFilters, isOpen, onToggle }) {
  const [filters, setFilters] = useState({
    dateFrom: "",
    dateTo: "",
    priority: "",
    status: "",
    technician: "",
    equipment: ""
  });

  const handleFilterChange = (key, value) => {
    setFilters(prev => ({ ...prev, [key]: value }));
  };

  const applyFilters = () => {
    onApplyFilters(filters);
  };

  const clearFilters = () => {
    setFilters({
      dateFrom: "",
      dateTo: "",
      priority: "",
      status: "",
      technician: "",
      equipment: ""
    });
    onClearFilters();
  };

  if (!isOpen) return null;

  return (
    <Card className="mb-4">
      <CardContent className="p-4">
        <div className="flex items-center justify-between mb-4">
          <h3 className="font-semibold flex items-center">
            <Filter className="w-4 h-4 mr-2" />
            Filtros Avanzados
          </h3>
          <Button variant="ghost" size="sm" onClick={onToggle}>
            <X className="w-4 h-4" />
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div>
            <Label>Fecha Desde</Label>
            <Input
              type="date"
              value={filters.dateFrom}
              onChange={(e) => handleFilterChange("dateFrom", e.target.value)}
            />
          </div>
          
          <div>
            <Label>Fecha Hasta</Label>
            <Input
              type="date"
              value={filters.dateTo}
              onChange={(e) => handleFilterChange("dateTo", e.target.value)}
            />
          </div>
          
          <div>
            <Label>Prioridad</Label>
            <Select value={filters.priority} onValueChange={(value) => handleFilterChange("priority", value)}>
              <SelectTrigger>
                <SelectValue placeholder="Todas las prioridades" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="">Todas</SelectItem>
                <SelectItem value="alta">Alta</SelectItem>
                <SelectItem value="media">Media</SelectItem>
                <SelectItem value="baja">Baja</SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <div>
            <Label>Estado</Label>
            <Select value={filters.status} onValueChange={(value) => handleFilterChange("status", value)}>
              <SelectTrigger>
                <SelectValue placeholder="Todos los estados" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="">Todos</SelectItem>
                <SelectItem value="Abierto">Abierto</SelectItem>
                <SelectItem value="En Proceso">En Proceso</SelectItem>
                <SelectItem value="Cerrado">Cerrado</SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <div>
            <Label>Técnico</Label>
            <Input
              placeholder="Nombre del técnico"
              value={filters.technician}
              onChange={(e) => handleFilterChange("technician", e.target.value)}
            />
          </div>
          
          <div>
            <Label>Equipo</Label>
            <Input
              placeholder="Tipo de equipo"
              value={filters.equipment}
              onChange={(e) => handleFilterChange("equipment", e.target.value)}
            />
          </div>
        </div>
        
        <div className="flex justify-end space-x-2 mt-4">
          <Button variant="outline" onClick={clearFilters}>
            Limpiar Filtros
          </Button>
          <Button onClick={applyFilters}>
            Aplicar Filtros
          </Button>
        </div>
      </CardContent>
    </Card>
  );
}