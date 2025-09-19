import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Textarea } from '@/components/ui/textarea';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { 
    ArrowLeft,
    Brain, 
    Mail, 
    User,
    Calendar,
    FileText,
    CheckCircle,
    AlertTriangle,
    Clock,
    Download,
    Edit,
    Save,
    X
} from 'lucide-react';

interface EmailMedico {
    id: number;
    unique_id: string;
    subject: string;
    patient_name: string;
    patient_age: number;
    patient_gender: string;
    patient_id_number: string;
    from_name: string;
    from_email: string;
    to_email: string;
    date_sent: string;
    date_received: string;
    body_content: string;
    html_content: string;
    institution_sender: string;
    doctor_sender: string;
    specialty_requested: string;
    specialty_detected: string;
    urgency_level: string;
    medical_condition: string;
    symptoms: string;
    vital_signs: string;
    medications: string;
    medical_history: string;
    diagnosis: string;
    processing_status: string;
    validation_status: string;
    ia_confidence_score: number;
    quality_score: number;
    has_attachments: boolean;
    attachment_count: number;
    attachment_names: string[];
    imported_to_registro: boolean;
    processed_at: string;
    metadata_json: any;
    extracted_data_json: any;
    registro_medico?: {
        id: number;
        nombre: string;
        apellidos: string;
    };
}

interface Props {
    email: EmailMedico;
}

