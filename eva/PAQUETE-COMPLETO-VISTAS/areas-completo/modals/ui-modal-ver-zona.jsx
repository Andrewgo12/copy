"use client";

import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { Eye, X, MapPin, Building, Users, Settings, Phone, Mail, User } from "lucide-react";

export default function UIModalVerZona({ isOpen, onClose, zona }) {
  if (!zona) return null;

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "ACTIVA":
        return "bg-green-100 text-green-800";
      case "INACTIVA":
        return "bg-red-100 text-red-800";
      case "MANTENIMIENTO":
        return "bg-yellow-100 text-yellow-800";
      default:
        return "bg-gray-100 text-gray-800";
    }
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl w-[95vw] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Eye className="w-5 h-5 text-green-600" />
            Detalles de la Zona
          </DialogTitle>
          <Button
            variant="ghost"
            size="sm"
            className="absolute right-4 top-4"
            onClick={onClose}
          >
            <X className="w-4 h-4" />
          </Button>
        </DialogHeader>

        <div className="space-y-6 p-2">
          {/* Información Principal */}
          <div className="bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-lg border">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
              <div>
                <h3 className="text-xl font-semibold text-green-800 mb-1">{zona.nombre}</h3>
                <p className="text-sm text-green-600">Código: {zona.codigo}</p>
              </div>
              <Badge className={`${getEstadoColor(zona.estado)} text-sm px-3 py-1 w-fit`}>
                {zona.estado}
              </Badge>
            </div>
          </div>

          {/* Información de Ubicación */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <Building className="w-4 h-4 text-blue-600" />
                <span className="text-sm font-medium text-gray-700">Sede</span>
              </div>
              <p className="text-sm text-gray-800 break-words">
                {zona.sede}
              </p>
            </div>

            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-2">
                <MapPin className="w-4 h-4 text-purple-600" />
                <span className="text-sm font-medium text-gray-700">Piso(s)</span>
              </div>
              <Badge variant="outline" className="bg-purple-50 text-purple-700">
                {zona.piso}
              </Badge>
            </div>
          </div>

          {/* Información del Jefe de Zona */}
          <div className="bg-white border rounded-lg p-4">
            <div className="flex items-center gap-2 mb-4">
              <User className="w-4 h-4 text-gray-600" />
              <span className="text-lg font-medium text-gray-700">Jefe de Zona</span>
            </div>
            
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <div className="flex items-center gap-2 mb-2">
                  <Users className="w-4 h-4 text-blue-600" />
                  <span className="text-sm font-medium text-gray-600">Nombre</span>
                </div>
                <p className="text-sm text-gray-800 font-medium">
                  {zona.jefeZona}
                </p>
              </div>

              <div>
                <div className="flex items-center gap-2 mb-2">
                  <Phone className="w-4 h-4 text-green-600" />
                  <span className="text-sm font-medium text-gray-600">Teléfono</span>
                </div>
                <p className="text-sm text-gray-800">
                  {zona.telefono || 'No disponible'}
                </p>
              </div>

              <div>
                <div className="flex items-center gap-2 mb-2">
                  <Mail className="w-4 h-4 text-red-600" />
                  <span className="text-sm font-medium text-gray-600">Email</span>
                </div>
                <p className="text-sm text-gray-800 break-all">
                  {zona.email || 'No disponible'}
                </p>
              </div>
            </div>
          </div>

          {/* Estadísticas de la Zona */}
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-3">
                <Building className="w-4 h-4 text-teal-600" />
                <span className="text-sm font-medium text-gray-700">Áreas Asociadas</span>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-teal-600">
                  {zona.areasAsociadas}
                </div>
                <div className="text-xs text-gray-500">áreas en la zona</div>
              </div>
            </div>

            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-3">
                <Settings className="w-4 h-4 text-orange-600" />
                <span className="text-sm font-medium text-gray-700">Equipos Asociados</span>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-orange-600">
                  {zona.equiposAsociados}
                </div>
                <div className="text-xs text-gray-500">equipos en la zona</div>
              </div>
            </div>

            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-3">
                <MapPin className="w-4 h-4 text-indigo-600" />
                <span className="text-sm font-medium text-gray-700">ID de Zona</span>
              </div>
              <div className="text-center">
                <div className="text-2xl font-bold text-indigo-600">#{zona.id}</div>
                <div className="text-xs text-gray-500">identificador único</div>
              </div>
            </div>
          </div>

          {/* Descripción */}
          {zona.descripcion && (
            <div className="bg-white border rounded-lg p-4">
              <div className="flex items-center gap-2 mb-3">
                <Settings className="w-4 h-4 text-gray-600" />
                <span className="text-sm font-medium text-gray-700">Descripción</span>
              </div>
              <p className="text-sm text-gray-800 leading-relaxed">
                {zona.descripcion}
              </p>
            </div>
          )}

          {/* Resumen de Cobertura */}
          <div className="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
            <div className="flex items-center gap-2 mb-3">
              <MapPin className="w-4 h-4 text-blue-600" />
              <span className="text-sm font-medium text-blue-800">Resumen de Cobertura</span>
            </div>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
              <div className="text-center">
                <div className="font-semibold text-blue-700">{zona.areasAsociadas}</div>
                <div className="text-blue-600">Áreas</div>
              </div>
              <div className="text-center">
                <div className="font-semibold text-blue-700">{zona.equiposAsociados}</div>
                <div className="text-blue-600">Equipos</div>
              </div>
              <div className="text-center">
                <div className="font-semibold text-blue-700">1</div>
                <div className="text-blue-600">Jefe</div>
              </div>
              <div className="text-center">
                <div className="font-semibold text-blue-700">{zona.estado}</div>
                <div className="text-blue-600">Estado</div>
              </div>
            </div>
          </div>

          {/* Botón Cerrar */}
          <div className="flex justify-end pt-6 border-t">
            <Button onClick={onClose} className="bg-gray-600 hover:bg-gray-700 px-6">
              Cerrar
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}