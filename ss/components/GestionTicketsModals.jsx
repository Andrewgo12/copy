import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Upload, UserPlus, Paperclip, X, FileText, Eye, Download, Plus, Settings, Users } from "lucide-react";

export function GestionThirdPartyModal({ isOpen, onClose, onSubmit }) {
  const [data, setData] = useState({ name: '', email: '', phone: '', company: '', role: '', priority: 'media' });

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-2xl">
        <DialogHeader>
          <DialogTitle>Registrar Supervisor/Coordinador - Gestión</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label>Nombre del Supervisor *</Label>
              <Input 
                value={data.name}
                onChange={(e) => setData(prev => ({...prev, name: e.target.value}))}
                placeholder="Nombre completo"
              />
            </div>
            <div>
              <Label>Email Institucional *</Label>
              <Input 
                type="email"
                value={data.email}
                onChange={(e) => setData(prev => ({...prev, email: e.target.value}))}
                placeholder="supervisor@institucion.com"
              />
            </div>
            <div>
              <Label>Teléfono/Extensión</Label>
              <Input 
                value={data.phone}
                onChange={(e) => setData(prev => ({...prev, phone: e.target.value}))}
                placeholder="+57 300 123 4567"
              />
            </div>
            <div>
              <Label>Área de Supervisión</Label>
              <Input 
                value={data.company}
                onChange={(e) => setData(prev => ({...prev, company: e.target.value}))}
                placeholder="Departamento/Área"
              />
            </div>
          </div>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label>Cargo/Posición</Label>
              <Select value={data.role} onValueChange={(value) => setData(prev => ({...prev, role: value}))}>
                <SelectTrigger>
                  <SelectValue placeholder="Seleccionar cargo" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="supervisor">Supervisor de Área</SelectItem>
                  <SelectItem value="coordinador">Coordinador General</SelectItem>
                  <SelectItem value="jefe">Jefe de Departamento</SelectItem>
                  <SelectItem value="director">Director Técnico</SelectItem>
                  <SelectItem value="gerente">Gerente de Operaciones</SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div>
              <Label>Nivel de Prioridad</Label>
              <Select value={data.priority} onValueChange={(value) => setData(prev => ({...prev, priority: value}))}>
                <SelectTrigger>
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="alta">Alta - Decisiones Críticas</SelectItem>
                  <SelectItem value="media">Media - Supervisión General</SelectItem>
                  <SelectItem value="baja">Baja - Consulta</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>
          <div className="flex justify-end space-x-2 pt-4">
            <Button variant="outline" onClick={onClose}>Cancelar</Button>
            <Button onClick={() => {
              onSubmit(data);
              setData({ name: '', email: '', phone: '', company: '', role: '', priority: 'media' });
            }}>Registrar Supervisor</Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}

export function GestionFileUploadModal({ isOpen, onClose, onUpload }) {
  const [files, setFiles] = useState([]);

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-3xl">
        <DialogHeader>
          <DialogTitle>Subir Documentos Administrativos - Gestión</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="border-2 border-dashed border-green-300 rounded-lg p-8 text-center bg-green-50">
            <Upload className="mx-auto h-12 w-12 text-green-500 mb-4" />
            <p className="text-lg font-medium text-green-900 mb-2">Documentos de Gestión</p>
            <p className="text-sm text-green-600 mb-4">Órdenes de trabajo, reportes, autorizaciones</p>
            <Input 
              type="file" 
              multiple 
              accept=".pdf,.doc,.docx,.xls,.xlsx"
              onChange={(e) => {
                const newFiles = Array.from(e.target.files).map(file => ({
                  id: Date.now() + Math.random(),
                  name: file.name,
                  size: file.size,
                  type: file.type,
                  category: 'administrativo'
                }));
                setFiles(prev => [...prev, ...newFiles]);
              }}
              className="hidden"
              id="gestion-upload"
            />
            <Label htmlFor="gestion-upload" className="cursor-pointer">
              <Button type="button">Seleccionar Documentos</Button>
            </Label>
          </div>
          
          {files.length > 0 && (
            <div className="space-y-2">
              <h4 className="font-medium">Documentos Administrativos ({files.length})</h4>
              <div className="max-h-40 overflow-y-auto space-y-2">
                {files.map((file) => (
                  <div key={file.id} className="flex items-center justify-between p-3 bg-green-50 rounded">
                    <div className="flex items-center space-x-3">
                      <Settings className="h-5 w-5 text-green-500" />
                      <div>
                        <p className="font-medium text-sm">{file.name}</p>
                        <p className="text-xs text-green-600">Documento Administrativo</p>
                      </div>
                    </div>
                    <Button variant="ghost" size="sm" onClick={() => setFiles(prev => prev.filter(f => f.id !== file.id))}>
                      <X className="h-4 w-4" />
                    </Button>
                  </div>
                ))}
              </div>
            </div>
          )}
          
          <div className="flex justify-end space-x-2 pt-4">
            <Button variant="outline" onClick={onClose}>Cerrar</Button>
            <Button onClick={() => { onUpload(files); setFiles([]); }} disabled={files.length === 0}>
              Subir Documentos ({files.length})
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}

