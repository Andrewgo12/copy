import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Input } from '@/components/ui/input';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { 
    Brain, 
    Mail, 
    AlertTriangle, 
    CheckCircle, 
    Clock, 
    Search,
    Filter,
    Eye,
    FileText,
    User,
    Calendar,
    ArrowLeft
} from 'lucide-react';

interface EmailMedico {
    id: number;
    unique_id: string;
    subject: string;
    patient_name: string;
    from_name: string;
    from_email: string;
    urgency_level: string;
    specialty_detected: string;
    processing_status: string;
    validation_status: string;
    ia_confidence_score: number;
    date_sent: string;
    imported_to_registro: boolean;
    registro_medico?: {
        id: number;
        nombre: string;
        apellidos: string;
    };
}

interface PaginatedEmails {
    data: EmailMedico[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number;
    to: number;
}

interface Filters {
    status?: string;
    urgency?: string;
    specialty?: string;
    imported?: string;
    search?: string;
}

interface Props {
    emails: PaginatedEmails;
    filters: Filters;
}

export default function EmailsIA({ emails, filters }: Props) {
    const [searchTerm, setSearchTerm] = useState(filters.search || '');
    const [selectedStatus, setSelectedStatus] = useState(filters.status || '');
    const [selectedUrgency, setSelectedUrgency] = useState(filters.urgency || '');
    const [selectedSpecialty, setSelectedSpecialty] = useState(filters.specialty || '');
    const [selectedImported, setSelectedImported] = useState(filters.imported || '');

    const handleSearch = () => {
        router.get('/admin/ia/emails', {
            search: searchTerm,
            status: selectedStatus,
            urgency: selectedUrgency,
            specialty: selectedSpecialty,
            imported: selectedImported,
        }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const clearFilters = () => {
        setSearchTerm('');
        setSelectedStatus('');
        setSelectedUrgency('');
        setSelectedSpecialty('');
        setSelectedImported('');
        router.get('/admin/ia/emails');
    };

    const getUrgencyColor = (urgency: string) => {
        switch (urgency?.toLowerCase()) {
            case 'urgente':
            case 'crítica':
                return 'bg-red-100 text-red-800';
            case 'alta':
                return 'bg-orange-100 text-orange-800';
            case 'media':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-green-100 text-green-800';
        }
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'imported':
                return 'bg-green-100 text-green-800';
            case 'validated':
                return 'bg-blue-100 text-blue-800';
            case 'extracted':
                return 'bg-yellow-100 text-yellow-800';
            case 'pending':
                return 'bg-gray-100 text-gray-800';
            case 'error':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getValidationColor = (status: string) => {
        switch (status) {
            case 'valid':
                return 'bg-green-100 text-green-800';
            case 'invalid':
                return 'bg-red-100 text-red-800';
            case 'needs_review':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    return (
        <AppLayout>
            <Head title="Emails Procesados por IA" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-4">
                        <Link href="/admin/ia/dashboard">
                            <Button variant="outline" size="sm">
                                <ArrowLeft className="h-4 w-4 mr-2" />
                                Dashboard IA
                            </Button>
                        </Link>
                        <div>
                            <h1 className="text-3xl font-bold tracking-tight">Emails Procesados por IA</h1>
                            <p className="text-muted-foreground">
                                {emails.total} emails encontrados
                            </p>
                        </div>
                    </div>
                </div>

                {/* Filters */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            <Filter className="h-5 w-5 mr-2" />
                            Filtros
                        </CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-6">
                            <div className="lg:col-span-2">
                                <Input
                                    placeholder="Buscar por paciente, asunto, doctor..."
                                    value={searchTerm}
                                    onChange={(e) => setSearchTerm(e.target.value)}
                                    onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
                                />
                            </div>
                            
                            <Select value={selectedStatus} onValueChange={setSelectedStatus}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Estado" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todos los estados</SelectItem>
                                    <SelectItem value="pending">Pendiente</SelectItem>
                                    <SelectItem value="extracted">Extraído</SelectItem>
                                    <SelectItem value="validated">Validado</SelectItem>
                                    <SelectItem value="imported">Importado</SelectItem>
                                    <SelectItem value="error">Error</SelectItem>
                                </SelectContent>
                            </Select>

                            <Select value={selectedUrgency} onValueChange={setSelectedUrgency}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Urgencia" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todas las urgencias</SelectItem>
                                    <SelectItem value="urgente">Urgente</SelectItem>
                                    <SelectItem value="alta">Alta</SelectItem>
                                    <SelectItem value="media">Media</SelectItem>
                                    <SelectItem value="baja">Baja</SelectItem>
                                </SelectContent>
                            </Select>

                            <Select value={selectedSpecialty} onValueChange={setSelectedSpecialty}>
                                <SelectTrigger>
                                    <SelectValue placeholder="Especialidad" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="">Todas las especialidades</SelectItem>
                                    <SelectItem value="cardiología">Cardiología</SelectItem>
                                    <SelectItem value="neurología">Neurología</SelectItem>
                                    <SelectItem value="ginecología">Ginecología</SelectItem>
                                    <SelectItem value="ortopedia">Ortopedia</SelectItem>
                                    <SelectItem value="pediatría">Pediatría</SelectItem>
                                </SelectContent>
                            </Select>

                            <div className="flex space-x-2">
                                <Button onClick={handleSearch} className="flex-1">
                                    <Search className="h-4 w-4 mr-2" />
                                    Buscar
                                </Button>
                                <Button onClick={clearFilters} variant="outline">
                                    Limpiar
                                </Button>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Email List */}
                <div className="space-y-4">
                    {emails.data.map((email) => (
                        <Card key={email.id} className="hover:shadow-md transition-shadow">
                            <CardContent className="p-6">
                                <div className="flex items-start justify-between">
                                    <div className="flex-1 space-y-2">
                                        <div className="flex items-center space-x-3">
                                            <h3 className="font-semibold text-lg">
                                                {email.patient_name || 'Sin nombre de paciente'}
                                            </h3>
                                            {email.imported_to_registro && (
                                                <CheckCircle className="h-5 w-5 text-green-500" />
                                            )}
                                        </div>
                                        
                                        <p className="text-sm text-muted-foreground line-clamp-2">
                                            {email.subject}
                                        </p>
                                        
                                        <div className="flex items-center space-x-4 text-sm text-muted-foreground">
                                            <div className="flex items-center">
                                                <User className="h-4 w-4 mr-1" />
                                                {email.from_name || email.from_email}
                                            </div>
                                            <div className="flex items-center">
                                                <Calendar className="h-4 w-4 mr-1" />
                                                {new Date(email.date_sent).toLocaleDateString()}
                                            </div>
                                            {email.ia_confidence_score && (
                                                <div className="flex items-center">
                                                    <Brain className="h-4 w-4 mr-1" />
                                                    {Math.round(email.ia_confidence_score * 100)}% confianza
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                    
                                    <div className="flex flex-col items-end space-y-2">
                                        <div className="flex space-x-2">
                                            {email.urgency_level && (
                                                <Badge className={getUrgencyColor(email.urgency_level)}>
                                                    {email.urgency_level}
                                                </Badge>
                                            )}
                                            <Badge className={getStatusColor(email.processing_status)}>
                                                {email.processing_status}
                                            </Badge>
                                            <Badge className={getValidationColor(email.validation_status)}>
                                                {email.validation_status}
                                            </Badge>
                                        </div>
                                        
                                        {email.specialty_detected && (
                                            <Badge variant="outline">
                                                {email.specialty_detected}
                                            </Badge>
                                        )}
                                        
                                        <Link href={`/admin/ia/emails/${email.id}`}>
                                            <Button size="sm" variant="outline">
                                                <Eye className="h-4 w-4 mr-2" />
                                                Ver Detalles
                                            </Button>
                                        </Link>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    ))}
                </div>

                {/* Pagination */}
                {emails.last_page > 1 && (
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center justify-between">
                                <div className="text-sm text-muted-foreground">
                                    Mostrando {emails.from} a {emails.to} de {emails.total} emails
                                </div>
                                <div className="flex space-x-2">
                                    {emails.current_page > 1 && (
                                        <Link 
                                            href={`/admin/ia/emails?page=${emails.current_page - 1}`}
                                            preserveState
                                        >
                                            <Button variant="outline" size="sm">
                                                Anterior
                                            </Button>
                                        </Link>
                                    )}
                                    
                                    <span className="flex items-center px-3 py-1 text-sm">
                                        Página {emails.current_page} de {emails.last_page}
                                    </span>
                                    
                                    {emails.current_page < emails.last_page && (
                                        <Link 
                                            href={`/admin/ia/emails?page=${emails.current_page + 1}`}
                                            preserveState
                                        >
                                            <Button variant="outline" size="sm">
                                                Siguiente
                                            </Button>
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Empty State */}
                {emails.data.length === 0 && (
                    <Card>
                        <CardContent className="p-12 text-center">
                            <Mail className="h-12 w-12 mx-auto text-muted-foreground mb-4" />
                            <h3 className="text-lg font-semibold mb-2">No se encontraron emails</h3>
                            <p className="text-muted-foreground mb-4">
                                No hay emails que coincidan con los filtros seleccionados.
                            </p>
                            <Button onClick={clearFilters} variant="outline">
                                Limpiar filtros
                            </Button>
                        </CardContent>
                    </Card>
                )}
            </div>
        </AppLayout>
    );
}
