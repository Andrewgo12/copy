import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent } from "@/components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/components/ui/dialog";
import { Upload, UserPlus, Paperclip, X, FileText, Eye, Download, Plus } from "lucide-react";

export function MyTicketsThirdPartyModal({ isOpen, onClose, onSubmit }) {
  const [data, setData] = useState({ name: '', email: '', phone: '', company: '', role: '', department: 'biomedicos' });

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-2xl">
        <DialogHeader>
          <DialogTitle>Registrar Técnico Especializado - MyTickets</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label>Nombre del Técnico *</Label>
              <Input 
                value={data.name}
                onChange={(e) => setData(prev => ({...prev, name: e.target.value}))}
                placeholder="Nombre completo del técnico"
              />
            </div>
            <div>
              <Label>Email Corporativo *</Label>
              <Input 
                type="email"
                value={data.email}
                onChange={(e) => setData(prev => ({...prev, email: e.target.value}))}
                placeholder="tecnico@hospital.com"
              />
            </div>
            <div>
              <Label>Teléfono Directo</Label>
              <Input 
                value={data.phone}
                onChange={(e) => setData(prev => ({...prev, phone: e.target.value}))}
                placeholder="Ext. 1234"
              />
            </div>
            <div>
              <Label>Departamento</Label>
              <Select value={data.department} onValueChange={(value) => setData(prev => ({...prev, department: value}))}>
                <SelectTrigger>
                  <SelectValue />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="biomedicos">Ingeniería Biomédica</SelectItem>
                  <SelectItem value="industriales">Mantenimiento Industrial</SelectItem>
                  <SelectItem value="transporte">Gestión de Transporte</SelectItem>
                </SelectContent>
              </Select>
            </div>
          </div>
          <div>
            <Label>Especialización</Label>
            <Select value={data.role} onValueChange={(value) => setData(prev => ({...prev, role: value}))}>
              <SelectTrigger>
                <SelectValue placeholder="Seleccionar especialización" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="ventiladores">Ventiladores Mecánicos</SelectItem>
                <SelectItem value="monitores">Monitores de Signos Vitales</SelectItem>
                <SelectItem value="bombas">Bombas de Infusión</SelectItem>
                <SelectItem value="rayosx">Equipos de Rayos X</SelectItem>
                <SelectItem value="general">Técnico General</SelectItem>
              </SelectContent>
            </Select>
          </div>
          <div className="flex justify-end space-x-2 pt-4">
            <Button variant="outline" onClick={onClose}>Cancelar</Button>
            <Button onClick={() => {
              onSubmit(data);
              setData({ name: '', email: '', phone: '', company: '', role: '', department: 'biomedicos' });
            }}>Registrar Técnico</Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
}

export function MyTicketsFileUploadModal({ isOpen, onClose, onUpload }) {
  const [files, setFiles] = useState([]);

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-3xl">
        <DialogHeader>
          <DialogTitle>Subir Documentos Técnicos - MyTickets</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="border-2 border-dashed border-blue-300 rounded-lg p-8 text-center bg-blue-50">
            <Upload className="mx-auto h-12 w-12 text-blue-500 mb-4" />
            <p className="text-lg font-medium text-blue-900 mb-2">Documentos de Mantenimiento</p>
            <p className="text-sm text-blue-600 mb-4">Manuales, certificados, reportes técnicos</p>
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
                  category: 'tecnico'
                }));
                setFiles(prev => [...prev, ...newFiles]);
              }}
              className="hidden"
              id="mytickets-upload"
            />
            <Label htmlFor="mytickets-upload" className="cursor-pointer">
              <Button type="button">Seleccionar Documentos</Button>
            </Label>
          </div>
          
          {files.length > 0 && (
            <div className="space-y-2">
              <h4 className="font-medium">Documentos Cargados ({files.length})</h4>
              <div className="max-h-40 overflow-y-auto space-y-2">
                {files.map((file) => (
                  <div key={file.id} className="flex items-center justify-between p-3 bg-blue-50 rounded">
                    <div className="flex items-center space-x-3">
                      <FileText className="h-5 w-5 text-blue-500" />
                      <div>
                        <p className="font-medium text-sm">{file.name}</p>
                        <p className="text-xs text-blue-600">Documento Técnico</p>
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

export function MyTicketsAttachmentModal({ isOpen, onClose }) {
  const attachments = [
    { id: 1, name: 'Manual_Ventilador_Drager.pdf', category: 'Manual Técnico', date: '2024-05-08', type: 'biomedicos' },
    { id: 2, name: 'Certificado_Calibracion_Monitor.pdf', category: 'Certificado', date: '2024-05-07', type: 'biomedicos' },
    { id: 3, name: 'Protocolo_Mantenimiento_Bombas.pdf', category: 'Protocolo', date: '2024-05-06', type: 'biomedicos' },
    { id: 4, name: 'Lista_Repuestos_Biomedicos.xlsx', category: 'Inventario', date: '2024-05-05', type: 'biomedicos' }
  ];

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent className="max-w-4xl">
        <DialogHeader>
          <DialogTitle>Biblioteca Técnica - MyTickets</DialogTitle>
        </DialogHeader>
        <div className="p-6 space-y-4">
          <div className="flex justify-between items-center">
            <h4 className="font-medium">Documentos Técnicos Especializados</h4>
            <Badge className="bg-blue-100 text-blue-800">Biomédicos</Badge>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {attachments.map((attachment) => (
              <Card key={attachment.id} className="hover:shadow-md transition-shadow border-blue-200">
                <CardContent className="p-4">
                  <div className="flex items-start justify-between mb-3">
                    <div className="flex items-center space-x-2">
                      <FileText className="h-8 w-8 text-blue-500" />
                      <div>
                        <p className="font-medium text-sm">{attachment.name}</p>
                        <p className="text-xs text-blue-600">{attachment.category}</p>
                      </div>
                    </div>
                  </div>
                  <div className="space-y-2">
                    <p className="text-xs text-gray-500">Actualizado: {attachment.date}</p>
                    <div className="flex space-x-1">
                      <Button size="sm" variant="outline" className="flex-1 border-blue-200 text-blue-600">
                        <Eye className="h-3 w-3 mr-1" />
                        Ver
                      </Button>
                      <Button size="sm" variant="outline" className="flex-1 border-blue-200 text-blue-600">
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