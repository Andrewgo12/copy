"use client";

import { useState, useEffect } from "react";
import globalStore from "./store/globalStore";
import { Button } from "./components/ui/button";
import { Input } from "./components/ui/input";
import { Label } from "./components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "./components/ui/select";
import { Textarea } from "./components/ui/textarea";
import { Badge } from "./components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "./components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from "./components/ui/dialog";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "./components/ui/table";
import {
  Filter, Plus, FileText, Users, Wrench, Eye, Calendar, Settings, Trash2, Edit, Search,
  Building, Cog, Truck, FolderOpen, CheckCircle, Download, Upload, UserPlus, Paperclip, X
} from "lucide-react";
import TicketForm from "./components/TicketForm";
import StatsCard from "./components/StatsCard";
import ActionButton from "./components/ActionButton";
import NotificationSystem from "./components/NotificationSystem";
import AdvancedFilters from "./components/AdvancedFilters";
import ExportModal from "./components/ExportModal";
import BulkActions from "./components/BulkActions";
import { MyTicketsThirdPartyModal, MyTicketsFileUploadModal, MyTicketsAttachmentModal } from "./components/MyTicketsModals";

export default function MyTickets() {
  const [searchTerm, setSearchTerm] = useState("");
  const [selectedOrigin, setSelectedOrigin] = useState("all");
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(5);
  const [selectedTicketType, setSelectedTicketType] = useState("biomedicos");
  const [isLicensedModalOpen, setIsLicensedModalOpen] = useState(false);
  const [isIndustrialModalOpen, setIsIndustrialModalOpen] = useState(false);
  const [isTransportModalOpen, setIsTransportModalOpen] = useState(false);
  const [selectedTicket, setSelectedTicket] = useState(null);
  const [isViewModalOpen, setIsViewModalOpen] = useState(false);
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [showStats, setShowStats] = useState(false);
  const [isReportModalOpen, setIsReportModalOpen] = useState(false);
  const [notifications, setNotifications] = useState([]);
  const [showAdvancedFilters, setShowAdvancedFilters] = useState(false);
  const [isExportModalOpen, setIsExportModalOpen] = useState(false);
  const [selectedTickets, setSelectedTickets] = useState([]);
  const [advancedFilters, setAdvancedFilters] = useState({});
  const [isThirdPartyModalOpen, setIsThirdPartyModalOpen] = useState(false);
  const [isFileUploadModalOpen, setIsFileUploadModalOpen] = useState(false);
  const [isAttachmentModalOpen, setIsAttachmentModalOpen] = useState(false);
  const [allTickets, setAllTickets] = useState(globalStore.getTickets());

  useEffect(() => {
    const unsubscribe = globalStore.subscribe((tickets) => {
      setAllTickets(tickets);
    });
    return unsubscribe;
  }, []);

  const addNotification = (message, type = 'info') => {
    const id = Date.now();
    setNotifications(prev => [...prev, { id, message, type }]);
    setTimeout(() => removeNotification(id), 5000);
  };

  const removeNotification = (id) => {
    setNotifications(prev => prev.filter(n => n.id !== id));
  };

  const getCurrentTickets = () => {
    let currentTickets = allTickets.filter(t => t.type === selectedTicketType);
    
    if (searchTerm) {
      currentTickets = currentTickets.filter(ticket => 
        ticket.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
        ticket.description.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }
    
    if (selectedOrigin !== "all") {
      currentTickets = currentTickets.filter(ticket => 
        ticket.origin.toLowerCase().includes(selectedOrigin.toLowerCase())
      );
    }
    
    return currentTickets;
  };

  const addNewTicket = (ticketData) => {
    globalStore.addTicket({
      origin: `${ticketData.type} 2024`,
      description: ticketData.description,
      date: ticketData.date,
      time: ticketData.time,
      type: ticketData.type
    });
    addNotification('Ticket creado exitosamente', 'success');
  };

  const handleView = (ticket) => {
    setSelectedTicket(ticket);
    setIsViewModalOpen(true);
  };

  const handleEdit = (ticket) => {
    setSelectedTicket(ticket);
    setIsEditModalOpen(true);
  };

  const handleDelete = (ticketId) => {
    if (window.confirm('¿Estás seguro de eliminar este ticket?')) {
      globalStore.deleteTicket(ticketId);
      addNotification('Ticket eliminado', 'success');
    }
  };

  const updateTicket = (updatedData) => {
    globalStore.updateTicket(selectedTicket.id, updatedData);
    setIsEditModalOpen(false);
    addNotification('Ticket actualizado', 'success');
  };

  const getStatusBadge = (status) => {
    switch (status) {
      case "Cerrado":
        return <Badge className="bg-green-100 text-green-800">Cerrado</Badge>;
      case "Abierto":
        return <Badge className="bg-red-100 text-red-800">Abierto</Badge>;
      case "En Proceso":
        return <Badge className="bg-yellow-100 text-yellow-800">En Proceso</Badge>;
      default:
        return <Badge>{status}</Badge>;
    }
  };

  const filteredTickets = getCurrentTickets();
  const totalPages = Math.ceil(filteredTickets.length / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const currentTickets = filteredTickets.slice(startIndex, endIndex);

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="bg-white border-b border-gray-200 px-6 py-4">
        <div className="flex flex-col gap-4">
          <div className="flex w-full justify-center">
            <div className="bg-blue-100 rounded-lg p-8 text-center">
              <h2 className="text-2xl font-bold text-blue-800">Mis Tickets</h2>
              <p className="text-blue-600 mt-2">Sistema de Gestión de Tickets</p>
            </div>
          </div>

          <div className="flex flex-wrap gap-2 mb-4">
            <Button
              variant={selectedTicketType === "biomedicos" ? "default" : "outline"}
              onClick={() => setSelectedTicketType("biomedicos")}
              className="py-2 px-4"
            >
              <Building className="w-4 h-4 mr-2" />
              Biomédicos
            </Button>
            <Button
              variant={selectedTicketType === "industriales" ? "default" : "outline"}
              onClick={() => setSelectedTicketType("industriales")}
              className="py-2 px-4"
            >
              <Cog className="w-4 h-4 mr-2" />
              Industriales
            </Button>
            <Button
              variant={selectedTicketType === "transporte" ? "default" : "outline"}
              onClick={() => setSelectedTicketType("transporte")}
              className="py-2 px-4"
            >
              <Truck className="w-4 h-4 mr-2" />
              Transporte
            </Button>
          </div>

          <div className="flex flex-wrap gap-2 mb-4">
            <Button variant="outline" onClick={() => setShowStats(!showStats)} className="py-2 px-4">
              <FileText className="w-4 h-4 mr-2" />
              {showStats ? 'Ocultar' : 'Mostrar'} Estadísticas
            </Button>
            <Button variant="outline" onClick={() => setIsReportModalOpen(true)} className="py-2 px-4">
              <Calendar className="w-4 h-4 mr-2" />
              Generar Reporte
            </Button>
            <Button variant="outline" onClick={() => setShowAdvancedFilters(!showAdvancedFilters)} className="py-2 px-4">
              <Filter className="w-4 h-4 mr-2" />
              Filtros Avanzados
            </Button>
            <Button variant="outline" onClick={() => setIsExportModalOpen(true)} className="py-2 px-4">
              <Download className="w-4 h-4 mr-2" />
              Exportar
            </Button>
            <Button variant="outline" onClick={() => setIsThirdPartyModalOpen(true)} className="py-2 px-4">
              <UserPlus className="w-4 h-4 mr-2" />
              Registrar Técnico
            </Button>
            <Button variant="outline" onClick={() => setIsFileUploadModalOpen(true)} className="py-2 px-4">
              <Upload className="w-4 h-4 mr-2" />
              Docs Técnicos
            </Button>
            <Button variant="outline" onClick={() => setIsAttachmentModalOpen(true)} className="py-2 px-4">
              <Paperclip className="w-4 h-4 mr-2" />
              Biblioteca
            </Button>
          </div>

          <AdvancedFilters
            isOpen={showAdvancedFilters}
            onToggle={() => setShowAdvancedFilters(!showAdvancedFilters)}
            onApplyFilters={(filters) => {
              setAdvancedFilters(filters);
              addNotification('Filtros aplicados', 'success');
            }}
            onClearFilters={() => {
              setAdvancedFilters({});
              addNotification('Filtros limpiados', 'info');
            }}
          />

          {showStats && (
            <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
              <StatsCard title="Tickets Abiertos" value={filteredTickets.filter(t => t.status === 'Abierto').length} icon={FileText} color="red" />
              <StatsCard title="En Proceso" value={filteredTickets.filter(t => t.status === 'En Proceso').length} icon={Settings} color="yellow" />
              <StatsCard title="Cerrados" value={filteredTickets.filter(t => t.status === 'Cerrado').length} icon={CheckCircle} color="green" />
              <StatsCard title="Total" value={filteredTickets.length} icon={Users} color="blue" />
            </div>
          )}

          <div className="flex flex-wrap gap-2">
            <Dialog open={isLicensedModalOpen} onOpenChange={setIsLicensedModalOpen}>
              <DialogTrigger asChild>
                <Button className="bg-blue-600 text-white hover:bg-blue-700 py-6 px-6" disabled={selectedTicketType !== "biomedicos"}>
                  <Building className="w-4 h-4 mr-2" />
                  Nuevo Biomédico
                </Button>
              </DialogTrigger>
              <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                  <DialogTitle>Nuevo Ticket Biomédico</DialogTitle>
                </DialogHeader>
                <div className="p-6">
                  <TicketForm type="biomedicos" onSubmit={addNewTicket} onClose={() => setIsLicensedModalOpen(false)} />
                </div>
              </DialogContent>
            </Dialog>

            <Dialog open={isIndustrialModalOpen} onOpenChange={setIsIndustrialModalOpen}>
              <DialogTrigger asChild>
                <Button className="bg-green-600 text-white hover:bg-green-700 py-6 px-6" disabled={selectedTicketType !== "industriales"}>
                  <Cog className="w-4 h-4 mr-2" />
                  Nuevo Industrial
                </Button>
              </DialogTrigger>
              <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                  <DialogTitle>Nuevo Ticket Industrial</DialogTitle>
                </DialogHeader>
                <div className="p-6">
                  <TicketForm type="industriales" onSubmit={addNewTicket} onClose={() => setIsIndustrialModalOpen(false)} />
                </div>
              </DialogContent>
            </Dialog>

            <Dialog open={isTransportModalOpen} onOpenChange={setIsTransportModalOpen}>
              <DialogTrigger asChild>
                <Button className="bg-orange-600 text-white hover:bg-orange-700 py-6 px-6" disabled={selectedTicketType !== "transporte"}>
                  <Truck className="w-4 h-4 mr-2" />
                  Nuevo Transporte
                </Button>
              </DialogTrigger>
              <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
                <DialogHeader>
                  <DialogTitle>Nuevo Ticket Transporte</DialogTitle>
                </DialogHeader>
                <div className="p-6">
                  <TicketForm type="transporte" onSubmit={addNewTicket} onClose={() => setIsTransportModalOpen(false)} />
                </div>
              </DialogContent>
            </Dialog>
          </div>
        </div>
      </div>

      <div className="px-6 py-4">
        <BulkActions
          selectedItems={selectedTickets}
          totalItems={currentTickets.length}
          onSelectAll={() => setSelectedTickets(currentTickets.map(t => t.id))}
          onDeselectAll={() => setSelectedTickets([])}
          onBulkDelete={(ids) => {
            ids.forEach(id => globalStore.deleteTicket(id));
            setSelectedTickets([]);
            addNotification(`${ids.length} tickets eliminados`, 'success');
          }}
          onBulkStatusChange={(ids, status) => {
            ids.forEach(id => globalStore.updateTicket(id, { status }));
            setSelectedTickets([]);
            addNotification(`${ids.length} tickets actualizados`, 'success');
          }}
          onBulkExport={() => setIsExportModalOpen(true)}
        />
        
        <div className="bg-white rounded-lg shadow">
          <div className="px-6 py-4 border-b border-gray-200">
            <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
              <div className="flex items-center space-x-4">
                <div className="relative">
                  <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
                  <Input placeholder="Buscar tickets..." value={searchTerm} onChange={(e) => setSearchTerm(e.target.value)} className="pl-10 w-64" />
                </div>
                <Select value={selectedOrigin} onValueChange={setSelectedOrigin}>
                  <SelectTrigger className="w-48">
                    <SelectValue />
                  </SelectTrigger>
                  <SelectContent>
                    <SelectItem value="all">Todos los orígenes</SelectItem>
                    <SelectItem value="biomedico">Biomédico 2024</SelectItem>
                    <SelectItem value="industrial">Industrial 2024</SelectItem>
                    <SelectItem value="transporte">Transporte 2024</SelectItem>
                  </SelectContent>
                </Select>
              </div>
            </div>
          </div>

          <div className="overflow-x-auto">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>ID</TableHead>
                  <TableHead>Origen</TableHead>
                  <TableHead>Descripción</TableHead>
                  <TableHead>Fecha</TableHead>
                  <TableHead>Hora</TableHead>
                  <TableHead>Estado</TableHead>
                  <TableHead>Acciones</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {currentTickets.map((ticket) => (
                  <TableRow key={ticket.id}>
                    <TableCell className="font-medium">{ticket.id}</TableCell>
                    <TableCell>{ticket.origin}</TableCell>
                    <TableCell className="max-w-md">
                      <div className="truncate" title={ticket.description}>{ticket.description}</div>
                    </TableCell>
                    <TableCell>{ticket.date}</TableCell>
                    <TableCell>{ticket.time}</TableCell>
                    <TableCell>{getStatusBadge(ticket.status)}</TableCell>
                    <TableCell>
                      <div className="flex space-x-2">
                        <ActionButton icon={Eye} label="Ver" onClick={() => handleView(ticket)} />
                        <ActionButton icon={Edit} label="Editar" onClick={() => handleEdit(ticket)} />
                        <ActionButton icon={Trash2} label="Eliminar" color="danger" onClick={() => handleDelete(ticket.id)} />
                      </div>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>
          </div>

          <div className="px-6 py-4 border-t border-gray-200">
            <div className="flex items-center justify-between">
              <div className="text-sm text-gray-700">
                Mostrando {startIndex + 1} a {Math.min(endIndex, filteredTickets.length)} de {filteredTickets.length} resultados
              </div>
              <div className="flex items-center space-x-2">
                <Button variant="outline" size="sm" onClick={() => setCurrentPage(prev => Math.max(prev - 1, 1))} disabled={currentPage === 1}>
                  Anterior
                </Button>
                <span className="text-sm text-gray-700">Página {currentPage} de {totalPages}</span>
                <Button variant="outline" size="sm" onClick={() => setCurrentPage(prev => Math.min(prev + 1, totalPages))} disabled={currentPage === totalPages}>
                  Siguiente
                </Button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <Dialog open={isViewModalOpen} onOpenChange={setIsViewModalOpen}>
        <DialogContent className="max-w-2xl">
          <DialogHeader>
            <DialogTitle>Detalles del Ticket - {selectedTicket?.id}</DialogTitle>
          </DialogHeader>
          {selectedTicket && (
            <div className="p-6 space-y-4">
              <div className="grid grid-cols-2 gap-4">
                <div><strong>ID:</strong> {selectedTicket.id}</div>
                <div><strong>Tipo:</strong> {selectedTicket.type}</div>
                <div><strong>Origen:</strong> {selectedTicket.origin}</div>
                <div><strong>Estado:</strong> {getStatusBadge(selectedTicket.status)}</div>
                <div><strong>Fecha:</strong> {selectedTicket.date}</div>
                <div><strong>Hora:</strong> {selectedTicket.time}</div>
              </div>
              <div>
                <strong>Descripción:</strong>
                <p className="mt-2 p-3 bg-gray-50 rounded">{selectedTicket.description}</p>
              </div>
            </div>
          )}
        </DialogContent>
      </Dialog>

      <Dialog open={isEditModalOpen} onOpenChange={setIsEditModalOpen}>
        <DialogContent className="max-w-4xl max-h-[90vh] overflow-y-auto">
          <DialogHeader>
            <DialogTitle>Editar Ticket - {selectedTicket?.id}</DialogTitle>
          </DialogHeader>
          {selectedTicket && (
            <div className="p-6">
              <TicketForm type={selectedTicket.type} initialData={selectedTicket} onSubmit={updateTicket} onClose={() => setIsEditModalOpen(false)} isEdit={true} />
            </div>
          )}
        </DialogContent>
      </Dialog>

      <Dialog open={isReportModalOpen} onOpenChange={setIsReportModalOpen}>
        <DialogContent className="max-w-2xl">
          <DialogHeader>
            <DialogTitle>Generar Reporte de Tickets</DialogTitle>
          </DialogHeader>
          <div className="p-6 space-y-4">
            <div className="grid grid-cols-2 gap-4">
              <div>
                <Label>Fecha Inicio</Label>
                <Input type="date" />
              </div>
              <div>
                <Label>Fecha Fin</Label>
                <Input type="date" />
              </div>
            </div>
            <div>
              <Label>Tipo de Reporte</Label>
              <Select>
                <SelectTrigger>
                  <SelectValue placeholder="Seleccionar tipo" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="general">Reporte General</SelectItem>
                  <SelectItem value="biomedicos">Solo Biomédicos</SelectItem>
                  <SelectItem value="industriales">Solo Industriales</SelectItem>
                  <SelectItem value="transporte">Solo Transporte</SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div className="flex justify-end space-x-2">
              <Button variant="outline" onClick={() => setIsReportModalOpen(false)}>Cancelar</Button>
              <Button onClick={() => {
                addNotification('Reporte generado exitosamente', 'success');
                setIsReportModalOpen(false);
              }}>Generar PDF</Button>
            </div>
          </div>
        </DialogContent>
      </Dialog>

      <MyTicketsThirdPartyModal
        isOpen={isThirdPartyModalOpen}
        onClose={() => setIsThirdPartyModalOpen(false)}
        onSubmit={(data) => {
          addNotification(`Técnico ${data.name} registrado exitosamente`, 'success');
          setIsThirdPartyModalOpen(false);
        }}
      />

      <MyTicketsFileUploadModal
        isOpen={isFileUploadModalOpen}
        onClose={() => setIsFileUploadModalOpen(false)}
        onUpload={(files) => {
          addNotification(`${files.length} documento(s) técnico(s) subido(s)`, 'success');
          setIsFileUploadModalOpen(false);
        }}
      />

      <MyTicketsAttachmentModal
        isOpen={isAttachmentModalOpen}
        onClose={() => setIsAttachmentModalOpen(false)}
      />

      <ExportModal
        isOpen={isExportModalOpen}
        onClose={() => setIsExportModalOpen(false)}
        data={filteredTickets}
        onExport={(exportData) => {
          addNotification(`Datos exportados en formato ${exportData.format.toUpperCase()}`, 'success');
        }}
      />

      <NotificationSystem notifications={notifications} onRemove={removeNotification} />
    </div>
  );
}