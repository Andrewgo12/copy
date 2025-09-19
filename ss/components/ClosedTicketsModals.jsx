import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Textarea } from "@/components/ui/textarea";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Upload, UserPlus, Paperclip, X, FileText, Eye, Download, Plus, Archive, CheckCircle, Clock } from "lucide-react";

export function ClosedThirdPartyModal({ isOpen, onClose, onSubmit }) {
  const [data, setData] = useState({ name: '', email: '', phone: '', company: '', role: '', certification: '' });

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-2xl">
        <DialogHeader>
          <DialogTitle>Registrar Auditor/Evaluador - Documentos Cerrados</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label>Nombre del Auditor *</Label>
              <Input 
                value={data.name}
                onChange={(e) => setData(prev => ({...prev, name: e.target.value}))}
                placeholder="Nombre completo del auditor"
              />
            </div>
            <div>
              <Label>Email Profesional *</Label>
              <Input 
                type="email"
                value={data.email}
                onChange={(e) => setData(prev => ({...prev, email: e.target.value}))}
                placeholder="auditor@certificadora.com"
              />
            </div>
            <div>
              <Label>Teléfono de Contacto</Label>
              <Input 
                value={data.phone}
                onChange={(e) => setData(prev => ({...prev, phone: e.target.value}))}
                placeholder="+57 300 123 4567"
              />
            </div>
            <div>
              <Label>Empresa/Entidad</Label>
              <Input 
                value={data.company}
                onChange={(e) => setData(prev => ({...prev, company: e.target.value}))}
                placeholder="Entidad certificadora"
              />
            </div>
          </div>
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label>Tipo de Evaluador</Label>
              <Select value={data.role} onValueChange={(value) => setData(prev => ({...prev, role: value}))}>
                <SelectTrigger>
                  <SelectValue placeholder="Seleccionar tipo" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="auditor_interno">Auditor Interno</SelectItem>
                  <SelectItem value="auditor_externo">Auditor Externo</SelectItem>
                  <SelectItem value="evaluador_calidad">Evaluador de Calidad</SelectItem>
                  <SelectItem value="inspector">Inspector Técnico</SelectItem>
                  <SelectItem value="certificador">Certificador</SelectItem>
                </SelectContent>
              </Select>
            </div>
            <div>
              <Label>Certificación</Label>
              <Input 
                value={data.certification}
                onChange={(e) => setData(prev => ({...prev, certification: e.target.value}))}
                placeholder="Número de certificación"
              />
            </div>
          </div>
          <div>
            <Label>Área de Especialización</Label>
            <Textarea 
              placeholder="Descripción de áreas de especialización y competencias"
              rows={3}
            />
          </div>
          <div className="flex justify-end space-x-2 pt-4">
            <Button variant="outline" onClick={onClose}>Cancelar</Button>
            <Button onClick={() => {
              onSubmit(data);
              setData({ name: '', email: '', phone: '', company: '', role: '', certification: '' });
            }}>Registrar Evaluador</Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}

