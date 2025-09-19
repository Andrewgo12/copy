import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import {
    Search,
    Filter,
    Clock,
    AlertTriangle,
    User,
    Building,
    Calendar,
    Eye,
    UserCheck,
    FileText,
    RefreshCw
} from 'lucide-react';

interface SolicitudReferencia {
    id: number;
    numero_solicitud: string;
    paciente_nombre: string;
    paciente_edad: number;
    diagnostico_presuntivo: string;
    institucion_remitente: string;
    medico_remitente: string;
    especialidad_solicitada: string;
    nivel_prioridad: string;
    urgencia_medica: string;
    estado_solicitud: string;
    fecha_recepcion: string;
    fecha_solicitud: string;
    es_vencida: boolean;
    medico_evaluador?: {
        id: number;
        name: string;
    };
    tiempo_respuesta_horas?: number;
}

interface Stats {
    nuevas: number;
    en_revision: number;
    urgentes: number;
    vencidas: number;
}

interface Props {
    solicitudes: {
        data: SolicitudReferencia[];
        links: any[];
        meta: any;
    };
    stats: Stats;
    medicos: Array<{id: number; name: string}>;
    especialidades: string[];
    filters: {
        estado?: string;
        prioridad?: string;
        especialidad?: string;
        urgencia?: string;
        medico?: string;
        search?: string;
    };
}

