"use client";

import { useState } from "react";
import { FolderOpen, UserPlus, Upload, Paperclip } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import { PdfModal } from "@/components/modals/pdf-modal";
import { ClosedThirdPartyModal, ClosedFileUploadModal, ClosedAttachmentModal } from "@/components/ClosedTicketsModals";

const documents = [
  {
    id: 1,
    codigo: "LAB001",
    reporte:
      "LABORATORIO CLINICO - Hemograma completo, glucosa, creatinina, urea, ácido úrico, colesterol total, triglicéridos, HDL, LDL",
    cierre: "26-01-2024 08:30:15",
    tiempoCierre: "26-07-2024",
    estado: "VIGENTE",
    fuente: "Sistema externo: www.lab.com.co",
    observaciones: "Paciente en ayunas",
    responsable: "Dr. García López",
  },
  {
    id: 2,
    codigo: "RAD002",
    reporte:
      "RADIOLOGIA - Radiografía de tórax PA y lateral, evaluación de campos pulmonares y silueta cardiovascular",
    cierre: "25-01-2024 14:20:30",
    tiempoCierre: "25-07-2024",
    estado: "VIGENTE",
    fuente: "Sistema externo: www.radiologia.com.co",
    observaciones: "Control post-operatorio",
    responsable: "Dr. Martínez Ruiz",
  },
  {
    id: 3,
    codigo: "CONS003",
    reporte:
      "CONSULTA ESPECIALIZADA - Cardiología, evaluación de función ventricular, electrocardiograma, ecocardiograma",
    cierre: "24-01-2024 10:15:45",
    tiempoCierre: "24-12-2024",
    estado: "VIGENTE",
    fuente: "Sistema externo: www.cardio.com.co",
    observaciones: "Seguimiento rutinario",
    responsable: "Dr. López Herrera",
  },
  {
    id: 4,
    codigo: "PROC004",
    reporte:
      "PROCEDIMIENTO QUIRURGICO - Cirugía laparoscópica, colecistectomía, preparación pre-operatoria completa",
    cierre: "23-01-2024 16:45:20",
    tiempoCierre: "23-03-2024",
    estado: "PENDIENTE",
    fuente: "Sistema externo: www.cirugia.com.co",
    observaciones: "Programado para febrero",
    responsable: "Dr. Rodríguez Silva",
  },
  {
    id: 5,
    codigo: "FARM005",
    reporte:
      "FARMACIA - Dispensación de medicamentos, antihipertensivos, hipoglucemiantes, anticoagulantes orales",
    cierre: "22-01-2024 09:30:10",
    tiempoCierre: "22-04-2024",
    estado: "VIGENTE",
    fuente: "Sistema externo: www.farmacia.com.co",
    observaciones: "Medicación crónica",
    responsable: "Dr. Fernández Castro",
  },
];

const searchOptions = [
  { value: "todos", label: "Todos los documentos" },
  { value: "laboratorio", label: "Laboratorio Clínico" },
  { value: "radiologia", label: "Radiología" },
  { value: "consulta", label: "Consulta Especializada" },
  { value: "procedimiento", label: "Procedimiento Quirúrgico" },
  { value: "farmacia", label: "Farmacia" },
  { value: "vigente", label: "Estado: Vigente" },
  { value: "pendiente", label: "Estado: Pendiente" },
];