export function GestionAttachmentModal({ isOpen, onClose }) {
  const attachments = [
    { id: 1, name: 'Orden_Trabajo_001.pdf', category: 'Orden de Trabajo', date: '2024-05-08', status: 'Pendiente' },
    { id: 2, name: 'Autorizacion_Compra_Repuestos.pdf', category: 'Autorización', date: '2024-05-07', status: 'Aprobado' },
    { id: 3, name: 'Reporte_Mensual_Mayo.xlsx', category: 'Reporte', date: '2024-05-06', status: 'Completado' },
    { id: 4, name: 'Presupuesto_Mantenimiento.xlsx', category: 'Presupuesto', date: '2024-05-05', status: 'En Revisión' },
    { id: 5, name: 'Cronograma_Actividades.pdf', category: 'Cronograma', date: '2024-05-04', status: 'Activo' },
    { id: 6, name: 'Evaluacion_Proveedores.docx', category: 'Evaluación', date: '2024-05-03', status: 'Completado' }
  ];

  const getStatusBadge = (status) => {
    const colors = {
      'Pendiente': 'bg-yellow-100 text-yellow-800',
      'Aprobado': 'bg-green-100 text-green-800',
      'Completado': 'bg-blue-100 text-blue-800',
      'En Revisión': 'bg-orange-100 text-orange-800',
      'Activo': 'bg-purple-100 text-purple-800'
    };
    return <Badge className={colors[status] || 'bg-gray-100 text-gray-800'}>{status}</Badge>;
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl">
        <DialogHeader>
          <DialogTitle>Centro de Documentos - Gestión</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="flex justify-between items-center">
            <h4 className="font-medium">Documentos Administrativos y de Gestión</h4>
            <Badge className="bg-green-100 text-green-800">Gestión</Badge>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {attachments.map((attachment) => (
              <Card key={attachment.id} className="hover:shadow-md transition-shadow border-green-200">
                <CardContent className="p-4">
                  <div className="flex items-start justify-between mb-3">
                    <div className="flex items-center space-x-2">
                      <Settings className="h-8 w-8 text-green-500" />
                      <div>
                        <p className="font-medium text-sm">{attachment.name}</p>
                        <p className="text-xs text-green-600">{attachment.category}</p>
                      </div>
                    </div>
                  </div>
                  <div className="space-y-2">
                    {getStatusBadge(attachment.status)}
                    <p className="text-xs text-gray-500">Fecha: {attachment.date}</p>
                    <div className="flex space-x-1">
                      <Button size="sm" variant="outline" className="flex-1 border-green-200 text-green-600">
                        <Eye className="h-3 w-3 mr-1" />
                        Ver
                      </Button>
                      <Button size="sm" variant="outline" className="flex-1 border-green-200 text-green-600">
                        <Download className="h-3 w-3 mr-1" />
                        Descargar
                      </Button>
                    </div>
                  </div>
                </CardContent>
              </Card>
            ))}
          </div>
          
          <div className="flex justify-end pt-4">
            <Button variant="outline" onClick={onClose}>Cerrar</Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}