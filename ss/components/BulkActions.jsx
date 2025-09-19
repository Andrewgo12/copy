"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Checkbox } from "@/components/ui/checkbox";
import { Trash2, Edit, Download, CheckSquare } from "lucide-react";

export default function BulkActions({ 
  selectedItems, 
  onSelectAll, 
  onDeselectAll, 
  onBulkDelete, 
  onBulkStatusChange, 
  onBulkExport,
  totalItems 
}) {
  const [bulkStatus, setBulkStatus] = useState("");

  const handleBulkStatusChange = () => {
    if (bulkStatus && selectedItems.length > 0) {
      onBulkStatusChange(selectedItems, bulkStatus);
      setBulkStatus("");
    }
  };

  const handleBulkDelete = () => {
    if (selectedItems.length > 0 && window.confirm(`¿Eliminar ${selectedItems.length} tickets seleccionados?`)) {
      onBulkDelete(selectedItems);
    }
  };

  const handleBulkExport = () => {
    if (selectedItems.length > 0) {
      onBulkExport(selectedItems);
    }
  };

  return (
    <div className="flex items-center justify-between p-4 bg-gray-50 border rounded-lg mb-4">
      <div className="flex items-center space-x-4">
        <div className="flex items-center space-x-2">
          <Checkbox
            checked={selectedItems.length === totalItems && totalItems > 0}
            onCheckedChange={(checked) => checked ? onSelectAll() : onDeselectAll()}
          />
          <span className="text-sm text-gray-600">
            {selectedItems.length > 0 
              ? `${selectedItems.length} seleccionados` 
              : "Seleccionar todo"
            }
          </span>
        </div>
        
        {selectedItems.length > 0 && (
          <div className="flex items-center space-x-2">
            <Select value={bulkStatus} onValueChange={setBulkStatus}>
              <SelectTrigger className="w-40">
                <SelectValue placeholder="Cambiar estado" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="Abierto">Abierto</SelectItem>
                <SelectItem value="En Proceso">En Proceso</SelectItem>
                <SelectItem value="Cerrado">Cerrado</SelectItem>
              </SelectContent>
            </Select>
            
            <Button size="sm" onClick={handleBulkStatusChange} disabled={!bulkStatus}>
              <CheckSquare className="w-4 h-4 mr-1" />
              Aplicar
            </Button>
          </div>
        )}
      </div>
      
      {selectedItems.length > 0 && (
        <div className="flex items-center space-x-2">
          <Button size="sm" variant="outline" onClick={handleBulkExport}>
            <Download className="w-4 h-4 mr-1" />
            Exportar
          </Button>
          
          <Button size="sm" variant="outline" onClick={handleBulkDelete} className="text-red-600 hover:text-red-700">
            <Trash2 className="w-4 h-4 mr-1" />
            Eliminar
          </Button>
        </div>
      )}
    </div>
  );
}