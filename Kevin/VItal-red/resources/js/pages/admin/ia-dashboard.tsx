import { Head } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { Progress } from '@/components/ui/progress';
import { Link } from '@inertiajs/react';
import {
    Brain,
    Mail,
    AlertTriangle,
    CheckCircle,
    Clock,
    Download,
    RefreshCw,
    Activity,
    Users,
    FileText,
    TrendingUp
} from 'lucide-react';
import { router } from '@inertiajs/react';

interface Stats {
    total_emails: number;
    medical_emails: number;
    pending_import: number;
    urgent_emails: number;
    by_specialty: Record<string, number>;
    by_status: Record<string, number>;
}

interface EmailMedico {
    id: number;
    unique_id: string;
    subject: string;
    patient_name: string;
    urgency_level: string;
    specialty_detected: string;
    processing_status: string;
    ia_confidence_score: number;
    date_sent: string;
    imported_to_registro: boolean;
}

interface Props {
    stats: Stats;
    recentEmails: EmailMedico[];
    urgentEmails: EmailMedico[];
}

export default function IADashboard({ stats, recentEmails, urgentEmails }: Props) {
    const [isImporting, setIsImporting] = useState(false);
    const [isProcessing, setIsProcessing] = useState(false);
    const [lastUpdate, setLastUpdate] = useState(new Date());

    const handleAutoImport = async () => {
        setIsImporting(true);
        try {
            const response = await fetch('/admin/ia/auto-import', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            });

            const result = await response.json();

            if (result.success) {
                // Recargar la página para mostrar datos actualizados
                router.reload();
            } else {
                alert('Error en la importación: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión durante la importación');
        } finally {
            setIsImporting(false);
        }
    };

    const handleProcessPending = async () => {
        setIsProcessing(true);
        try {
            const response = await fetch('/admin/ia/process-pending', {
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
                alert('Error en el procesamiento: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error de conexión durante el procesamiento');
        } finally {
            setIsProcessing(false);
        }
    };

    const getUrgencyColor = (urgency: string) => {
        switch (urgency?.toLowerCase()) {
            case 'urgente':
            case 'crítica':
                return 'bg-red-500';
            case 'alta':
                return 'bg-orange-500';
            case 'media':
                return 'bg-yellow-500';
            default:
                return 'bg-green-500';
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

    const importProgress = stats.total_emails > 0 ?
        ((stats.total_emails - stats.pending_import) / stats.total_emails) * 100 : 0;

    return (
        <AppLayout>
            <Head title="Dashboard de IA" />

            <div className="space-y-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight">Dashboard de IA</h1>
                        <p className="text-muted-foreground">
                            Monitoreo del sistema de procesamiento de emails médicos
                        </p>
                    </div>
                    <div className="flex items-center space-x-2">
                        <Button
                            onClick={handleAutoImport}
                            disabled={isImporting}
                            variant="outline"
                        >
                            {isImporting ? (
                                <RefreshCw className="h-4 w-4 mr-2 animate-spin" />
                            ) : (
                                <Download className="h-4 w-4 mr-2" />
                            )}
                            {isImporting ? 'Importando...' : 'Importar Emails'}
                        </Button>
                        <Button
                            onClick={handleProcessPending}
                            disabled={isProcessing || stats.pending_import === 0}
                        >
                            {isProcessing ? (
                                <RefreshCw className="h-4 w-4 mr-2 animate-spin" />
                            ) : (
                                <Activity className="h-4 w-4 mr-2" />
                            )}
                            {isProcessing ? 'Procesando...' : 'Procesar Pendientes'}
                        </Button>
                        <Link href="/admin/ia/emails">
                            <Button variant="outline">
                                <FileText className="h-4 w-4 mr-2" />
                                Ver Todos los Emails
                            </Button>
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Emails</CardTitle>
                            <Mail className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.total_emails}</div>
                            <p className="text-xs text-muted-foreground">
                                Emails procesados por IA
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Emails Médicos</CardTitle>
                            <Brain className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.medical_emails}</div>
                            <p className="text-xs text-muted-foreground">
                                Validados como médicos
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Pendientes</CardTitle>
                            <Clock className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.pending_import}</div>
                            <p className="text-xs text-muted-foreground">
                                Por importar a registros
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Urgentes</CardTitle>
                            <AlertTriangle className="h-4 w-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-red-600">{stats.urgent_emails}</div>
                            <p className="text-xs text-muted-foreground">
                                Requieren atención inmediata
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Progress and Charts */}
                <div className="grid gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Progreso de Importación</CardTitle>
                            <CardDescription>
                                Emails procesados vs pendientes de importar
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2">
                                <div className="flex justify-between text-sm">
                                    <span>Importados</span>
                                    <span>{Math.round(importProgress)}%</span>
                                </div>
                                <Progress value={importProgress} className="h-2" />
                                <div className="flex justify-between text-xs text-muted-foreground">
                                    <span>{stats.total_emails - stats.pending_import} importados</span>
                                    <span>{stats.pending_import} pendientes</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>Distribución por Especialidad</CardTitle>
                            <CardDescription>
                                Emails médicos por especialidad detectada
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-2">
                                {Object.entries(stats.by_specialty).map(([specialty, count]) => (
                                    <div key={specialty} className="flex items-center justify-between">
                                        <span className="text-sm capitalize">{specialty}</span>
                                        <Badge variant="secondary">{count}</Badge>
                                    </div>
                                ))}
                                {Object.keys(stats.by_specialty).length === 0 && (
                                    <p className="text-sm text-muted-foreground">
                                        No hay datos de especialidades disponibles
                                    </p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Recent and Urgent Emails */}
                <div className="grid gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>Emails Recientes</CardTitle>
                            <CardDescription>
                                Últimos emails procesados por el sistema de IA
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {recentEmails.map((email) => (
                                    <div key={email.id} className="flex items-center space-x-3 p-2 rounded-lg border">
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-medium truncate">
                                                {email.patient_name || 'Sin nombre'}
                                            </p>
                                            <p className="text-xs text-muted-foreground truncate">
                                                {email.subject}
                                            </p>
                                        </div>
                                        <div className="flex items-center space-x-2">
                                            <Badge className={getStatusColor(email.processing_status)}>
                                                {email.processing_status}
                                            </Badge>
                                            {email.imported_to_registro && (
                                                <CheckCircle className="h-4 w-4 text-green-500" />
                                            )}
                                        </div>
                                    </div>
                                ))}
                                {recentEmails.length === 0 && (
                                    <p className="text-sm text-muted-foreground">
                                        No hay emails recientes
                                    </p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>Emails Urgentes</CardTitle>
                            <CardDescription>
                                Casos que requieren atención inmediata
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {urgentEmails.map((email) => (
                                    <div key={email.id} className="flex items-center space-x-3 p-2 rounded-lg border border-red-200 bg-red-50">
                                        <div className={`w-2 h-2 rounded-full ${getUrgencyColor(email.urgency_level)}`} />
                                        <div className="flex-1 min-w-0">
                                            <p className="text-sm font-medium truncate">
                                                {email.patient_name || 'Sin nombre'}
                                            </p>
                                            <p className="text-xs text-muted-foreground truncate">
                                                {email.specialty_detected || 'Sin especialidad'}
                                            </p>
                                        </div>
                                        <Badge variant="destructive">
                                            {email.urgency_level}
                                        </Badge>
                                    </div>
                                ))}
                                {urgentEmails.length === 0 && (
                                    <p className="text-sm text-muted-foreground">
                                        No hay emails urgentes pendientes
                                    </p>
                                )}
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Footer Info */}
                <Card>
                    <CardContent className="pt-6">
                        <div className="flex items-center justify-between text-sm text-muted-foreground">
                            <span>Última actualización: {lastUpdate.toLocaleString()}</span>
                            <Button
                                variant="ghost"
                                size="sm"
                                onClick={() => router.reload()}
                            >
                                <RefreshCw className="h-4 w-4 mr-2" />
                                Actualizar
                            </Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}