export default function ClosedTickets() {
  const [selectedDocument, setSelectedDocument] = useState(null);
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [searchValue, setSearchValue] = useState("todos");
  const [dateFilter, setDateFilter] = useState("");
  const [statusFilter, setStatusFilter] = useState("todos");
  const [showAdvancedFilters, setShowAdvancedFilters] = useState(false);
  const [responsableFilter, setResponsableFilter] = useState("");
  const [notifications, setNotifications] = useState([]);
  const [isThirdPartyModalOpen, setIsThirdPartyModalOpen] = useState(false);
  const [isFileUploadModalOpen, setIsFileUploadModalOpen] = useState(false);
  const [isAttachmentModalOpen, setIsAttachmentModalOpen] = useState(false);

  const handleDocumentClick = (document) => {
    setSelectedDocument(document);
    setIsModalOpen(true);
  };

  const filteredDocuments = documents.filter((doc) => {
    let matches = true;
    
    // Filtro por tipo/búsqueda
    if (searchValue !== "todos") {
      const searchLower = searchValue.toLowerCase();
      matches = matches && (
        doc.codigo.toLowerCase().includes(searchLower) ||
        doc.reporte.toLowerCase().includes(searchLower) ||
        doc.estado.toLowerCase().includes(searchLower) ||
        (searchValue === "vigente" && doc.estado === "VIGENTE") ||
        (searchValue === "pendiente" && doc.estado === "PENDIENTE") ||
        (searchValue === "laboratorio" && doc.reporte.toLowerCase().includes("laboratorio")) ||
        (searchValue === "radiologia" && doc.reporte.toLowerCase().includes("radiologia")) ||
        (searchValue === "consulta" && doc.reporte.toLowerCase().includes("consulta")) ||
        (searchValue === "procedimiento" && doc.reporte.toLowerCase().includes("procedimiento")) ||
        (searchValue === "farmacia" && doc.reporte.toLowerCase().includes("farmacia"))
      );
    }
    
    // Filtro por fecha
    if (dateFilter) {
      matches = matches && doc.cierre.includes(dateFilter);
    }
    
    // Filtro por estado
    if (statusFilter !== "todos") {
      matches = matches && doc.estado.toLowerCase() === statusFilter.toLowerCase();
    }
    
    // Filtro por responsable
    if (responsableFilter) {
      matches = matches && doc.responsable.toLowerCase().includes(responsableFilter.toLowerCase());
    }
    
    return matches;
  });

  const exportToCSV = () => {
    const csvContent = "data:text/csv;charset=utf-8," + 
      "CÓDIGO,REPORTE,CIERRE,TIEMPO DE CIERRE,ESTADO,RESPONSABLE\n" +
      filteredDocuments.map(doc => 
        `${doc.codigo},"${doc.reporte}",${doc.cierre},${doc.tiempoCierre},${doc.estado},${doc.responsable}`
      ).join("\n");
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `documentos_cerrados_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Agregar notificación
    setNotifications(prev => [...prev, {
      id: Date.now(),
      message: `Archivo CSV exportado con ${filteredDocuments.length} documentos`,
      type: 'success'
    }]);
    
    // Remover notificación después de 3 segundos
    setTimeout(() => {
      setNotifications(prev => prev.slice(1));
    }, 3000);
  };

  const exportToPDF = () => {
    window.print();
    setNotifications(prev => [...prev, {
      id: Date.now(),
      message: 'Documento preparado para impresión/PDF',
      type: 'info'
    }]);
    setTimeout(() => {
      setNotifications(prev => prev.slice(1));
    }, 3000);
  };

  const handleSearch = () => {
    console.log("Filtrando por:", searchValue);
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white border-b border-gray-200 px-4 sm:px-6 py-4">
        <div>
          <h2 className="text-xl sm:text-2xl font-bold text-gray-900">
            Closedoc
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 mt-1">
            Gestión de documentos médicos
          </p>
        </div>
      </header>

      {/* Search Section */}
      <div className="bg-white border-b border-gray-200 px-4 sm:px-6 py-4">
        <div className="mb-4">
          <h3 className="text-base sm:text-lg font-semibold text-gray-900 mb-2">
            Buscar
          </h3>
          <p className="text-xs sm:text-sm text-gray-600 mb-4">
            Documentos registrados del 1 al 31 de enero del 2024 registrados.
          </p>
          <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Tipo de Documento
              </label>
              <Select value={searchValue} onValueChange={setSearchValue}>
                <SelectTrigger className="bg-gray-50 border-gray-300">
                  <SelectValue placeholder="Seleccione una opción" />
                </SelectTrigger>
                <SelectContent>
                  {searchOptions.map((option) => (
                    <SelectItem key={option.value} value={option.value}>
                      {option.label}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Fecha
              </label>
              <Input
                type="date"
                value={dateFilter}
                onChange={(e) => setDateFilter(e.target.value)}
                className="bg-gray-50 border-gray-300"
              />
            </div>
            
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-1">
                Estado
              </label>
              <Select value={statusFilter} onValueChange={setStatusFilter}>
                <SelectTrigger className="bg-gray-50 border-gray-300">
                  <SelectValue placeholder="Todos los estados" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="todos">Todos los estados</SelectItem>
                  <SelectItem value="vigente">Vigente</SelectItem>
                  <SelectItem value="pendiente">Pendiente</SelectItem>
                </SelectContent>
              </Select>
            </div>
            
            <div className="flex items-end gap-2">
              <Button
                onClick={handleSearch}
                className="bg-blue-600 hover:bg-blue-700 text-white flex-1"
              >
                Buscar
              </Button>
              <Button
                onClick={exportToCSV}
                variant="outline"
                className="px-3"
                title="Exportar a CSV"
              >
                CSV
              </Button>
              <Button
                onClick={() => window.print()}
                variant="outline"
                className="px-3"
                title="Imprimir/PDF"
              >
                PDF
              </Button>
            </div>
          </div>
          
          {/* Botones de Acción Específicos de Documentos Cerrados */}
          <div className="flex flex-wrap gap-2 mt-4">
            <Button
              variant="outline"
              onClick={() => setIsThirdPartyModalOpen(true)}
              className="py-2 px-4"
            >
              <UserPlus className="w-4 h-4 mr-2" />
              Registrar Auditor
            </Button>
            <Button
              variant="outline"
              onClick={() => setIsFileUploadModalOpen(true)}
              className="py-2 px-4"
            >
              <Upload className="w-4 h-4 mr-2" />
              Archivar Documentos
            </Button>
            <Button
              variant="outline"
              onClick={() => setIsAttachmentModalOpen(true)}
              className="py-2 px-4"
            >
              <Paperclip className="w-4 h-4 mr-2" />
              Archivo Documental
            </Button>
          </div>
          
          {showAdvancedFilters && (
            <div className="mt-4 p-4 bg-gray-50 rounded-lg">
              <h4 className="font-medium text-gray-900 mb-3">Filtros Avanzados</h4>
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                  <Label>Responsable</Label>
                  <Input
                    placeholder="Filtrar por responsable"
                    value={responsableFilter}
                    onChange={(e) => setResponsableFilter(e.target.value)}
                  />
                </div>
                <div>
                  <Label>Rango de Fechas</Label>
                  <div className="flex gap-2">
                    <Input type="date" className="text-xs" />
                    <Input type="date" className="text-xs" />
                  </div>
                </div>
                <div>
                  <Label>Acciones Rápidas</Label>
                  <div className="flex gap-2">
                    <Button size="sm" variant="outline" onClick={() => {
                      setSearchValue("vigente");
                      setStatusFilter("vigente");
                    }}>Solo Vigentes</Button>
                    <Button size="sm" variant="outline" onClick={() => {
                      setSearchValue("todos");
                      setStatusFilter("todos");
                      setResponsableFilter("");
                      setDateFilter("");
                    }}>Limpiar</Button>
                  </div>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>

      {/* Sistema de Notificaciones */}
      {notifications.length > 0 && (
        <div className="fixed top-4 right-4 z-50 space-y-2">
          {notifications.map((notification) => (
            <div
              key={notification.id}
              className={`p-3 rounded-lg shadow-lg ${
                notification.type === 'success' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'
              }`}
            >
              {notification.message}
            </div>
          ))}
        </div>
      )}

      {/* Document List */}
      <div className="p-4 sm:p-6">
        <div className="bg-white rounded-lg border border-gray-200 overflow-hidden">
          <div className="bg-slate-600 text-white px-4 sm:px-6 py-3">
            <h4 className="font-semibold text-sm sm:text-base">Documentos</h4>
          </div>

          {/* Desktop Table */}
          <div className="hidden lg:block overflow-x-auto">
            <table className="w-full">
              <thead className="bg-slate-500 text-white">
                <tr>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    CÓDIGO
                  </th>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    REPORTE
                  </th>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    CIERRE
                  </th>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    TIEMPO DE CIERRE
                  </th>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    ESTADO
                  </th>
                  <th className="px-4 py-3 text-left text-sm font-medium">
                    ACCIONES
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {filteredDocuments.map((doc, index) => (
                  <tr
                    key={doc.id}
                    className={`hover:bg-gray-50 transition-colors ${
                      index % 2 === 0 ? "bg-white" : "bg-gray-50"
                    }`}
                  >
                    <td className="px-4 py-4 text-sm">
                      <div className="font-medium text-gray-900">
                        {doc.codigo}
                      </div>
                      <div className="text-xs text-gray-500">ID: {doc.id}</div>
                    </td>
                    <td className="px-4 py-4 text-sm">
                      <div className="text-gray-900 max-w-md">
                        <div className="font-medium mb-1">{doc.reporte}</div>
                        <div className="text-xs text-gray-500 mb-1">
                          <strong>Fuente externa:</strong> {doc.fuente}
                        </div>
                        <div className="text-xs text-gray-500 mb-1">
                          <strong>Observaciones:</strong> {doc.observaciones}
                        </div>
                        <div className="text-xs text-gray-500">
                          <strong>Responsable:</strong> {doc.responsable}
                        </div>
                      </div>
                    </td>
                    <td className="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                      {doc.cierre}
                    </td>
                    <td className="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                      {doc.tiempoCierre}
                    </td>
                    <td className="px-4 py-4 text-sm whitespace-nowrap">
                      <span
                        className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                          doc.estado === "VIGENTE"
                            ? "bg-green-100 text-green-800"
                            : "bg-orange-100 text-orange-800"
                        }`}
                      >
                        {doc.estado}
                      </span>
                    </td>
                    <td className="px-4 py-4 text-sm whitespace-nowrap">
                      <Button
                        onClick={() => handleDocumentClick(doc)}
                        className="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105"
                        size="sm"
                        title="Ver documento de trabajo"
                      >
                        <FolderOpen className="h-4 w-4" />
                      </Button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

          {/* Mobile/Tablet Cards */}
          <div className="lg:hidden">
            {filteredDocuments.map((doc, index) => (
              <div
                key={doc.id}
                className={`p-4 border-b border-gray-200 last:border-b-0 ${
                  index % 2 === 0 ? "bg-white" : "bg-gray-50"
                }`}
              >
                <div className="flex items-start justify-between mb-3">
                  <div>
                    <div className="font-medium text-gray-900 text-sm">
                      {doc.codigo}
                    </div>
                    <div className="text-xs text-gray-500">ID: {doc.id}</div>
                  </div>
                  <div className="flex items-center gap-2">
                    <span
                      className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                        doc.estado === "VIGENTE"
                          ? "bg-green-100 text-green-800"
                          : "bg-orange-100 text-orange-800"
                      }`}
                    >
                      {doc.estado}
                    </span>
                    <button
                      onClick={() => handleDocumentClick(doc)}
                      className="p-2 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors"
                      title="Ver documento"
                    >
                      <FolderOpen className="h-4 w-4 text-blue-600" />
                    </button>
                  </div>
                </div>

                <div className="mb-3">
                  <div className="font-medium text-gray-900 text-sm mb-1">
                    {doc.reporte}
                  </div>
                  <div className="text-xs text-gray-500 space-y-1">
                    <div>
                      <strong>Fuente externa:</strong> {doc.fuente}
                    </div>
                    <div>
                      <strong>Observaciones:</strong> {doc.observaciones}
                    </div>
                    <div>
                      <strong>Responsable:</strong> {doc.responsable}
                    </div>
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-4 text-xs">
                  <div>
                    <div className="font-medium text-gray-700">Cierre</div>
                    <div className="text-gray-900">{doc.cierre}</div>
                  </div>
                  <div>
                    <div className="font-medium text-gray-700">
                      Tiempo de Cierre
                    </div>
                    <div className="text-gray-900">{doc.tiempoCierre}</div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Footer Info */}
        <div className="mt-6 text-xs sm:text-sm text-gray-600">
          <p>
            Documentos registrados del 1 al 31 de enero del 2024 registrados.
          </p>
          <p className="mt-2">
            <strong>Registros:</strong> {filteredDocuments.length} |
            <strong className="ml-2">Vigentes:</strong> {filteredDocuments.filter(d => d.estado === 'VIGENTE').length} |
            <strong className="ml-2">Pendientes:</strong> {filteredDocuments.filter(d => d.estado === 'PENDIENTE').length}
          </p>
          <div className="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <p className="text-xs">
              Copyright © Grupo EVA Soluciones en Tecnología. Todos los derechos
              reservados.
            </p>
            <div className="flex gap-2">
              <Button
                variant="outline"
                size="sm"
                className="bg-white text-gray-700 border-gray-300"
              >
                Anterior
              </Button>
              <Button
                variant="outline"
                size="sm"
                className="bg-white text-gray-700 border-gray-300"
              >
                Siguiente
              </Button>
            </div>
          </div>
        </div>
      </div>

      {/* PDF Modal */}
      {selectedDocument && (
        <PdfModal
          isOpen={isModalOpen}
          onClose={() => setIsModalOpen(false)}
          documentTitle={`${selectedDocument.codigo} - ${selectedDocument.reporte}`}
          documentDate={selectedDocument.cierre}
        />
      )}

      {/* Modales Específicos de Documentos Cerrados */}
      <ClosedThirdPartyModal
        isOpen={isThirdPartyModalOpen}
        onClose={() => setIsThirdPartyModalOpen(false)}
        onSubmit={(data) => {
          console.log('Registrando auditor:', data);
          setNotifications(prev => [...prev, {
            id: Date.now(),
            message: `Auditor ${data.name} registrado exitosamente`,
            type: 'success'
          }]);
          setTimeout(() => setNotifications(prev => prev.slice(1)), 3000);
          setIsThirdPartyModalOpen(false);
        }}
      />

      <ClosedFileUploadModal
        isOpen={isFileUploadModalOpen}
        onClose={() => setIsFileUploadModalOpen(false)}
        onUpload={(files) => {
          console.log('Archivando documentos finales:', files);
          setNotifications(prev => [...prev, {
            id: Date.now(),
            message: `${files.length} documento(s) archivado(s) exitosamente`,
            type: 'success'
          }]);
          setTimeout(() => setNotifications(prev => prev.slice(1)), 3000);
          setIsFileUploadModalOpen(false);
        }}
      />

      <ClosedAttachmentModal
        isOpen={isAttachmentModalOpen}
        onClose={() => setIsAttachmentModalOpen(false)}
      />
    </div>
  );
}
