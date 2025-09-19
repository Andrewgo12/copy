"use client";

import { useState } from "react";
import { Card, CardContent } from "../ui/card";
import { Button } from "../ui/button";
import { Badge } from "../ui/badge";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "../ui/table";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "../ui/select";
import { Input } from "../ui/input";
import { Edit, Trash2, Plus, Search, Settings, Eye, Wrench, Calendar, AlertTriangle, FileText, BarChart3 } from "lucide-react";

// Importar modales principales
import UIModalRegistrarRepuesto from "./modals/ui-modal-registrar-repuesto";
import UIModalDepurarRepuesto from "./modals/ui-modal-depurar-repuesto";
import UIModalConsolidarRepuesto from "./modals/ui-modal-consolidar-repuesto";
import UIModalPreventivos from "./modals/ui-modal-preventivos";
import UIModalCalibraciones from "./modals/ui-modal-calibraciones";
import UIModalCorrectivos from "./modals/ui-modal-correctivos";
import UIModalReportes from "./modals/ui-modal-reportes";

// Modales CRUD
import UIModalEditarRepuesto from "./modals/ui-modal-editar-repuesto";
import UIModalEliminarRepuesto from "./modals/ui-modal-eliminar-repuesto";
import UIModalVerRepuesto from "./modals/ui-modal-ver-repuesto";