export default function EmailIADetail({ email }: Props) {
    const [isValidating, setIsValidating] = useState(false);
    const [isCreatingRegistro, setIsCreatingRegistro] = useState(false);
    const [validationStatus, setValidationStatus] = useState(email.validation_status);
    const [validationNotes, setValidationNotes] = useState('');

    const handleValidateEmail = async () => {
        setIsValidating(true);
        try {
            const response = await fetch(`/admin/ia/emails/${email.id}/validate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    validation_status: validationStatus,
                    notes: validationNotes
                })
            });

            const result = await response.json();
            
            if (result.success) {
                router.reload();
            } else {
                alert('Error validando email: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión durante la validación');
        } finally {
            setIsValidating(false);
        }
    };

    const handleCreateRegistro = async () => {
        setIsCreatingRegistro(true);
        try {
            const response = await fetch(`/admin/ia/emails/${email.id}/create-registro`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            });

            const result = await response.json();
            
            if (result.success) {
                router.reload();
            } else {
                alert('Error creando registro: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión durante la creación del registro');
        } finally {
            setIsCreatingRegistro(false);
        }
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

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleString('es-ES', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    const parseVitalSigns = (vitalSigns: string) => {
        try {
            return JSON.parse(vitalSigns);
        } catch {
            return null;
        }
    };

    const vitalSigns = parseVitalSigns(email.vital_signs || '{}');

    return (
        <AppLayout>
            <Head title={`Email: ${email.subject}`} />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-4">
                        <Link href="/admin/ia/emails">
                            <Button variant="outline" size="sm">
                                <ArrowLeft className="h-4 w-4 mr-2" />
                                Volver a Lista
                            </Button>
                        </Link>
                        <div>
                            <h1 className="text-3xl font-bold tracking-tight">Detalle del Email</h1>
                            <p className="text-muted-foreground">
                                ID: {email.unique_id}
                            </p>
                        </div>
                    </div>
                    
                    <div className="flex items-center space-x-2">
                        {email.imported_to_registro ? (
                            <Link href={`/admin/buscar-registros?search=${email.patient_name}`}>
                                <Button variant="outline">
                                    <FileText className="h-4 w-4 mr-2" />
                                    Ver Registro Médico
                                </Button>
                            </Link>
                        ) : email.validation_status === 'valid' ? (
                            <Button 
                                onClick={handleCreateRegistro}
                                disabled={isCreatingRegistro}
                            >
                                {isCreatingRegistro ? (
                                    <Clock className="h-4 w-4 mr-2 animate-spin" />
                                ) : (
                                    <FileText className="h-4 w-4 mr-2" />
                                )}
                                {isCreatingRegistro ? 'Creando...' : 'Crear Registro Médico'}
                            </Button>
                        ) : null}
                    </div>
                </div>

                {/* Status Cards */}
                <div className="grid gap-4 md:grid-cols-4">
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <Brain className="h-5 w-5 text-blue-500" />
                                <div>
                                    <p className="text-sm font-medium">Confianza IA</p>
                                    <p className="text-2xl font-bold">
                                        {Math.round((email.ia_confidence_score || 0) * 100)}%
                                    </p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm font-medium">Estado</p>
                                    <Badge className={getStatusColor(email.processing_status)}>
                                        {email.processing_status}
                                    </Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm font-medium">Validación</p>
                                    <Badge className={getValidationColor(email.validation_status)}>
                                        {email.validation_status}
                                    </Badge>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center justify-between">
                                <div>
                                    <p className="text-sm font-medium">Urgencia</p>
                                    {email.urgency_level ? (
                                        <Badge className={getUrgencyColor(email.urgency_level)}>
                                            {email.urgency_level}
                                        </Badge>
                                    ) : (
                                        <span className="text-sm text-muted-foreground">No definida</span>
                                    )}
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Main Content */}
                <div className="grid gap-6 lg:grid-cols-2">
                    {/* Email Information */}
                    <div className="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <Mail className="h-5 w-5 mr-2" />
                                    Información del Email
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div>
                                    <label className="text-sm font-medium">Asunto</label>
                                    <p className="text-sm text-muted-foreground">{email.subject}</p>
                                </div>
                                
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">De</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.from_name || email.from_email}
                                        </p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Para</label>
                                        <p className="text-sm text-muted-foreground">{email.to_email}</p>
                                    </div>
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Enviado</label>
                                        <p className="text-sm text-muted-foreground">
                                            {formatDate(email.date_sent)}
                                        </p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Procesado</label>
                                        <p className="text-sm text-muted-foreground">
                                            {formatDate(email.processed_at)}
                                        </p>
                                    </div>
                                </div>

                                {email.has_attachments && (
                                    <div>
                                        <label className="text-sm font-medium">Adjuntos</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.attachment_count} archivo(s)
                                        </p>
                                        {email.attachment_names && email.attachment_names.length > 0 && (
                                            <ul className="text-xs text-muted-foreground mt-1">
                                                {email.attachment_names.map((name, index) => (
                                                    <li key={index}>• {name}</li>
                                                ))}
                                            </ul>
                                        )}
                                    </div>
                                )}
                            </CardContent>
                        </Card>

                        {/* Patient Information */}
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <User className="h-5 w-5 mr-2" />
                                    Información del Paciente
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Nombre</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.patient_name || 'No extraído'}
                                        </p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Edad</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.patient_age ? `${email.patient_age} años` : 'No extraída'}
                                        </p>
                                    </div>
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Género</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.patient_gender || 'No extraído'}
                                        </p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Identificación</label>
                                        <p className="text-sm text-muted-foreground">
                                            {email.patient_id_number || 'No extraída'}
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Institución Remitente</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.institution_sender || 'No extraída'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Doctor Remitente</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.doctor_sender || 'No extraído'}
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Medical Information */}
                    <div className="space-y-6">
                        <Card>
                            <CardHeader>
                                <CardTitle>Información Médica</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div>
                                    <label className="text-sm font-medium">Especialidad Solicitada</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.specialty_requested || email.specialty_detected || 'No detectada'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Condición Médica</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.medical_condition || 'No extraída'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Síntomas</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.symptoms || 'No extraídos'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Diagnóstico</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.diagnosis || 'No extraído'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Medicamentos</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.medications || 'No extraídos'}
                                    </p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Antecedentes</label>
                                    <p className="text-sm text-muted-foreground">
                                        {email.medical_history || 'No extraídos'}
                                    </p>
                                </div>

                                {vitalSigns && Object.keys(vitalSigns).length > 0 && (
                                    <div>
                                        <label className="text-sm font-medium">Signos Vitales</label>
                                        <div className="grid grid-cols-2 gap-2 mt-2">
                                            {vitalSigns.heart_rate && (
                                                <div className="text-xs">
                                                    <span className="font-medium">FC:</span> {vitalSigns.heart_rate} bpm
                                                </div>
                                            )}
                                            {vitalSigns.temperature && (
                                                <div className="text-xs">
                                                    <span className="font-medium">Temp:</span> {vitalSigns.temperature}°C
                                                </div>
                                            )}
                                            {vitalSigns.systolic_bp && vitalSigns.diastolic_bp && (
                                                <div className="text-xs">
                                                    <span className="font-medium">PA:</span> {vitalSigns.systolic_bp}/{vitalSigns.diastolic_bp}
                                                </div>
                                            )}
                                            {vitalSigns.oxygen_saturation && (
                                                <div className="text-xs">
                                                    <span className="font-medium">SpO2:</span> {vitalSigns.oxygen_saturation}%
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                )}
                            </CardContent>
                        </Card>

                        {/* Validation Section */}
                        {!email.imported_to_registro && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Validación del Email</CardTitle>
                                    <CardDescription>
                                        Validar si este email contiene información médica válida
                                    </CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div>
                                        <label className="text-sm font-medium">Estado de Validación</label>
                                        <Select value={validationStatus} onValueChange={setValidationStatus}>
                                            <SelectTrigger className="mt-1">
                                                <SelectValue />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectItem value="pending">Pendiente</SelectItem>
                                                <SelectItem value="valid">Válido</SelectItem>
                                                <SelectItem value="invalid">Inválido</SelectItem>
                                                <SelectItem value="needs_review">Requiere Revisión</SelectItem>
                                            </SelectContent>
                                        </Select>
                                    </div>

                                    <div>
                                        <label className="text-sm font-medium">Notas de Validación</label>
                                        <Textarea
                                            value={validationNotes}
                                            onChange={(e) => setValidationNotes(e.target.value)}
                                            placeholder="Agregar notas sobre la validación..."
                                            className="mt-1"
                                        />
                                    </div>

                                    <Button 
                                        onClick={handleValidateEmail}
                                        disabled={isValidating}
                                        className="w-full"
                                    >
                                        {isValidating ? (
                                            <Clock className="h-4 w-4 mr-2 animate-spin" />
                                        ) : (
                                            <Save className="h-4 w-4 mr-2" />
                                        )}
                                        {isValidating ? 'Validando...' : 'Guardar Validación'}
                                    </Button>
                                </CardContent>
                            </Card>
                        )}
                    </div>
                </div>

                {/* Email Content */}
                <Card>
                    <CardHeader>
                        <CardTitle>Contenido del Email</CardTitle>
                    </CardHeader>
                    <CardContent>
                        <div className="bg-gray-50 p-4 rounded-lg">
                            <pre className="whitespace-pre-wrap text-sm">
                                {email.body_content || 'No hay contenido disponible'}
                            </pre>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
