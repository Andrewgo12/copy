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
    User,
    Building,
    Calendar,
    FileText,
    Heart,
    AlertTriangle,
    CheckCircle,
    X,
    MessageSquare,
    Clock,
    Phone,
    Mail,
    MapPin,
    Stethoscope,
    Pill,
    Activity
} from 'lucide-react';

interface SolicitudReferencia {
    id: number;
    numero_solicitud: string;
    paciente_nombre: string;
    paciente_edad: number;
    paciente_genero: string;
    paciente_identificacion: string;
    paciente_telefono: string;
    paciente_direccion: string;
    diagnostico_presuntivo: string;
    motivo_referencia: string;
    sintomas_actuales: string;
    antecedentes_medicos: string;
    medicamentos_actuales: string;
    signos_vitales: any;
    examenes_realizados: string;
    institucion_remitente: string;
    medico_remitente: string;
    telefono_remitente: string;
    email_remitente: string;
    especialidad_solicitada: string;
    servicio_solicitado: string;
    fecha_solicitud: string;
    nivel_prioridad: string;
    clasificacion_triage: string;
    estado_solicitud: string;
    urgencia_medica: string;
    decision_final: string;
    motivo_decision: string;
    observaciones_medico: string;
    fecha_decision: string;
    fecha_recepcion: string;
    tiempo_respuesta_horas: number;
    procesado_por_ia: boolean;
    confianza_ia: number;
    tiene_adjuntos: boolean;
    nombres_adjuntos: string[];
    historial_cambios: any[];
    medico_evaluador?: {
        id: number;
        name: string;
    };
    email_medico?: {
        id: number;
        unique_id: string;
        subject: string;
    };
}

interface Props {
    solicitud: SolicitudReferencia;
    canEdit: boolean;
    canDecide: boolean;
}