export default function VistaRepuestosPrincipal() {
  const [isRegistrarOpen, setIsRegistrarOpen] = useState(false);
  const [isDepurarOpen, setIsDepurarOpen] = useState(false);
  const [isConsolidarOpen, setIsConsolidarOpen] = useState(false);
  const [isPreventivosOpen, setIsPreventivosOpen] = useState(false);
  const [isCalibracionesOpen, setIsCalibracionesOpen] = useState(false);
  const [isCorrectivosOpen, setIsCorrectivosOpen] = useState(false);
  const [isReportesOpen, setIsReportesOpen] = useState(false);
  
  console.log('Estados modales:', {
    isRegistrarOpen,
    isDepurarOpen,
    isConsolidarOpen,
    isPreventivosOpen,
    isCalibracionesOpen,
    isCorrectivosOpen,
    isReportesOpen
  });
  
  const [isEditModalOpen, setIsEditModalOpen] = useState(false);
  const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
  const [isViewModalOpen, setIsViewModalOpen] = useState(false);
  const [selectedRepuesto, setSelectedRepuesto] = useState(null);
  
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage, setItemsPerPage] = useState(10);
  const [searchTerm, setSearchTerm] = useState("");

  // Datos de repuestos
  const repuestosData = [
    {
      id: 1,
      codigo: "REP001",
      nombre: "FILTRO HEPA H14",
      categoria: "FILTROS",
      marca: "CAMFIL",
      modelo: "ABSOLUTE V",
      stock: 25,
      stockMinimo: 5,
      precio: 450000,
      proveedor: "EQUIPOS TECTUM",
      ubicacion: "ALMACEN A-01",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-01-15",
      ultimoMantenimiento: "2024-01-10",
      proximoMantenimiento: "2024-04-10"
    },
    {
      id: 2,
      codigo: "REP002", 
      nombre: "BOMBA PERISTALTICA",
      categoria: "BOMBAS",
      marca: "WATSON MARLOW",
      modelo: "323S",
      stock: 8,
      stockMinimo: 3,
      precio: 1200000,
      proveedor: "J.M MEDICOS EQUIPOS S.A.S",
      ubicacion: "ALMACEN B-05",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-01-20",
      ultimoMantenimiento: "2024-01-18",
      proximoMantenimiento: "2024-04-18"
    },
    {
      id: 3,
      codigo: "REP003",
      nombre: "SENSOR TEMPERATURA",
      categoria: "SENSORES",
      marca: "HONEYWELL",
      modelo: "T6373BC1130",
      stock: 2,
      stockMinimo: 5,
      precio: 280000,
      proveedor: "MEDICAS MEDICAL COLOMBIA SAS",
      ubicacion: "ALMACEN C-12",
      estado: "STOCK_BAJO",
      fechaIngreso: "2024-02-01",
      ultimoMantenimiento: "2024-01-25",
      proximoMantenimiento: "2024-04-25"
    },
    {
      id: 4,
      codigo: "REP004",
      nombre: "VALVULA SOLENOIDE",
      categoria: "VALVULAS",
      marca: "ASCO",
      modelo: "8210G094",
      stock: 15,
      stockMinimo: 8,
      precio: 320000,
      proveedor: "ABS EQUIPOS MEDICOS S.A.S",
      ubicacion: "ALMACEN A-08",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-02-10",
      ultimoMantenimiento: "2024-02-05",
      proximoMantenimiento: "2024-05-05"
    },
    {
      id: 5,
      codigo: "REP005",
      nombre: "MOTOR PASO A PASO",
      categoria: "MOTORES",
      marca: "STEPPER ONLINE",
      modelo: "23HS22-2804S",
      stock: 0,
      stockMinimo: 2,
      precio: 180000,
      proveedor: "GERMAN MEDICAL SYSTEMS",
      ubicacion: "ALMACEN B-15",
      estado: "AGOTADO",
      fechaIngreso: "2024-01-05",
      ultimoMantenimiento: "2024-01-01",
      proximoMantenimiento: "2024-04-01"
    },
    {
      id: 6,
      codigo: "REP006",
      nombre: "PLACA ELECTRONICA",
      categoria: "ELECTRONICA",
      marca: "SIEMENS",
      modelo: "A5E00331092",
      stock: 12,
      stockMinimo: 4,
      precio: 2500000,
      proveedor: "SIEMENS HEALTHINEERS",
      ubicacion: "ALMACEN ESPECIAL",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-02-15",
      ultimoMantenimiento: "2024-02-12",
      proximoMantenimiento: "2024-05-12"
    },
    {
      id: 7,
      codigo: "REP007",
      nombre: "CORREA TRANSMISION",
      categoria: "TRANSMISION",
      marca: "GATES",
      modelo: "5M-425",
      stock: 30,
      stockMinimo: 10,
      precio: 85000,
      proveedor: "EQUIPOS TECTUM",
      ubicacion: "ALMACEN A-20",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-02-20",
      ultimoMantenimiento: "2024-02-18",
      proximoMantenimiento: "2024-05-18"
    },
    {
      id: 8,
      codigo: "REP008",
      nombre: "FUSIBLE CERAMICO",
      categoria: "PROTECCION",
      marca: "LITTELFUSE",
      modelo: "0217005.MXP",
      stock: 50,
      stockMinimo: 20,
      precio: 15000,
      proveedor: "ABS EQUIPOS MEDICOS S.A.S",
      ubicacion: "ALMACEN C-01",
      estado: "DISPONIBLE",
      fechaIngreso: "2024-03-01",
      ultimoMantenimiento: "2024-02-28",
      proximoMantenimiento: "2024-05-28"
    }
  ];

  const handleEdit = (repuesto) => {
    setSelectedRepuesto(repuesto);
    setIsEditModalOpen(true);
  };

  const handleDelete = (repuesto) => {
    setSelectedRepuesto(repuesto);
    setIsDeleteModalOpen(true);
  };

  const handleView = (repuesto) => {
    setSelectedRepuesto(repuesto);
    setIsViewModalOpen(true);
  };

  const filteredData = repuestosData.filter(
    (repuesto) =>
      repuesto.nombre.toLowerCase().includes(searchTerm.toLowerCase()) ||
      repuesto.codigo.toLowerCase().includes(searchTerm.toLowerCase()) ||
      repuesto.categoria.toLowerCase().includes(searchTerm.toLowerCase()) ||
      repuesto.marca.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const totalItems = filteredData.length;
  const totalPages = Math.ceil(totalItems / itemsPerPage);
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  const currentData = filteredData.slice(startIndex, endIndex);

  const getEstadoColor = (estado) => {
    switch (estado) {
      case "DISPONIBLE":
        return "bg-green-100 text-green-800";
      case "STOCK_BAJO":
        return "bg-yellow-100 text-yellow-800";
      case "AGOTADO":
        return "bg-red-100 text-red-800";
      default:
        return "bg-gray-100 text-gray-800";
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-gradient-to-r from-slate-600 to-slate-700 text-white p-6 shadow-lg">
        <div className="max-w-7xl mx-auto">
          <div className="flex items-center justify-between">
            <div className="flex items-center space-x-3">
              <div className="flex items-center justify-center w-8 h-8 bg-white/20 rounded-lg">
                <Wrench className="w-5 h-5 text-white" />
              </div>
              <div>
                <h1 className="text-xl font-semibold">Repuestos</h1>
                <p className="text-sm text-slate-200">Gestión integral de repuestos y mantenimiento</p>
              </div>
            </div>

            <div className="relative max-w-md">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
              <Input
                type="text"
                placeholder="Buscar repuestos..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="pl-10 bg-white/10 border-white/20 text-white placeholder-white/60 focus:bg-white/20"
              />
            </div>
          </div>
        </div>
      </div>

      {/* Botones de Acción Principal */}
      <div className="max-w-7xl mx-auto p-4 lg:p-6">
        <div className="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3 mb-6">
          <Button 
            onClick={() => {
              console.log('Abriendo Registrar');
              setIsRegistrarOpen(true);
            }} 
            className="bg-blue-500 hover:bg-blue-600 text-white flex items-center space-x-2"
          >
            <Plus className="w-4 h-4" />
            <span>Registrar</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Depurar');
              setIsDepurarOpen(true);
            }} 
            className="bg-purple-500 hover:bg-purple-600 text-white flex items-center space-x-2"
          >
            <Settings className="w-4 h-4" />
            <span>Depurar</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Consolidar');
              setIsConsolidarOpen(true);
            }} 
            className="bg-teal-500 hover:bg-teal-600 text-white flex items-center space-x-2"
          >
            <BarChart3 className="w-4 h-4" />
            <span>Consolidar</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Preventivos');
              setIsPreventivosOpen(true);
            }} 
            className="bg-green-500 hover:bg-green-600 text-white flex items-center space-x-2"
          >
            <Calendar className="w-4 h-4" />
            <span>Preventivos</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Calibraciones');
              setIsCalibracionesOpen(true);
            }} 
            className="bg-orange-500 hover:bg-orange-600 text-white flex items-center space-x-2"
          >
            <Settings className="w-4 h-4" />
            <span>Calibraciones</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Correctivos');
              setIsCorrectivosOpen(true);
            }} 
            className="bg-red-500 hover:bg-red-600 text-white flex items-center space-x-2"
          >
            <AlertTriangle className="w-4 h-4" />
            <span>Correctivos</span>
          </Button>
          
          <Button 
            onClick={() => {
              console.log('Abriendo Reportes');
              setIsReportesOpen(true);
            }} 
            className="bg-indigo-500 hover:bg-indigo-600 text-white flex items-center space-x-2"
          >
            <FileText className="w-4 h-4" />
            <span>Reportes</span>
          </Button>
        </div>

        <Card className="shadow-lg">
          <CardContent className="p-0">
            {/* Controles superiores */}
            <div className="p-6 border-b border-gray-200">
              <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div className="text-lg font-semibold text-gray-800">
                  Inventario de Repuestos
                </div>

                <div className="flex items-center space-x-2 text-sm text-gray-600">
                  <span>Mostrar</span>
                  <Select
                    value={itemsPerPage.toString()}
                    onValueChange={(value) => setItemsPerPage(Number(value))}
                  >
                    <SelectTrigger className="w-20">
                      <SelectValue />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="10">10</SelectItem>
                      <SelectItem value="25">25</SelectItem>
                      <SelectItem value="50">50</SelectItem>
                    </SelectContent>
                  </Select>
                  <span>entradas</span>
                </div>
              </div>
            </div>

            {/* Tabla */}
            <div className="w-full">
              <Table className="w-full table-fixed">
                <TableHeader className="bg-slate-100">
                  <TableRow>
                    <TableHead className="font-semibold text-slate-700 w-[25%]">Repuesto</TableHead>
                    <TableHead className="font-semibold text-slate-700 w-[20%]">Marca/Modelo</TableHead>
                    <TableHead className="font-semibold text-slate-700 text-center w-[15%]">Stock</TableHead>
                    <TableHead className="font-semibold text-slate-700 text-center w-[15%]">Precio</TableHead>
                    <TableHead className="font-semibold text-slate-700 text-center w-[15%]">Estado</TableHead>
                    <TableHead className="font-semibold text-slate-700 text-center w-[10%]">Acciones</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {currentData.map((repuesto) => (
                    <TableRow key={repuesto.id} className="hover:bg-gray-50">
                      <TableCell className="p-3 w-[25%]">
                        <div className="space-y-1">
                          <div className="font-semibold text-gray-900 text-sm leading-tight break-words whitespace-normal">
                            {repuesto.nombre}
                          </div>
                          <div className="text-xs text-gray-600">
                            {repuesto.codigo} • {repuesto.categoria}
                          </div>
                          <div className="text-xs text-gray-500">
                            📍 {repuesto.ubicacion}
                          </div>
                        </div>
                      </TableCell>
                      
                      <TableCell className="p-3 w-[20%]">
                        <div className="space-y-1">
                          <div className="text-sm font-medium text-gray-700">
                            {repuesto.marca}
                          </div>
                          <div className="text-xs text-gray-600">
                            {repuesto.modelo}
                          </div>
                        </div>
                      </TableCell>
                      
                      <TableCell className="text-center p-3 w-[15%]">
                        <div className="space-y-1">
                          <div className={`text-sm font-bold ${repuesto.stock <= repuesto.stockMinimo ? 'text-red-600' : 'text-green-600'}`}>
                            {repuesto.stock}
                          </div>
                          <div className="text-xs text-gray-500">
                            Min: {repuesto.stockMinimo}
                          </div>
                        </div>
                      </TableCell>
                      
                      <TableCell className="text-center p-3 w-[15%]">
                        <div className="text-sm font-medium text-gray-700">
                          ${repuesto.precio.toLocaleString()}
                        </div>
                      </TableCell>
                      
                      <TableCell className="text-center p-3 w-[15%]">
                        <Badge className={`${getEstadoColor(repuesto.estado)} text-xs px-2 py-1`}>
                          {repuesto.estado}
                        </Badge>
                      </TableCell>
                      
                      <TableCell className="text-center p-3 w-[10%]">
                        <div className="flex flex-col gap-1 items-center">
                          <Button
                            size="sm"
                            variant="outline"
                            className="h-6 w-6 p-0 bg-blue-500 hover:bg-blue-600 text-white border-blue-500"
                            onClick={() => handleView(repuesto)}
                            title="Ver"
                          >
                            <Eye className="h-3 w-3" />
                          </Button>
                          <Button
                            size="sm"
                            variant="outline"
                            className="h-6 w-6 p-0 bg-blue-500 hover:bg-blue-600 text-white border-blue-500"
                            onClick={() => handleEdit(repuesto)}
                            title="Editar"
                          >
                            <Edit className="h-3 w-3" />
                          </Button>
                          <Button
                            size="sm"
                            variant="outline"
                            className="h-6 w-6 p-0 bg-red-500 hover:bg-red-600 text-white border-red-500"
                            onClick={() => handleDelete(repuesto)}
                            title="Eliminar"
                          >
                            <Trash2 className="h-3 w-3" />
                          </Button>
                        </div>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </div>

            {/* Paginación */}
            <div className="p-6 border-t border-gray-200">
              <div className="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div className="text-sm text-gray-600">
                  Mostrando {startIndex + 1} a {Math.min(endIndex, totalItems)} de {totalItems} entradas
                  {searchTerm && ` (filtrado de ${repuestosData.length} entradas totales)`}
                </div>

                <div className="flex items-center space-x-2">
                  <Button
                    variant="outline"
                    size="sm"
                    disabled={currentPage === 1}
                    onClick={() => setCurrentPage(currentPage - 1)}
                  >
                    Anterior
                  </Button>

                  {[...Array(Math.min(5, totalPages))].map((_, i) => (
                    <Button
                      key={i + 1}
                      variant={currentPage === i + 1 ? "default" : "outline"}
                      size="sm"
                      className={currentPage === i + 1 ? "bg-blue-500 text-white" : ""}
                      onClick={() => setCurrentPage(i + 1)}
                    >
                      {i + 1}
                    </Button>
                  ))}

                  <Button
                    variant="outline"
                    size="sm"
                    disabled={currentPage === totalPages}
                    onClick={() => setCurrentPage(currentPage + 1)}
                  >
                    Siguiente
                  </Button>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Modales Principales */}
      {isRegistrarOpen && (
        <UIModalRegistrarRepuesto 
          isOpen={isRegistrarOpen} 
          onClose={() => {
            console.log('Cerrando Registrar');
            setIsRegistrarOpen(false);
          }} 
        />
      )}
      
      {isDepurarOpen && (
        <UIModalDepurarRepuesto 
          isOpen={isDepurarOpen} 
          onClose={() => {
            console.log('Cerrando Depurar');
            setIsDepurarOpen(false);
          }} 
        />
      )}
      
      {isConsolidarOpen && (
        <UIModalConsolidarRepuesto 
          isOpen={isConsolidarOpen} 
          onClose={() => {
            console.log('Cerrando Consolidar');
            setIsConsolidarOpen(false);
          }} 
        />
      )}
      
      {isPreventivosOpen && (
        <UIModalPreventivos 
          isOpen={isPreventivosOpen} 
          onClose={() => {
            console.log('Cerrando Preventivos');
            setIsPreventivosOpen(false);
          }} 
        />
      )}
      
      {isCalibracionesOpen && (
        <UIModalCalibraciones 
          isOpen={isCalibracionesOpen} 
          onClose={() => {
            console.log('Cerrando Calibraciones');
            setIsCalibracionesOpen(false);
          }} 
        />
      )}
      
      {isCorrectivosOpen && (
        <UIModalCorrectivos 
          isOpen={isCorrectivosOpen} 
          onClose={() => {
            console.log('Cerrando Correctivos');
            setIsCorrectivosOpen(false);
          }} 
        />
      )}
      
      {isReportesOpen && (
        <UIModalReportes 
          isOpen={isReportesOpen} 
          onClose={() => {
            console.log('Cerrando Reportes');
            setIsReportesOpen(false);
          }} 
        />
      )}

      {/* Modales CRUD */}
      <UIModalEditarRepuesto
        isOpen={isEditModalOpen}
        onClose={() => setIsEditModalOpen(false)}
        repuesto={selectedRepuesto}
      />
      <UIModalEliminarRepuesto
        isOpen={isDeleteModalOpen}
        onClose={() => setIsDeleteModalOpen(false)}
        repuesto={selectedRepuesto}
      />
      <UIModalVerRepuesto
        isOpen={isViewModalOpen}
        onClose={() => setIsViewModalOpen(false)}
        repuesto={selectedRepuesto}
      />
    </div>
  );
}