export function ClosedFileUploadModal({ isOpen, onClose, onUpload }) {
  const [files, setFiles] = useState([]);

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-3xl">
        <DialogHeader>
          <DialogTitle>Archivar Documentos Finales - Cerrados</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="border-2 border-dashed border-purple-300 rounded-lg p-8 text-center bg-purple-50">
            <Archive className="mx-auto h-12 w-12 text-purple-500 mb-4" />
            <p className="text-lg font-medium text-purple-900 mb-2">Archivo Documental</p>
            <p className="text-sm text-purple-600 mb-4">Certificados, actas de cierre, evaluaciones finales</p>
            <Input 
              type="file" 
              multiple 
              accept=".pdf,.doc,.docx,.jpg,.png"
              onChange={(e) => {
                const newFiles = Array.from(e.target.files).map(file => ({
                  id: Date.now() + Math.random(),
                  name: file.name,
                  size: file.size,
                  type: file.type,
                  category: 'archivo',
                  status: 'final'
                }));
                setFiles(prev => [...prev, ...newFiles]);
              }}
              className="hidden"
              id="closed-upload"
            />
            <Label htmlFor="closed-upload" className="cursor-pointer">
              <Button type="button">Seleccionar Documentos</Button>
            </Label>
          </div>
          
          {files.length > 0 && (
            <div className="space-y-2">
              <h4 className="font-medium">Documentos para Archivo ({files.length})</h4>
              <div className="max-h-40 overflow-y-auto space-y-2">
                {files.map((file) => (
                  <div key={file.id} className="flex items-center justify-between p-3 bg-purple-50 rounded">
                    <div className="flex items-center space-x-3">
                      <CheckCircle className="h-5 w-5 text-purple-500" />
                      <div>
                        <p className="font-medium text-sm">{file.name}</p>
                        <p className="text-xs text-purple-600">Documento Final</p>
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
              Archivar Documentos ({files.length})
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}

export function ClosedAttachmentModal({ isOpen, onClose }) {
  const attachments = [
    { id: 1, name: 'Certificado_Calibracion_Final.pdf', category: 'Certificado', date: '2024-05-08', retention: '5 años' },
    { id: 2, name: 'Acta_Cierre_Mantenimiento.pdf', category: 'Acta de Cierre', date: '2024-05-07', retention: '10 años' },
    { id: 3, name: 'Evaluacion_Final_Equipo.pdf', category: 'Evaluación', date: '2024-05-06', retention: '3 años' },
    { id: 4, name: 'Garantia_Servicio_Realizado.pdf', category: 'Garantía', date: '2024-05-05', retention: '2 años' },
    { id: 5, name: 'Informe_Conformidad.pdf', category: 'Informe', date: '2024-05-04', retention: '7 años' },
    { id: 6, name: 'Registro_Historico_Equipo.xlsx', category: 'Registro', date: '2024-05-03', retention: 'Permanente' }
  ];

  const getRetentionBadge = (retention) => {
    const colors = {
      'Permanente': 'bg-red-100 text-red-800',
      '10 años': 'bg-purple-100 text-purple-800',
      '7 años': 'bg-blue-100 text-blue-800',
      '5 años': 'bg-green-100 text-green-800',
      '3 años': 'bg-yellow-100 text-yellow-800',
      '2 años': 'bg-orange-100 text-orange-800'
    };
    return <Badge className={colors[retention] || 'bg-gray-100 text-gray-800'}>{retention}</Badge>;
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl">
        <DialogHeader>
          <DialogTitle>Archivo Documental - Documentos Cerrados</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="flex justify-between items-center">
            <h4 className="font-medium">Documentos Archivados y Certificaciones</h4>
            <Badge className="bg-purple-100 text-purple-800">Archivo</Badge>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {attachments.map((attachment) => (
              <Card key={attachment.id} className="hover:shadow-md transition-shadow border-purple-200">
                <CardContent className="p-4">
                  <div className="flex items-start justify-between mb-3">
                    <div className="flex items-center space-x-2">
                      <Archive className="h-8 w-8 text-purple-500" />
                      <div>
                        <p className="font-medium text-sm">{attachment.name}</p>
                        <p className="text-xs text-purple-600">{attachment.category}</p>
                      </div>
                    </div>
                  </div>
                  <div className="space-y-2">
                    <div className="flex items-center space-x-2">
                      <Clock className="h-3 w-3 text-gray-400" />
                      {getRetentionBadge(attachment.retention)}
                    </div>
                    <p className="text-xs text-gray-500">Archivado: {attachment.date}</p>
                    <div className="flex space-x-1">
                      <Button size="sm" variant="outline" className="flex-1 border-purple-200 text-purple-600">
                        <Eye className="h-3 w-3 mr-1" />
                        Ver
                      </Button>
                      <Button size="sm" variant="outline" className="flex-1 border-purple-200 text-purple-600">
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