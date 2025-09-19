"use client";

import { useState } from "react";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription } from "../../ui/dialog";
import { Button } from "../../ui/button";
import { Badge } from "../../ui/badge";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "../../ui/table";
import { Settings, Trash2, AlertTriangle } from "lucide-react";

export default function UIModalDepurarRepuesto({ isOpen, onClose }) {
  const [selectedItems, setSelectedItems] = useState([]);

  const repuestosObsoletos = [
    { id: 1, codigo: "REP005", nombre: "MOTOR PASO A PASO", stock: 0, ultimoUso: "2023-08-15", estado: "AGOTADO" },
    { id: 2, codigo: "REP012", nombre: "CABLE COAXIAL", stock: 1, ultimoUso: "2023-06-20", estado: "OBSOLETO" },
    { id: 3, codigo: "REP018", nombre: "RESISTENCIA 100K", stock: 3, ultimoUso: "2023-05-10", estado: "SIN_USO" },
    { id: 4, codigo: "REP025", nombre: "CONECTOR DB9", stock: 2, ultimoUso: "2023-04-05", estado: "OBSOLETO" }
  ];

  const handleSelectItem = (id) => {
    setSelectedItems(prev => 
      prev.includes(id) 
        ? prev.filter(item => item !== id)
        : [...prev, id]
    );
  };

  const handleDepurar = () => {
    console.log("Depurando repuestos:", selectedItems);
    onClose();
  };

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "AGOTADO": return "bg-red-100 text-red-800";
      case "OBSOLETO": return "bg-orange-100 text-orange-800";
      case "SIN_USO": return "bg-yellow-100 text-yellow-800";
      default: return "bg-gray-100 text-gray-800";
    }
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="sm:max-w-[700px] max-h-[90vh] overflow-y-auto">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-2">
            <Settings className="w-5 h-5 text-purple-600" />
            Depurar Inventario
          </DialogTitle>
          <DialogDescription>
            Identifique y elimine repuestos obsoletos, agotados o sin uso del inventario.
          </DialogDescription>
        </DialogHeader>

        <div className="space-y-4">
          <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div className="flex items-start space-x-2">
              <AlertTriangle className="w-5 h-5 text-yellow-600 mt-0.5" />
              <div>
                <h4 className="text-sm font-medium text-yellow-800">Criterios de Depuración</h4>
                <ul className="text-sm text-yellow-700 mt-1 list-disc list-inside">
                  <li>Repuestos agotados por más de 6 meses</li>
                  <li>Repuestos sin uso en los últimos 12 meses</li>
                  <li>Repuestos marcados como obsoletos</li>
                </ul>
              </div>
            </div>
          </div>

          <div className="border rounded-lg">
            <Table>
              <TableHeader className="bg-gray-50">
                <TableRow>
                  <TableHead className="w-12">
                    <input
                      type="checkbox"
                      onChange={(e) => {
                        if (e.target.checked) {
                          setSelectedItems(repuestosObsoletos.map(item => item.id));
                        } else {
                          setSelectedItems([]);
                        }
                      }}
                      checked={selectedItems.length === repuestosObsoletos.length}
                    />
                  </TableHead>
                  <TableHead>Código</TableHead>
                  <TableHead>Nombre</TableHead>
                  <TableHead className="text-center">Stock</TableHead>
                  <TableHead className="text-center">Último Uso</TableHead>
                  <TableHead className="text-center">Estado</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {repuestosObsoletos.map((item) => (
                  <TableRow key={item.id}>
                    <TableCell>
                      <input
                        type="checkbox"
                        checked={selectedItems.includes(item.id)}
                        onChange={() => handleSelectItem(item.id)}
                      />
                    </TableCell>
                    <TableCell className="font-mono text-sm">{item.codigo}</TableCell>
                    <TableCell>{item.nombre}</TableCell>
                    <TableCell className="text-center">{item.stock}</TableCell>
                    <TableCell className="text-center text-sm">{item.ultimoUso}</TableCell>
                    <TableCell className="text-center">
                      <Badge className={`${getEstadoColor(item.estado)} text-xs`}>
                        {item.estado}
                      </Badge>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </div>

          <div className="bg-red-50 border border-red-200 rounded-lg p-4">
            <div className="flex items-start space-x-2">
              <Trash2 className="w-5 h-5 text-red-600 mt-0.5" />
              <div>
                <h4 className="text-sm font-medium text-red-800">Acción de Depuración</h4>
                <p className="text-sm text-red-700 mt-1">
                  Los repuestos seleccionados serán marcados como "DEPURADO" y removidos del inventario activo.
                  Esta acción se puede revertir desde el historial.
                </p>
              </div>
            </div>
          </div>

          <div className="flex justify-between items-center pt-4">
            <div className="text-sm text-gray-600">
              {selectedItems.length} de {repuestosObsoletos.length} repuestos seleccionados
            </div>
            <div className="flex space-x-3">
              <Button type="button" variant="outline" onClick={onClose}>
                Cancelar
              </Button>
              <Button 
                onClick={handleDepurar}
                className="bg-purple-500 hover:bg-purple-600"
                disabled={selectedItems.length === 0}
              >
                Depurar Seleccionados
              </Button>
            </div>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}