export default function BandejaCasos({ solicitudes, stats, medicos, especialidades, filters }: Props) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [selectedFilters, setSelectedFilters] = useState(filters);

    const handleSearch = () => {
        router.get('/medico/bandeja-casos', {
            ...selectedFilters,
            search: searchTerm
        });
    };

    const handleFilterChange = (key: string, value: string) => {
        const newFilters = { ...selectedFilters, [key]: value };
        setSelectedFilters(newFilters);
        router.get('/medico/bandeja-casos', newFilters);
    };

    const clearFilters = () => {
        setSelectedFilters({});
        setSearchTerm('');
        router.get('/medico/bandeja-casos');
    };

    const getPriorityColor = (prioridad: string) => {
        switch (prioridad) {
            case 'alta':
                return 'bg-red-100 text-red-800';
            case 'media':
                return 'bg-yellow-100 text-yellow-800';
            case 'baja':
                return 'bg-green-100 text-green-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getStatusColor = (estado: string) => {
        switch (estado) {
            case 'nueva':
                return 'bg-blue-100 text-blue-800';
            case 'en_revision':
                return 'bg-yellow-100 text-yellow-800';
            case 'aceptada':
                return 'bg-green-100 text-green-800';
            case 'rechazada':
                return 'bg-red-100 text-red-800';
            case 'pendiente_info':
                return 'bg-orange-100 text-orange-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getUrgencyIcon = (urgencia: string) => {
        switch (urgencia) {
            case 'critica':
                return <AlertTriangle className="h-4 w-4 text-red-600" />;
            case 'urgente':
                return <AlertTriangle className="h-4 w-4 text-orange-600" />;
            default:
                return <Clock className="h-4 w-4 text-gray-600" />;
        }
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleString('es-ES', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const getEstadoLegible = (estado: string) => {
        const estados = {
            'nueva': 'Nueva',
            'en_revision': 'En Revisión',
            'aceptada': 'Aceptada',
            'rechazada': 'Rechazada',
            'pendiente_info': 'Pendiente Info'
        };
        return estados[estado] || estado;
    };

    return (
        <AppLayout>
            <Head title="Bandeja de Casos Médicos" />

            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight">Bandeja de Casos Médicos</h1>
                        <p className="text-muted-foreground">
                            Gestión de solicitudes de referencia y contra-referencia
                        </p>
                    </div>

                    <Button
                        onClick={() => router.reload()}
                        variant="outline"
                    >
                        <RefreshCw className="h-4 w-4 mr-2" />
                        Actualizar
                    </Button>
                </div>

                {/* Stats Cards */}
                <div className="grid gap-4 md:grid-cols-4">
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <FileText className="h-5 w-5 text-blue-500" />
                                <div>
                                    <p className="text-sm font-medium">Nuevas</p>
                                    <p className="text-2xl font-bold text-blue-600">{stats.nuevas}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <Eye className="h-5 w-5 text-yellow-500" />
                                <div>
                                    <p className="text-sm font-medium">En Revisión</p>
                                    <p className="text-2xl font-bold text-yellow-600">{stats.en_revision}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <AlertTriangle className="h-5 w-5 text-red-500" />
                                <div>
                                    <p className="text-sm font-medium">Urgentes</p>
                                    <p className="text-2xl font-bold text-red-600">{stats.urgentes}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <Clock className="h-5 w-5 text-orange-500" />
                                <div>
                                    <p className="text-sm font-medium">Vencidas</p>
                                    <p className="text-2xl font-bold text-orange-600">{stats.vencidas}</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Filters */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            <Filter className="h-5 w-5 mr-2" />
                            Filtros y Búsqueda
                        </CardTitle>
                    </CardHeader>
                    <CardContent className="space-y-4">
                        {/* Search */}
                        <div className="flex space-x-2">
                            <div className="flex-1">
                                <Input
                                    placeholder="Buscar por paciente, número de solicitud, institución..."
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
                                />
                            </div>
                            <Button onClick={handleSearch}>
                                <Search className="h-4 w-4 mr-2" />
                                Buscar
                            </Button>
                        </div>

                        {/* Filters Row */}
                        <div className="grid grid-cols-2 md:grid-cols-5 gap-4">
                            <Select value={selectedFilters.estado || ''} onValueChange={(value) => handleFilterChange('estado', value)}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Estado" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todos los estados</SelectItem>
                                    <SelectItem value="nueva">Nueva</SelectItem>
                                    <SelectItem value="en_revision">En Revisión</SelectItem>
                                    <SelectItem value="aceptada">Aceptada</SelectItem>
                                    <SelectItem value="rechazada">Rechazada</SelectItem>
                                    <SelectItem value="pendiente_info">Pendiente Info</SelectItem>
                                </SelectContent>
                            </Select>

                            <Select value={selectedFilters.prioridad || ''} onValueChange={(value) => handleFilterChange('prioridad', value)}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Prioridad" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todas las prioridades</SelectItem>
                                    <SelectItem value="alta">Alta</SelectItem>
                                    <SelectItem value="media">Media</SelectItem>
                                    <SelectItem value="baja">Baja</SelectItem>
                                </SelectContent>
                            </Select>

                            <Select value={selectedFilters.urgencia || ''} onValueChange={(value) => handleFilterChange('urgencia', value)}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Urgencia" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todas las urgencias</SelectItem>
                                    <SelectItem value="critica">Crítica</SelectItem>
                                    <SelectItem value="urgente">Urgente</SelectItem>
                                    <SelectItem value="normal">Normal</SelectItem>
                                </SelectContent>
                            </Select>

                            <Select value={selectedFilters.especialidad || ''} onValueChange={(value) => handleFilterChange('especialidad', value)}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Especialidad" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todas las especialidades</SelectItem>
                                    {especialidades.map((esp) => (
                                        <SelectItem key={esp} value={esp}>{esp}</SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>

                            <Button variant="outline" onClick={clearFilters}>
                                Limpiar Filtros
                            </Button>
                        </div>
                    </CardContent>
                </Card>

                {/* Solicitudes List */}
                <div className="space-y-4">
                    {solicitudes.data.map((solicitud) => (
                        <Card key={solicitud.id} className={`hover:shadow-md transition-shadow ${solicitud.es_vencida ? 'border-red-200 bg-red-50' : ''}`}>
                            <CardContent className="p-6">
                                <div className="flex items-start justify-between">
                                    <div className="flex-1 space-y-3">
                                        {/* Header Row */}
                                        <div className="flex items-center space-x-4">
                                            <div className="flex items-center space-x-2">
                                                {getUrgencyIcon(solicitud.urgencia_medica)}
                                                <span className="font-semibold text-lg">{solicitud.numero_solicitud}</span>
                                            </div>

                                            <Badge className={getPriorityColor(solicitud.nivel_prioridad)}>
                                                Prioridad {solicitud.nivel_prioridad}
                                            </Badge>

                                            <Badge className={getStatusColor(solicitud.estado_solicitud)}>
                                                {getEstadoLegible(solicitud.estado_solicitud)}
                                            </Badge>

                                            {solicitud.es_vencida && (
                                                <Badge className="bg-red-100 text-red-800">
                                                    Vencida
                                                </Badge>
                                            )}
                                        </div>

                                        {/* Patient Info */}
                                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div className="space-y-2">
                                                <div className="flex items-center space-x-2">
                                                    <User className="h-4 w-4 text-gray-500" />
                                                    <span className="font-medium">{solicitud.paciente_nombre}</span>
                                                    <span className="text-sm text-gray-500">({solicitud.paciente_edad} años)</span>
                                                </div>

                                                <div className="flex items-center space-x-2">
                                                    <Building className="h-4 w-4 text-gray-500" />
                                                    <span className="text-sm">{solicitud.institucion_remitente}</span>
                                                </div>

                                                <div className="text-sm text-gray-600">
                                                    <strong>Especialidad:</strong> {solicitud.especialidad_solicitada}
                                                </div>
                                            </div>

                                            <div className="space-y-2">
                                                <div className="text-sm">
                                                    <strong>Diagnóstico:</strong> {solicitud.diagnostico_presuntivo}
                                                </div>

                                                <div className="flex items-center space-x-2 text-sm text-gray-500">
                                                    <Calendar className="h-4 w-4" />
                                                    <span>Recibida: {formatDate(solicitud.fecha_recepcion)}</span>
                                                </div>

                                                {solicitud.medico_evaluador && (
                                                    <div className="flex items-center space-x-2 text-sm">
                                                        <UserCheck className="h-4 w-4 text-green-500" />
                                                        <span>Asignada a: {solicitud.medico_evaluador.name}</span>
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>

                                    {/* Actions */}
                                    <div className="flex flex-col space-y-2">
                                        <Link href={`/medico/solicitudes/${solicitud.id}`}>
                                            <Button size="sm">
                                                <Eye className="h-4 w-4 mr-2" />
                                                Ver Detalle
                                            </Button>
                                        </Link>

                                        {solicitud.tiempo_respuesta_horas && (
                                            <div className="text-xs text-center text-gray-500">
                                                {solicitud.tiempo_respuesta_horas.toFixed(1)}h respuesta
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Pagination */}
                {solicitudes.meta.last_page > 1 && (
                    <div className="flex justify-center space-x-2">
                        {solicitudes.links.map((link, index) => (
                            <Button
                                key={index}
                                variant={link.active ? "default" : "outline"}
                                size="sm"
                                onClick={() => link.url && router.get(link.url)}
                                disabled={!link.url}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}

                {/* Empty State */}
                {solicitudes.data.length === 0 && (
                    <Card>
                        <CardContent className="p-12 text-center">
                            <FileText className="h-12 w-12 text-gray-400 mx-auto mb-4" />
                            <h3 className="text-lg font-medium text-gray-900 mb-2">No hay solicitudes</h3>
                            <p className="text-gray-500">
                                No se encontraron solicitudes que coincidan con los filtros seleccionados.
                            </p>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}
