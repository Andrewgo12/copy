"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Checkbox } from "@/components/ui/checkbox";
import { Download, FileText, Table } from "lucide-react";

export default function ExportModal({ isOpen, onClose, data, onExport }) {
  const [exportFormat, setExportFormat] = useState("csv");
  const [selectedFields, setSelectedFields] = useState({
    id: true,
    description: true,
    date: true,
    status: true,
    type: true,
    origin: false,
    time: false
  });
  const [dateRange, setDateRange] = useState("all");

  const handleFieldChange = (field, checked) => {
    setSelectedFields(prev => ({ ...prev, [field]: checked }));
  };

  const handleExport = () => {
    const exportData = {
      format: exportFormat,
      fields: selectedFields,
      dateRange,
      data: data
    };
    
    if (exportFormat === "csv") {
      exportToCSV(exportData);
    } else if (exportFormat === "pdf") {
      exportToPDF(exportData);
    } else if (exportFormat === "excel") {
      exportToExcel(exportData);
    }
    
    onExport(exportData);
    onClose();
  };

  const exportToCSV = (exportData) => {
    const fields = Object.keys(selectedFields).filter(key => selectedFields[key]);
    const headers = fields.join(",");
    const rows = data.map(item => 
      fields.map(field => `"${item[field] || ''}"`).join(",")
    ).join("\n");
    
    const csvContent = `data:text/csv;charset=utf-8,${headers}\n${rows}`;
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `tickets_export_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  };

  const exportToPDF = (exportData) => {
    window.print();
  };

  const exportToExcel = (exportData) => {
    // Simulación de exportación a Excel
    alert("Funcionalidad de Excel en desarrollo");
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-md">
        <DialogHeader>
          <DialogTitle className="flex items-center">
            <Download className="w-5 h-5 mr-2" />
            Exportar Datos
          </DialogTitle>
        </DialogHeader>
        
        <div className="space-y-4 p-4">
          <div>
            <Label>Formato de Exportación</Label>
            <Select value={exportFormat} onValueChange={setExportFormat}>
              <SelectTrigger>
                <SelectValue />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="csv">
                  <div className="flex items-center">
                    <Table className="w-4 h-4 mr-2" />
                    CSV
                  </div>
                </SelectItem>
                <SelectItem value="pdf">
                  <div className="flex items-center">
                    <FileText className="w-4 h-4 mr-2" />
                    PDF
                  </div>
                </SelectItem>
                <SelectItem value="excel">
                  <div className="flex items-center">
                    <Table className="w-4 h-4 mr-2" />
                    Excel
                  </div>
                </SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <div>
            <Label>Rango de Fechas</Label>
            <Select value={dateRange} onValueChange={setDateRange}>
              <SelectTrigger>
                <SelectValue />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="all">Todos los registros</SelectItem>
                <SelectItem value="today">Hoy</SelectItem>
                <SelectItem value="week">Esta semana</SelectItem>
                <SelectItem value="month">Este mes</SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <div>
            <Label>Campos a Exportar</Label>
            <div className="space-y-2 mt-2">
              {Object.entries(selectedFields).map(([field, checked]) => (
                <div key={field} className="flex items-center space-x-2">
                  <Checkbox
                    id={field}
                    checked={checked}
                    onCheckedChange={(checked) => handleFieldChange(field, checked)}
                  />
                  <Label htmlFor={field} className="text-sm capitalize">
                    {field === 'id' ? 'ID' : field.replace(/([A-Z])/g, ' $1').trim()}
                  </Label>
                </div>
              ))}
            </div>
          </div>
          
          <div className="flex justify-end space-x-2 pt-4">
            <Button variant="outline" onClick={onClose}>
              Cancelar
            </Button>
            <Button onClick={handleExport}>
              <Download className="w-4 h-4 mr-2" />
              Exportar
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}