"use client";

import { useState, useEffect } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Input } from "../../ui/input";
import { Label } from "../../ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "../../ui/select";
import { Textarea } from "../../ui/textarea";
import { Edit } from "lucide-react";

export default function UIModalEditarRepuesto({ isOpen, onClose, repuesto }) {
  const [formData, setFormData] = useState({
    codigo: "",
    nombre: "",
    categoria: "",
    marca: "",
    modelo: "",
    stock: "",
    stockMinimo: "",
    precio: "",
    proveedor: "",
    ubicacion: "",
    descripcion: "",
    estado: "DISPONIBLE"
  });

  useEffect(() => {
    if (repuesto && isOpen) {
      setFormData({
        codigo: repuesto.codigo || "",
        nombre: repuesto.nombre || "",
        categoria: repuesto.categoria || "",
        marca: repuesto.marca || "",
        modelo: repuesto.modelo || "",
        stock: repuesto.stock?.toString() || "",
        stockMinimo: repuesto.stockMinimo?.toString() || "",
        precio: repuesto.precio?.toString() || "",
        proveedor: repuesto.proveedor || "",
        ubicacion: repuesto.ubicacion || "",
        descripcion: repuesto.descripcion || "",
        estado: repuesto.estado || "DISPONIBLE"
      });
    }
  }, [repuesto, isOpen]);

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Actualizando repuesto:", formData);
    onClose();
  };

  const handleInputChange = (field, value) => {
    setFormData(prev => ({ ...prev, [field]: value }));
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[600px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Edit className="w-5 h-5 text-blue-600" />
            Editar Repuesto
          </DialogTitle>
          <DialogDescription>
            Modifique la información del repuesto seleccionado.
          </DialogDescription>
        </DialogHeader>

        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="codigo">Código *</Label>
              <Input
                id="codigo"
                value={formData.codigo}
                onChange={(e) => handleInputChange("codigo", e.target.value)}
                required
                disabled
              />
            </div>
            <div>
              <Label htmlFor="categoria">Categoría *</Label>
              <Select value={formData.categoria} onValueChange={(value) => handleInputChange("categoria", value)}>
                <SelectTrigger>
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="FILTROS">FILTROS</SelectItem>
                  <SelectItem value="BOMBAS">BOMBAS</SelectItem>
                  <SelectItem value="SENSORES">SENSORES</SelectItem>
                  <SelectItem value="VALVULAS">VÁLVULAS</SelectItem>
                  <SelectItem value="MOTORES">MOTORES</SelectItem>
                  <SelectItem value="ELECTRONICA">ELECTRÓNICA</SelectItem>
                  <SelectItem value="TRANSMISION">TRANSMISIÓN</SelectItem>
                  <SelectItem value="PROTECCION">PROTECCIÓN</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>

          <div>
            <Label htmlFor="nombre">Nombre del Repuesto *</Label>
            <Input
              id="nombre"
              value={formData.nombre}
              onChange={(e) => handleInputChange("nombre", e.target.value)}
              required
            />
          </div>

          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="marca">Marca</Label>
              <Input
                id="marca"
                value={formData.marca}
                onChange={(e) => handleInputChange("marca", e.target.value)}
              />
            </div>
            <div>
              <Label htmlFor="modelo">Modelo</Label>
              <Input
                id="modelo"
                value={formData.modelo}
                onChange={(e) => handleInputChange("modelo", e.target.value)}
              />
            </div>
          </div>

          <div className="grid grid-cols-3 gap-4">
            <div>
              <Label htmlFor="stock">Stock Actual *</Label>
              <Input
                id="stock"
                type="number"
                value={formData.stock}
                onChange={(e) => handleInputChange("stock", e.target.value)}
                required
              />
            </div>
            <div>
              <Label htmlFor="stockMinimo">Stock Mínimo *</Label>
              <Input
                id="stockMinimo"
                type="number"
                value={formData.stockMinimo}
                onChange={(e) => handleInputChange("stockMinimo", e.target.value)}
                required
              />
            </div>
            <div>
              <Label htmlFor="precio">Precio Unitario *</Label>
              <Input
                id="precio"
                type="number"
                value={formData.precio}
                onChange={(e) => handleInputChange("precio", e.target.value)}
                required
              />
            </div>
          </div>

          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="proveedor">Proveedor</Label>
              <Select value={formData.proveedor} onValueChange={(value) => handleInputChange("proveedor", value)}>
                <SelectTrigger>
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="EQUIPOS TECTUM">EQUIPOS TECTUM</SelectItem>
                  <SelectItem value="J.M MEDICOS EQUIPOS S.A.S">J.M MEDICOS EQUIPOS S.A.S</SelectItem>
                  <SelectItem value="MEDICAS MEDICAL COLOMBIA SAS">MEDICAS MEDICAL COLOMBIA SAS</SelectItem>
                  <SelectItem value="ABS EQUIPOS MEDICOS S.A.S">ABS EQUIPOS MEDICOS S.A.S</SelectItem>
                  <SelectItem value="SIEMENS HEALTHINEERS">SIEMENS HEALTHINEERS</SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div>
              <Label htmlFor="ubicacion">Ubicación en Almacén</Label>
              <Input
                id="ubicacion"
                value={formData.ubicacion}
                onChange={(e) => handleInputChange("ubicacion", e.target.value)}
              />
            </div>
          </div>

          <div>
            <Label htmlFor="estado">Estado</Label>
            <Select value={formData.estado} onValueChange={(value) => handleInputChange("estado", value)}>
              <SelectTrigger>
                <SelectValue />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="DISPONIBLE">DISPONIBLE</SelectItem>
                <SelectItem value="STOCK_BAJO">STOCK BAJO</SelectItem>
                <SelectItem value="AGOTADO">AGOTADO</SelectItem>
              </SelectContent>
            </Select>
          </div>

          <div>
            <Label htmlFor="descripcion">Descripción</Label>
            <Textarea
              id="descripcion"
              value={formData.descripcion}
              onChange={(e) => handleInputChange("descripcion", e.target.value)}
              rows={3}
            />
          </div>

          <div className="flex justify-end space-x-3 pt-4">
            <Button type="button" variant="outline" onClick={onClose}>
              Cancelar
            </Button>
            <Button type="submit" className="bg-blue-500 hover:bg-blue-600">
              Actualizar Repuesto
            </Button>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  );
}