export default function DetalleCaso({ solicitud, canEdit, canDecide }: Props) {
    const [isProcessing, setIsProcessing] = useState(false);
    const [decision, setDecision] = useState('');
    const [motivo, setMotivo] = useState('');
    const [observaciones, setObservaciones] = useState('');
    const [prioridad, setPrioridad] = useState(solicitud.nivel_prioridad);
    const [informacionAdicional, setInformacionAdicional] = useState('');
    const [showDecisionForm, setShowDecisionForm] = useState(false);
    const [showInfoForm, setShowInfoForm] = useState(false);

    const handleDecision = async () => {
        if (!decision || !motivo.trim()) {
            alert('Por favor complete todos los campos requeridos');
            return;
        }

        setIsProcessing(true);
        try {
            const response = await fetch(`/medico/solicitudes/${solicitud.id}/decision`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    decision,
                    motivo,
                    observaciones,
                    prioridad
                })
            });

            const result = await response.json();
            
            if (result.success) {
                router.reload();
            } else {
                alert('Error al procesar decisión: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión al procesar la decisión');
        } finally {
            setIsProcessing(false);
        }
    };

    const handleSolicitarInfo = async () => {
        if (!informacionAdicional.trim()) {
            alert('Por favor especifique qué información adicional necesita');
            return;
        }

        setIsProcessing(true);
        try {
            const response = await fetch(`/medico/solicitudes/${solicitud.id}/solicitar-informacion`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    informacion: informacionAdicional
                })
            });

            const result = await response.json();
            
            if (result.success) {
                router.reload();
            } else {
                alert('Error al solicitar información: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión al solicitar información');
        } finally {
            setIsProcessing(false);
        }
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

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleString('es-ES', {
            year: 'numeric',
            month: 'long',
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
            'pendiente_info': 'Pendiente Información'
        };
        return estados[estado] || estado;
    };

    return (
        <AppLayout>
            <Head title={`Caso: ${solicitud.numero_solicitud}`} />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div className="flex items-center space-x-4">
                        <Link href="/medico/bandeja-casos">
                            <Button variant="outline" size="sm">
                                <ArrowLeft className="h-4 w-4 mr-2" />
                                Volver a Bandeja
                            </Button>
                        </Link>
                        <div>
                            <h1 className="text-3xl font-bold tracking-tight">
                                Caso: {solicitud.numero_solicitud}
                            </h1>
                            <p className="text-muted-foreground">
                                Solicitud de referencia médica
                            </p>
                        </div>
                    </div>
                    
                    <div className="flex items-center space-x-2">
                        <Badge className={getPriorityColor(solicitud.nivel_prioridad)}>
                            Prioridad {solicitud.nivel_prioridad}
                        </Badge>
                        <Badge className={getStatusColor(solicitud.estado_solicitud)}>
                            {getEstadoLegible(solicitud.estado_solicitud)}
                        </Badge>
                        {solicitud.urgencia_medica !== 'normal' && (
                            <Badge className="bg-red-100 text-red-800">
                                {solicitud.urgencia_medica}
                            </Badge>
                        )}
                    </div>
                </div>

                {/* Main Content */}
                <div className="grid gap-6 lg:grid-cols-3">
                    {/* Left Column - Patient & Medical Info */}
                    <div className="lg:col-span-2 space-y-6">
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
                                        <label className="text-sm font-medium">Nombre Completo</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.paciente_nombre}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Edad</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.paciente_edad} años</p>
                                    </div>
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Género</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.paciente_genero}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Identificación</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.paciente_identificacion}</p>
                                    </div>
                                </div>

                                {solicitud.paciente_telefono && (
                                    <div className="flex items-center space-x-2">
                                        <Phone className="h-4 w-4 text-gray-500" />
                                        <span className="text-sm">{solicitud.paciente_telefono}</span>
                                    </div>
                                )}

                                {solicitud.paciente_direccion && (
                                    <div className="flex items-center space-x-2">
                                        <MapPin className="h-4 w-4 text-gray-500" />
                                        <span className="text-sm">{solicitud.paciente_direccion}</span>
                                    </div>
                                )}
                            </CardContent>
                        </Card>

                        {/* Medical Information */}
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <Stethoscope className="h-5 w-5 mr-2" />
                                    Información Médica
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div>
                                    <label className="text-sm font-medium">Diagnóstico Presuntivo</label>
                                    <p className="text-sm text-muted-foreground">{solicitud.diagnostico_presuntivo}</p>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Motivo de Referencia</label>
                                    <p className="text-sm text-muted-foreground">{solicitud.motivo_referencia}</p>
                                </div>

                                {solicitud.sintomas_actuales && (
                                    <div>
                                        <label className="text-sm font-medium">Síntomas Actuales</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.sintomas_actuales}</p>
                                    </div>
                                )}

                                {solicitud.antecedentes_medicos && (
                                    <div>
                                        <label className="text-sm font-medium">Antecedentes Médicos</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.antecedentes_medicos}</p>
                                    </div>
                                )}

                                {solicitud.medicamentos_actuales && (
                                    <div className="flex items-start space-x-2">
                                        <Pill className="h-4 w-4 text-gray-500 mt-1" />
                                        <div>
                                            <label className="text-sm font-medium">Medicamentos Actuales</label>
                                            <p className="text-sm text-muted-foreground">{solicitud.medicamentos_actuales}</p>
                                        </div>
                                    </div>
                                )}

                                {solicitud.signos_vitales && Object.keys(solicitud.signos_vitales).length > 0 && (
                                    <div>
                                        <label className="text-sm font-medium flex items-center">
                                            <Activity className="h-4 w-4 mr-2" />
                                            Signos Vitales
                                        </label>
                                        <div className="grid grid-cols-2 gap-2 mt-2">
                                            {solicitud.signos_vitales.heart_rate && (
                                                <div className="text-sm">
                                                    <span className="font-medium">FC:</span> {solicitud.signos_vitales.heart_rate} bpm
                                                </div>
                                            )}
                                            {solicitud.signos_vitales.temperature && (
                                                <div className="text-sm">
                                                    <span className="font-medium">Temp:</span> {solicitud.signos_vitales.temperature}°C
                                                </div>
                                            )}
                                            {solicitud.signos_vitales.systolic_bp && solicitud.signos_vitales.diastolic_bp && (
                                                <div className="text-sm">
                                                    <span className="font-medium">PA:</span> {solicitud.signos_vitales.systolic_bp}/{solicitud.signos_vitales.diastolic_bp}
                                                </div>
                                            )}
                                            {solicitud.signos_vitales.oxygen_saturation && (
                                                <div className="text-sm">
                                                    <span className="font-medium">SpO2:</span> {solicitud.signos_vitales.oxygen_saturation}%
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                )}

                                {solicitud.examenes_realizados && (
                                    <div>
                                        <label className="text-sm font-medium">Exámenes Realizados</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.examenes_realizados}</p>
                                    </div>
                                )}
                            </CardContent>
                        </Card>

                        {/* Referral Information */}
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center">
                                    <Building className="h-5 w-5 mr-2" />
                                    Información de Remisión
                                </CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Institución Remitente</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.institucion_remitente}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Médico Remitente</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.medico_remitente}</p>
                                    </div>
                                </div>

                                <div className="grid grid-cols-2 gap-4">
                                    <div>
                                        <label className="text-sm font-medium">Especialidad Solicitada</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.especialidad_solicitada}</p>
                                    </div>
                                    <div>
                                        <label className="text-sm font-medium">Servicio Solicitado</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.servicio_solicitado}</p>
                                    </div>
                                </div>

                                {solicitud.telefono_remitente && (
                                    <div className="flex items-center space-x-2">
                                        <Phone className="h-4 w-4 text-gray-500" />
                                        <span className="text-sm">{solicitud.telefono_remitente}</span>
                                    </div>
                                )}

                                {solicitud.email_remitente && (
                                    <div className="flex items-center space-x-2">
                                        <Mail className="h-4 w-4 text-gray-500" />
                                        <span className="text-sm">{solicitud.email_remitente}</span>
                                    </div>
                                )}

                                <div className="flex items-center space-x-2">
                                    <Calendar className="h-4 w-4 text-gray-500" />
                                    <span className="text-sm">Fecha de solicitud: {formatDate(solicitud.fecha_solicitud)}</span>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    {/* Right Column - Actions & Status */}
                    <div className="space-y-6">
                        {/* Status Card */}
                        <Card>
                            <CardHeader>
                                <CardTitle>Estado de la Solicitud</CardTitle>
                            </CardHeader>
                            <CardContent className="space-y-4">
                                <div>
                                    <label className="text-sm font-medium">Estado Actual</label>
                                    <Badge className={getStatusColor(solicitud.estado_solicitud)}>
                                        {getEstadoLegible(solicitud.estado_solicitud)}
                                    </Badge>
                                </div>

                                <div>
                                    <label className="text-sm font-medium">Fecha de Recepción</label>
                                    <p className="text-sm text-muted-foreground">{formatDate(solicitud.fecha_recepcion)}</p>
                                </div>

                                {solicitud.medico_evaluador && (
                                    <div>
                                        <label className="text-sm font-medium">Médico Evaluador</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.medico_evaluador.name}</p>
                                    </div>
                                )}

                                {solicitud.tiempo_respuesta_horas && (
                                    <div>
                                        <label className="text-sm font-medium">Tiempo de Respuesta</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.tiempo_respuesta_horas.toFixed(1)} horas</p>
                                    </div>
                                )}

                                {solicitud.procesado_por_ia && (
                                    <div>
                                        <label className="text-sm font-medium">Procesado por IA</label>
                                        <p className="text-sm text-muted-foreground">
                                            Confianza: {Math.round((solicitud.confianza_ia || 0) * 100)}%
                                        </p>
                                    </div>
                                )}
                            </CardContent>
                        </Card>

                        {/* Decision Actions */}
                        {canDecide && solicitud.estado_solicitud !== 'aceptada' && solicitud.estado_solicitud !== 'rechazada' && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Tomar Decisión</CardTitle>
                                    <CardDescription>
                                        Evalúe la solicitud y tome una decisión médica
                                    </CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    {!showDecisionForm ? (
                                        <div className="space-y-2">
                                            <Button 
                                                onClick={() => setShowDecisionForm(true)}
                                                className="w-full"
                                            >
                                                <CheckCircle className="h-4 w-4 mr-2" />
                                                Evaluar Solicitud
                                            </Button>
                                            
                                            <Button 
                                                variant="outline"
                                                onClick={() => setShowInfoForm(true)}
                                                className="w-full"
                                            >
                                                <MessageSquare className="h-4 w-4 mr-2" />
                                                Solicitar Información
                                            </Button>
                                        </div>
                                    ) : (
                                        <div className="space-y-4">
                                            <div>
                                                <label className="text-sm font-medium">Prioridad</label>
                                                <Select value={prioridad} onValueChange={setPrioridad}>
                                                    <SelectTrigger>
                                                        <SelectValue />
                                                    </SelectTrigger>
                                                    <SelectContent>
                                                        <SelectItem value="alta">Alta</SelectItem>
                                                        <SelectItem value="media">Media</SelectItem>
                                                        <SelectItem value="baja">Baja</SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </div>

                                            <div>
                                                <label className="text-sm font-medium">Decisión</label>
                                                <Select value={decision} onValueChange={setDecision}>
                                                    <SelectTrigger>
                                                        <SelectValue placeholder="Seleccione una decisión" />
                                                    </SelectTrigger>
                                                    <SelectContent>
                                                        <SelectItem value="aceptada">Aceptar Traslado</SelectItem>
                                                        <SelectItem value="rechazada">Rechazar Solicitud</SelectItem>
                                                    </SelectContent>
                                                </Select>
                                            </div>

                                            <div>
                                                <label className="text-sm font-medium">Motivo de la Decisión *</label>
                                                <Textarea
                                                    value={motivo}
                                                    onChange={(e) => setMotivo(e.target.value)}
                                                    placeholder="Explique el motivo de su decisión..."
                                                    className="mt-1"
                                                />
                                            </div>

                                            <div>
                                                <label className="text-sm font-medium">Observaciones Adicionales</label>
                                                <Textarea
                                                    value={observaciones}
                                                    onChange={(e) => setObservaciones(e.target.value)}
                                                    placeholder="Observaciones adicionales (opcional)..."
                                                    className="mt-1"
                                                />
                                            </div>

                                            <div className="flex space-x-2">
                                                <Button 
                                                    onClick={handleDecision}
                                                    disabled={isProcessing || !decision || !motivo.trim()}
                                                    className="flex-1"
                                                >
                                                    {isProcessing ? (
                                                        <Clock className="h-4 w-4 mr-2 animate-spin" />
                                                    ) : (
                                                        <CheckCircle className="h-4 w-4 mr-2" />
                                                    )}
                                                    {isProcessing ? 'Procesando...' : 'Confirmar Decisión'}
                                                </Button>
                                                
                                                <Button 
                                                    variant="outline"
                                                    onClick={() => setShowDecisionForm(false)}
                                                    disabled={isProcessing}
                                                >
                                                    <X className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </div>
                                    )}

                                    {/* Information Request Form */}
                                    {showInfoForm && (
                                        <div className="space-y-4 border-t pt-4">
                                            <div>
                                                <label className="text-sm font-medium">Información Adicional Requerida</label>
                                                <Textarea
                                                    value={informacionAdicional}
                                                    onChange={(e) => setInformacionAdicional(e.target.value)}
                                                    placeholder="Especifique qué información adicional necesita..."
                                                    className="mt-1"
                                                />
                                            </div>

                                            <div className="flex space-x-2">
                                                <Button 
                                                    onClick={handleSolicitarInfo}
                                                    disabled={isProcessing || !informacionAdicional.trim()}
                                                    className="flex-1"
                                                >
                                                    {isProcessing ? (
                                                        <Clock className="h-4 w-4 mr-2 animate-spin" />
                                                    ) : (
                                                        <MessageSquare className="h-4 w-4 mr-2" />
                                                    )}
                                                    {isProcessing ? 'Enviando...' : 'Solicitar Información'}
                                                </Button>
                                                
                                                <Button 
                                                    variant="outline"
                                                    onClick={() => setShowInfoForm(false)}
                                                    disabled={isProcessing}
                                                >
                                                    <X className="h-4 w-4" />
                                                </Button>
                                            </div>
                                        </div>
                                    )}
                                </CardContent>
                            </Card>
                        )}

                        {/* Decision Result */}
                        {solicitud.decision_final !== 'pendiente' && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Decisión Tomada</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-4">
                                    <div>
                                        <label className="text-sm font-medium">Decisión Final</label>
                                        <Badge className={solicitud.decision_final === 'aceptada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}>
                                            {solicitud.decision_final === 'aceptada' ? 'Aceptada' : 'Rechazada'}
                                        </Badge>
                                    </div>

                                    <div>
                                        <label className="text-sm font-medium">Motivo</label>
                                        <p className="text-sm text-muted-foreground">{solicitud.motivo_decision}</p>
                                    </div>

                                    {solicitud.observaciones_medico && (
                                        <div>
                                            <label className="text-sm font-medium">Observaciones</label>
                                            <p className="text-sm text-muted-foreground">{solicitud.observaciones_medico}</p>
                                        </div>
                                    )}

                                    <div>
                                        <label className="text-sm font-medium">Fecha de Decisión</label>
                                        <p className="text-sm text-muted-foreground">{formatDate(solicitud.fecha_decision)}</p>
                                    </div>
                                </CardContent>
                            </Card>
                        )}

                        {/* Attachments */}
                        {solicitud.tiene_adjuntos && solicitud.nombres_adjuntos && solicitud.nombres_adjuntos.length > 0 && (
                            <Card>
                                <CardHeader>
                                    <CardTitle className="flex items-center">
                                        <FileText className="h-5 w-5 mr-2" />
                                        Archivos Adjuntos
                                    </CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2">
                                        {solicitud.nombres_adjuntos.map((nombre, index) => (
                                            <li key={index} className="flex items-center space-x-2">
                                                <FileText className="h-4 w-4 text-gray-500" />
                                                <span className="text-sm">{nombre}</span>
                                            </li>
                                        ))}
                                    </ul>
                                </CardContent>
                            </Card>
                        )}

                        {/* Email Source */}
                        {solicitud.email_medico && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Email de Origen</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <Link href={`/admin/ia/emails/${solicitud.email_medico.id}`}>
                                        <Button variant="outline" size="sm" className="w-full">
                                            <Mail className="h-4 w-4 mr-2" />
                                            Ver Email Original
                                        </Button>
                                    </Link>
                                </CardContent>
                            </Card>
                        )}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
