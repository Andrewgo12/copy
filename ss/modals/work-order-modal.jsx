"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Badge } from "@/components/ui/badge";
import { Calendar, User, Wrench, Clock, FileText } from "lucide-react";

export default function WorkOrderModal({ isOpen, onClose, ticket }) {
  const [workOrder, setWorkOrder] = useState({
    priority: ticket?.priority || "media",
    assignedTo: ticket?.technician || "",
    estimatedTime: ticket?.estimatedTime || "",
    materials: "",
    instructions: "",
    status: ticket?.status || "Pendiente"
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Orden de trabajo:", { ...workOrder, ticketId: ticket?.id });
    onClose();
  };

  if (!ticket) return null;

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center">
            <Wrench className="w-5 h-5 mr-2" />
            Orden de Trabajo - {ticket.id}
          </DialogTitle>
        </DialogHeader>
        
        <div className="p-6 space-y-6">
          {/* Información del Ticket */}
          <div className="bg-gray-50 p-4 rounded-lg">
            <h3 className="font-semibold mb-3">Información del Ticket</h3>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <span className="font-medium">Equipo:</span> {ticket.equipment}
              </div>
              <div>
                <span className="font-medium">Ubicación:</span> {ticket.location}
              </div>
              <div>
                <span className="font-medium">Fecha:</span> {ticket.date}
              </div>
              <div>
                <span className="font-medium">Estado:</span>
                <Badge className={
                  ticket.status === 'COMPLETADO' ? 'bg-green-100 text-green-800 ml-2' :
                  ticket.status === 'EN PROCESO' ? 'bg-yellow-100 text-yellow-800 ml-2' :
                  'bg-red-100 text-red-800 ml-2'
                }>
                  {ticket.status}
                </Badge>
              </div>
            </div>
          </div>

          {/* Formulario de Orden de Trabajo */}
          <form onSubmit={handleSubmit} className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <Label>Prioridad</Label>
                <Select 
                  value={workOrder.priority} 
                  onValueChange={(value) => setWorkOrder(prev => ({...prev, priority: value}))}
                >
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="alta">Alta</SelectItem>
                    <SelectItem value="media">Media</SelectItem>
                    <SelectItem value="baja">Baja</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              
              <div>
                <Label>Técnico Asignado</Label>
                <Select 
                  value={workOrder.assignedTo} 
                  onValueChange={(value) => setWorkOrder(prev => ({...prev, assignedTo: value}))}
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccionar técnico" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="Juan Sebastian">Juan Sebastian</SelectItem>
                    <SelectItem value="Aura María">Aura María</SelectItem>
                    <SelectItem value="Angelica Maria">Angelica Maria</SelectItem>
                    <SelectItem value="Natalia Pedrerosa">Natalia Pedrerosa</SelectItem>
                    <SelectItem value="Dayana Raigosa">Dayana Raigosa</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <Label>Tiempo Estimado</Label>
                <Input
                  value={workOrder.estimatedTime}
                  onChange={(e) => setWorkOrder(prev => ({...prev, estimatedTime: e.target.value}))}
                  placeholder="ej: 2 horas"
                />
              </div>
              
              <div>
                <Label>Estado de la Orden</Label>
                <Select 
                  value={workOrder.status} 
                  onValueChange={(value) => setWorkOrder(prev => ({...prev, status: value}))}
                >
                  <SelectTrigger>
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="Pendiente">Pendiente</SelectItem>
                    <SelectItem value="En Proceso">En Proceso</SelectItem>
                    <SelectItem value="Completado">Completado</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>

            <div>
              <Label>Materiales Necesarios</Label>
              <Textarea
                value={workOrder.materials}
                onChange={(e) => setWorkOrder(prev => ({...prev, materials: e.target.value}))}
                placeholder="Lista de materiales y repuestos necesarios"
                rows={3}
              />
            </div>

            <div>
              <Label>Instrucciones de Trabajo</Label>
              <Textarea
                value={workOrder.instructions}
                onChange={(e) => setWorkOrder(prev => ({...prev, instructions: e.target.value}))}
                placeholder="Instrucciones detalladas para el técnico"
                rows={4}
              />
            </div>

            <div className="flex justify-end space-x-2 pt-4">
              <Button type="button" variant="outline" onClick={onClose}>
                Cancelar
              </Button>
              <Button type="submit">
                <FileText className="w-4 h-4 mr-2" />
                Generar Orden
              </Button>
            </div>
          </form>
        </div>
      </DialogContent>
    </Dialog>
  );
}