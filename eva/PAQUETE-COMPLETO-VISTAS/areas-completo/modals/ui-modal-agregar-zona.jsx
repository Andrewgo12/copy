"use client"

import { useState } from "react"
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select"
import { Textarea } from "@/components/ui/textarea"

export default function UIModalAgregarZona({ isOpen, onClose }) {
  const [formData, setFormData] = useState({
    nombre: "",
    codigo: "",
    sede: "",
    piso: "",
    jefeZona: "",
    telefono: "",
    email: "",
    descripcion: "",
    estado: "ACTIVA"
  })

  const handleSubmit = (e) => {
    e.preventDefault()
    // Aquí iría la lógica para agregar la zona
    console.log("Agregando zona:", formData)
    onClose()
    // Resetear formulario
    setFormData({
      nombre: "",
      codigo: "",
      sede: "",
      piso: "",
      jefeZona: "",
      telefono: "",
      email: "",
      descripcion: "",
      estado: "ACTIVA"
    })
  }

  const handleInputChange = (field, value) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }))
  }

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[600px] max-w-[95vw] max-h-[90vh] overflow-y-auto mx-4">
        <DialogHeader>
          <DialogTitle className="text-lg font-semibold text-gray-800 border-b-2 border-green-500 pb-2">
            Agregar Zona
          </DialogTitle>
        </DialogHeader>

        <div className="mt-4">
          <form onSubmit={handleSubmit} className="space-y-4">
            {/* Información Básica */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {/* Nombre de la zona */}
              <div className="space-y-2">
                <Label htmlFor="nombre" className="text-sm font-medium text-gray-700">
                  Nombre de la zona *
                </Label>
                <Input
                  id="nombre"
                  type="text"
                  placeholder="Ej: ZONA MOLANO1"
                  value={formData.nombre}
                  onChange={(e) => handleInputChange("nombre", e.target.value)}
                  className="w-full"
                  required
                />
              </div>

              {/* Código */}
              <div className="space-y-2">
                <Label htmlFor="codigo" className="text-sm font-medium text-gray-700">
                  Código *
                </Label>
                <Input
                  id="codigo"
                  type="text"
                  placeholder="Ej: ZM01"
                  value={formData.codigo}
                  onChange={(e) => handleInputChange("codigo", e.target.value)}
                  className="w-full"
                  required
                />
              </div>
            </div>

            {/* Ubicación */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              {/* Sede */}
              <div className="space-y-2">
                <Label htmlFor="sede" className="text-sm font-medium text-gray-700">
                  Sede *
                </Label>
                <Select onValueChange={(value) => handleInputChange("sede", value)}>
                  <SelectTrigger className="w-full">
                    <SelectValue placeholder="Seleccionar sede" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="HUV EVARISTO GARCÍA - SEDE PRINCIPAL">HUV EVARISTO GARCÍA - SEDE PRINCIPAL</SelectItem>
                    <SelectItem value="HUV NORTE">HUV NORTE</SelectItem>
                    <SelectItem value="HUV CARTAGO">HUV CARTAGO</SelectItem>
                  </SelectContent>
                </Select>
              </div>

              {/* Piso */}
              <div className="space-y-2">
                <Label htmlFor="piso" className="text-sm font-medium text-gray-700">
                  Piso(s)
                </Label>
                <Input
                  id="piso"
                  type="text"
                  placeholder="Ej: PISO 1-3, SOTANO-PISO 1"
                  value={formData.piso}
                  onChange={(e) => handleInputChange("piso", e.target.value)}
                  className="w-full"
                />
              </div>
            </div>

            {/* Estado */}
            <div className="space-y-2">
              <Label htmlFor="estado" className="text-sm font-medium text-gray-700">
                Estado
              </Label>
              <Select value={formData.estado} onValueChange={(value) => handleInputChange("estado", value)}>
                <SelectTrigger className="w-full">
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="ACTIVA">ACTIVA</SelectItem>
                  <SelectItem value="INACTIVA">INACTIVA</SelectItem>
                  <SelectItem value="MANTENIMIENTO">MANTENIMIENTO</SelectItem>
                </SelectContent>
              </Select>
            </div>

            {/* Información del Jefe de Zona */}
            <div className="space-y-4">
              <h4 className="text-md font-semibold text-gray-800 border-b pb-2">Información del Jefe de Zona</h4>
              
              <div className="space-y-2">
                <Label htmlFor="jefeZona" className="text-sm font-medium text-gray-700">
                  Jefe de Zona *
                </Label>
                <Input
                  id="jefeZona"
                  type="text"
                  placeholder="Nombre completo del jefe de zona"
                  value={formData.jefeZona}
                  onChange={(e) => handleInputChange("jefeZona", e.target.value)}
                  className="w-full"
                  required
                />
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="telefono" className="text-sm font-medium text-gray-700">
                    Teléfono
                  </Label>
                  <Input
                    id="telefono"
                    type="tel"
                    placeholder="318 555 0000"
                    value={formData.telefono}
                    onChange={(e) => handleInputChange("telefono", e.target.value)}
                    className="w-full"
                  />
                </div>

                <div className="space-y-2">
                  <Label htmlFor="email" className="text-sm font-medium text-gray-700">
                    Email
                  </Label>
                  <Input
                    id="email"
                    type="email"
                    placeholder="correo@huv.gov.co"
                    value={formData.email}
                    onChange={(e) => handleInputChange("email", e.target.value)}
                    className="w-full"
                  />
                </div>
              </div>
            </div>

            {/* Descripción */}
            <div className="space-y-2">
              <Label htmlFor="descripcion" className="text-sm font-medium text-gray-700">
                Descripción
              </Label>
              <Textarea
                id="descripcion"
                placeholder="Descripción de la zona y sus funciones..."
                value={formData.descripcion}
                onChange={(e) => handleInputChange("descripcion", e.target.value)}
                className="w-full min-h-[80px]"
                rows={3}
              />
            </div>

            {/* Botones */}
            <div className="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
              <Button type="submit" className="bg-green-500 hover:bg-green-600 text-white px-6 w-full sm:w-auto">
                Insertar
              </Button>

              <Button type="button" variant="outline" onClick={onClose} className="px-6 w-full sm:w-auto">
                Cancelar
              </Button>
            </div>
          </form>
        </div>
      </DialogContent>
    </Dialog>
  )
}