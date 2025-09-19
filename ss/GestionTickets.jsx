"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";

import {
  Search,
  FolderOpen,
  ChevronLeft,
  ChevronRight,
  Calendar,
  User,
  Building,
  Edit,
  Trash2,
} from "lucide-react";

export default function GestionTickets() {
  const [searchTerm, setSearchTerm] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const [selectedTicket, setSelectedTicket] = useState(null);
  const [isDocumentModalOpen, setIsDocumentModalOpen] = useState(false);
  const [selectedOrigin, setSelectedOrigin] = useState("todos");
  const [selectedStatus, setSelectedStatus] = useState("todos");
  const [isEditTicketModalOpen, setIsEditTicketModalOpen] = useState(false);
  const [editingTicket, setEditingTicket] = useState(null);

  const ticketsData = [
    {
      id: "2024-001",
      equipment: "DESFIBRILADOR CON MARCAPASOS",
      brand: "ZOLL",
      model: "R SERIES",
      serial: "1234567890",
      location: "URGENCIAS",
      issue: "EQUIPO PRESENTA FALLA EN PANTALLA",
      priority: "ALTA",
      status: "PENDIENTE",
      date: "2024-01-15",
      technician: "Juan Sebastian",
      company: "HUV MANTENIMIENTO BIOMEDICO",
      estimatedTime: "2 HORAS",
      actualState: "EN REVISION",
      equipment2: "DESFIBRILADOR",
    },
    {
      id: "2024-002",
      equipment: "VENTILADOR DE TRANSPORTE VITALES",
      brand: "DRAGER",
      model: "OXYLOG 3000 PLUS",
      serial: "0987654321",
      location: "UCI",
      issue: "RESPONSABILIDAD DEL MANTENIMIENTO",
      priority: "MEDIA",
      status: "EN PROCESO",
      date: "2024-01-14",
      technician: "Aura María",
      company: "HUV MANTENIMIENTO BIOMEDICO",
      estimatedTime: "4 HORAS",
      actualState: "DIAGNOSTICO BIOMEDICO",
      equipment2: "VENTILADOR",
    },
    {
      id: "2024-003",
      equipment: "MONITOR DE SIGNOS VITALES",
      brand: "PHILIPS",
      model: "INTELLIVUE MP70",
      serial: "5555666677",
      location: "CIRUGIA",
      issue: "RESPONSABILIDAD DEL MANTENIMIENTO",
      priority: "BAJA",
      status: "COMPLETADO",
      date: "2024-01-13",
      technician: "Angelica Maria",
      company: "HUV MANTENIMIENTO BIOMEDICO",
      estimatedTime: "1 HORA",
      actualState: "DIAGNOSTICO BIOMEDICO",
      equipment2: "MONITOR",
    },
    {
      id: "2024-004",
      equipment: "BOMBA DE INFUSION",
      brand: "BAXTER",
      model: "COLLEAGUE 3 CXE",
      serial: "9999888877",
      location: "PEDIATRIA",
      issue: "RESPONSABILIDAD DEL MANTENIMIENTO",
      priority: "ALTA",
      status: "PENDIENTE",
      date: "2024-01-12",
      technician: "Natalia Pedrerosa",
      company: "HUV MANTENIMIENTO BIOMEDICO",
      estimatedTime: "3 HORAS",
      actualState: "DIAGNOSTICO BIOMEDICO",
      equipment2: "BOMBA",
    },
    {
      id: "2024-005",
      equipment: "ELECTROCARDIÓGRAFO",
      brand: "SCHILLER",
      model: "AT-10 PLUS",
      serial: "1111222233",
      location: "CONSULTA EXTERNA",
      issue: "RESPONSABILIDAD DEL MANTENIMIENTO",
      priority: "MEDIA",
      status: "EN PROCESO",
      date: "2024-01-11",
      technician: "Dayana Raigosa",
      company: "HUV MANTENIMIENTO BIOMEDICO",
      estimatedTime: "2 HORAS",
      actualState: "DIAGNOSTICO BIOMEDICO",
      equipment2: "ELECTROCARDIOGRAFO",
    },
  ];

  const getStatusColor = (status) => {
    switch (status.toLowerCase()) {
      case "completado":
        return "bg-green-100 text-green-800 border-green-200";
      case "en proceso":
        return "bg-blue-100 text-blue-800 border-blue-200";
      case "pendiente":
        return "bg-orange-100 text-orange-800 border-orange-200";
      default:
        return "bg-gray-100 text-gray-800 border-gray-200";
    }
  };

  const getPriorityColor = (priority) => {
    switch (priority.toLowerCase()) {
      case "alta":
        return "bg-red-100 text-red-800 border-red-200";
      case "media":
        return "bg-yellow-100 text-yellow-800 border-yellow-200";
      case "baja":
        return "bg-green-100 text-green-800 border-green-200";
      default:
        return "bg-gray-100 text-gray-800 border-gray-200";
    }
  };

  const filteredTickets = ticketsData.filter((ticket) => {
    const matchesSearch = 
      ticket.equipment.toLowerCase().includes(searchTerm.toLowerCase()) ||
      ticket.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
      ticket.technician.toLowerCase().includes(searchTerm.toLowerCase());
    
    const matchesOrigin = selectedOrigin === "todos" || 
      ticket.company.toLowerCase().includes(selectedOrigin.toLowerCase());
    
    const matchesStatus = selectedStatus === "todos" || 
      ticket.status.toLowerCase() === selectedStatus.toLowerCase();
    
    return matchesSearch && matchesOrigin && matchesStatus;
  });

  const itemsPerPage = 10;
  const totalPages = Math.ceil(filteredTickets.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const currentTickets = filteredTickets.slice(startIndex, endIndex);

  const openDocumentModal = (ticket) => {
    setSelectedTicket(ticket);
    setIsDocumentModalOpen(true);
  };

  const closeDocumentModal = () => {
    setIsDocumentModalOpen(false);
    setSelectedTicket(null);
  };

  const handleEditTicket = (ticket) => {
    setEditingTicket(ticket);
    setIsEditTicketModalOpen(true);
  };

  const handleDeleteTicket = (ticketId) => {
    if (window.confirm('¿Estás seguro de eliminar este ticket?')) {
      // Aquí se eliminaría del backend
      alert('Ticket eliminado exitosamente');
    }
  };

  const updateTicketStatus = (ticketId, newStatus) => {
    // Aquí se actualizaría en el backend
    alert(`Ticket ${ticketId} actualizado a ${newStatus}`);
    setIsEditTicketModalOpen(false);
  };

  // Mobile Card Component
  const TicketCard = ({ ticket }) => (
    <Card className="mb-4 hover:shadow-md transition-shadow">
      <CardContent className="p-4">
        <div className="flex justify-between items-start mb-3">
          <div>
            <h3 className="font-semibold text-lg text-gray-900">{ticket.id}</h3>
            <p className="text-sm text-gray-600">{ticket.equipment}</p>
          </div>
          <Button
            onClick={() => openDocumentModal(ticket)}
            className="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
            size="sm"
            title="Ver documento de trabajo"
          >
            <FolderOpen className="h-4 w-4" />
          </Button>
        </div>

        <div className="space-y-2 mb-3">
          <div className="flex items-center text-sm text-gray-600">
            <Building className="h-4 w-4 mr-2 text-gray-400" />
            <span className="font-medium mr-2">Ubicación:</span>
            {ticket.location}
          </div>
          <div className="flex items-center text-sm text-gray-600">
            <User className="h-4 w-4 mr-2 text-gray-400" />
            <span className="font-medium mr-2">Técnico:</span>
            {ticket.technician}
          </div>
          <div className="flex items-center text-sm text-gray-600">
            <Calendar className="h-4 w-4 mr-2 text-gray-400" />
            <span className="font-medium mr-2">Fecha:</span>
            {ticket.date}
          </div>
        </div>

        <div className="text-sm text-gray-600 mb-3">
          <span className="font-medium">Equipo:</span> {ticket.brand} -{" "}
          {ticket.model}
          <br />
          <span className="font-medium">S/N:</span> {ticket.serial}
        </div>

        <div className="flex flex-wrap gap-2">
          <Badge
            className={`${getPriorityColor(ticket.priority)} border text-xs`}
          >
            {ticket.priority}
          </Badge>
          <Badge className={`${getStatusColor(ticket.status)} border text-xs`}>
            {ticket.status}
          </Badge>
        </div>
      </CardContent>
    </Card>
  );

  return (
    <div className="p-3 sm:p-6 space-y-4 sm:space-y-6 bg-gray-50 min-h-screen">
      {/* Header */}
      <div className="space-y-4">
        <div>
          <h1 className="text-xl sm:text-2xl font-bold text-gray-900">
            Gestión de Tickets
          </h1>
          <p className="text-sm sm:text-base text-gray-600 mt-1">
            Administre y supervise todos los tickets del sistema
          </p>
        </div>

        {/* Filtros */}
        <div className="flex flex-col sm:flex-row sm:items-center gap-4">
          <div className="relative">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
            <Input
              placeholder="Buscar tickets..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10 w-64"
            />
          </div>
          
          <div className="flex gap-2">
            <select 
              className="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
              value={selectedOrigin}
              onChange={(e) => setSelectedOrigin(e.target.value)}
            >
              <option value="todos">Todos los orígenes</option>
              <option value="biomedico">HUV MANTENIMIENTO BIOMEDICO</option>
              <option value="industrial">HUV MANTENIMIENTO INDUSTRIAL</option>
              <option value="externos">PROVEEDORES EXTERNOS</option>
            </select>
            
            <select 
              className="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
              value={selectedStatus}
              onChange={(e) => setSelectedStatus(e.target.value)}
            >
              <option value="todos">Todos los estados</option>
              <option value="pendiente">Pendiente</option>
              <option value="en proceso">En Proceso</option>
              <option value="completado">Completado</option>
            </select>
          </div>
        </div>

        {/* Records Count */}
        <div className="text-xs sm:text-sm text-gray-600">
          Mostrando registros de {startIndex + 1} a{" "}
          {Math.min(endIndex, filteredTickets.length)} de un total de{" "}
          {filteredTickets.length} registros
        </div>
      </div>

      {/* Mobile View - Cards */}
      <div className="block lg:hidden">
        <div className="space-y-4">
          {currentTickets.map((ticket) => (
            <TicketCard key={ticket.id} ticket={ticket} />
          ))}
        </div>
      </div>

      {/* Desktop/Tablet View - Table */}
      <div className="hidden lg:block">
        <div className="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead className="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Ticket
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Equipo
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Ubicación
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Técnico
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Prioridad
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Estado
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fecha
                  </th>
                  <th className="px-4 xl:px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Documento
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {currentTickets.map((ticket) => (
                  <tr
                    key={ticket.id}
                    className="hover:bg-gray-50 transition-colors"
                  >
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <div className="text-sm font-medium text-gray-900">
                        {ticket.id}
                      </div>
                    </td>
                    <td className="px-4 xl:px-6 py-4">
                      <div className="text-sm text-gray-900 font-medium">
                        {ticket.equipment}
                      </div>
                      <div className="text-sm text-gray-500">
                        {ticket.brand} - {ticket.model}
                      </div>
                      <div className="text-xs text-gray-400">
                        S/N: {ticket.serial}
                      </div>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <div className="flex items-center text-sm text-gray-900">
                        <Building className="h-4 w-4 mr-2 text-gray-400" />
                        {ticket.location}
                      </div>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <div className="flex items-center text-sm text-gray-900">
                        <User className="h-4 w-4 mr-2 text-gray-400" />
                        {ticket.technician}
                      </div>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <Badge
                        className={`${getPriorityColor(
                          ticket.priority
                        )} border`}
                      >
                        {ticket.priority}
                      </Badge>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <Badge
                        className={`${getStatusColor(ticket.status)} border`}
                      >
                        {ticket.status}
                      </Badge>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <div className="flex items-center text-sm text-gray-900">
                        <Calendar className="h-4 w-4 mr-2 text-gray-400" />
                        {ticket.date}
                      </div>
                    </td>
                    <td className="px-4 xl:px-6 py-4 whitespace-nowrap">
                      <div className="flex space-x-2">
                        <Button
                          onClick={() => openDocumentModal(ticket)}
                          className="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-200"
                          size="sm"
                          title="Ver documento de trabajo"
                        >
                          <FolderOpen className="h-4 w-4" />
                        </Button>
                        <Button
                          variant="outline"
                          size="sm"
                          onClick={() => handleEditTicket(ticket)}
                          title="Editar ticket"
                        >
                          <Edit className="h-4 w-4" />
                        </Button>
                        <Button
                          variant="outline"
                          size="sm"
                          onClick={() => handleDeleteTicket(ticket.id)}
                          className="text-red-600 hover:text-red-700 hover:bg-red-50"
                          title="Eliminar ticket"
                        >
                          <Trash2 className="h-4 w-4" />
                        </Button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {/* Pagination */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 px-3 sm:px-6 py-4">
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div className="text-xs sm:text-sm text-gray-700 text-center sm:text-left">
            <span>
              Mostrando {startIndex + 1} a{" "}
              {Math.min(endIndex, filteredTickets.length)} de{" "}
              {filteredTickets.length} registros
            </span>
          </div>
          <div className="flex items-center justify-center space-x-1 sm:space-x-2">
            <Button
              variant="outline"
              size="sm"
              onClick={() => setCurrentPage((prev) => Math.max(prev - 1, 1))}
              disabled={currentPage === 1}
              className="border-gray-300 text-xs sm:text-sm px-2 sm:px-3"
            >
              <ChevronLeft className="h-3 w-3 sm:h-4 sm:w-4" />
              <span className="hidden sm:inline ml-1">Anterior</span>
            </Button>

            <div className="flex items-center space-x-1">
              {/* Mobile: Show only current page and total */}
              <div className="block sm:hidden">
                <span className="text-xs text-gray-600">
                  {currentPage} / {totalPages}
                </span>
              </div>

              {/* Desktop: Show page numbers */}
              <div className="hidden sm:flex items-center space-x-1">
                {Array.from({ length: Math.min(totalPages, 5) }, (_, i) => {
                  let page;
                  if (totalPages <= 5) {
                    page = i + 1;
                  } else if (currentPage <= 3) {
                    page = i + 1;
                  } else if (currentPage >= totalPages - 2) {
                    page = totalPages - 4 + i;
                  } else {
                    page = currentPage - 2 + i;
                  }
                  return (
                    <Button
                      key={page}
                      variant={currentPage === page ? "default" : "outline"}
                      size="sm"
                      onClick={() => setCurrentPage(page)}
                      className={`text-xs px-2 ${
                        currentPage === page
                          ? "bg-blue-600 text-white"
                          : "border-gray-300"
                      }`}
                    >
                      {page}
                    </Button>
                  );
                })}
              </div>
            </div>

            <Button
              variant="outline"
              size="sm"
              onClick={() =>
                setCurrentPage((prev) => Math.min(prev + 1, totalPages))
              }
              disabled={currentPage === totalPages}
              className="border-gray-300 text-xs sm:text-sm px-2 sm:px-3"
            >
              <span className="hidden sm:inline mr-1">Siguiente</span>
              <ChevronRight className="h-3 w-3 sm:h-4 sm:w-4" />
            </Button>
          </div>
        </div>
      </div>

      {/* Work Order Modal */}
      {selectedTicket && (
        <Dialog open={isDocumentModalOpen} onOpenChange={setIsDocumentModalOpen}>
          <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
            <DialogHeader>
              <DialogTitle>Orden de Trabajo - {selectedTicket.id}</DialogTitle>
            </DialogHeader>
            <div className="p-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h4 className="font-semibold text-gray-900 mb-3">Información del Equipo</h4>
                  <div className="space-y-2 text-sm">
                    <div><span className="font-medium">Equipo:</span> {selectedTicket.equipment}</div>
                    <div><span className="font-medium">Marca:</span> {selectedTicket.brand}</div>
                    <div><span className="font-medium">Modelo:</span> {selectedTicket.model}</div>
                    <div><span className="font-medium">Serie:</span> {selectedTicket.serial}</div>
                    <div><span className="font-medium">Ubicación:</span> {selectedTicket.location}</div>
                  </div>
                </div>
                
                <div>
                  <h4 className="font-semibold text-gray-900 mb-3">Detalles del Trabajo</h4>
                  <div className="space-y-2 text-sm">
                    <div><span className="font-medium">Técnico:</span> {selectedTicket.technician}</div>
                    <div><span className="font-medium">Fecha:</span> {selectedTicket.date}</div>
                    <div><span className="font-medium">Prioridad:</span> {selectedTicket.priority}</div>
                    <div><span className="font-medium">Estado:</span> {selectedTicket.status}</div>
                    <div><span className="font-medium">Tiempo Estimado:</span> {selectedTicket.estimatedTime}</div>
                  </div>
                </div>
              </div>
              
              <div className="mt-6">
                <h4 className="font-semibold text-gray-900 mb-3">Descripción del Problema</h4>
                <p className="text-sm text-gray-700 bg-gray-50 p-3 rounded">
                  {selectedTicket.issue}
                </p>
              </div>
              
              <div className="mt-6">
                <h4 className="font-semibold text-gray-900 mb-3">Estado Actual</h4>
                <p className="text-sm text-gray-700 bg-blue-50 p-3 rounded">
                  {selectedTicket.actualState}
                </p>
              </div>
              
              <div className="flex justify-end mt-6">
                <Button onClick={() => setIsDocumentModalOpen(false)}>
                  Cerrar
                </Button>
              </div>
            </div>
          </DialogContent>
        </Dialog>
      )}

      {/* Modal Editar Estado */}
      <Dialog open={isEditTicketModalOpen} onOpenChange={setIsEditTicketModalOpen}>
        <DialogContent className="max-w-md">
          <DialogHeader>
            <DialogTitle>Editar Estado - {editingTicket?.id}</DialogTitle>
          </DialogHeader>
          {editingTicket && (
            <div className="p-6 space-y-4">
              <div>
                <Label>Estado Actual</Label>
                <div className="mt-1">
                  <Badge className={getStatusColor(editingTicket.status)}>
                    {editingTicket.status}
                  </Badge>
                </div>
              </div>
              <div>
                <Label>Nuevo Estado</Label>
                <Select onValueChange={(value) => updateTicketStatus(editingTicket.id, value)}>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccionar nuevo estado" />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="PENDIENTE">Pendiente</SelectItem>
                    <SelectItem value="EN PROCESO">En Proceso</SelectItem>
                    <SelectItem value="COMPLETADO">Completado</SelectItem>
                  </SelectContent>
                </Select>
              </div>
              <div>
                <Label>Observaciones</Label>
                <Textarea placeholder="Agregar observaciones sobre el cambio de estado" />
              </div>
              <div className="flex justify-end space-x-2">
                <Button variant="outline" onClick={() => setIsEditTicketModalOpen(false)}>Cancelar</Button>
                <Button onClick={() => setIsEditTicketModalOpen(false)}>Actualizar</Button>
              </div>
            </div>
          )}
        </DialogContent>
      </Dialog>

      {/* Modales Específicos de Gestión */}
      <GestionThirdPartyModal
        isOpen={isThirdPartyModalOpen}
        onClose={() => setIsThirdPartyModalOpen(false)}
        onSubmit={(data) => {
          console.log('Registrando supervisor:', data);
          alert(`Supervisor ${data.name} registrado exitosamente`);
          setIsThirdPartyModalOpen(false);
        }}
      />

      <GestionFileUploadModal
        isOpen={isFileUploadModalOpen}
        onClose={() => setIsFileUploadModalOpen(false)}
        onUpload={(files) => {
          console.log('Subiendo documentos administrativos:', files);
          alert(`${files.length} documento(s) administrativo(s) subido(s)`);
          setIsFileUploadModalOpen(false);
        }}
      />

      <GestionAttachmentModal
        isOpen={isAttachmentModalOpen}
        onClose={() => setIsAttachmentModalOpen(false)}
      />
    </div>
  );
}
