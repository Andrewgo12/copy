"use client";

import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Plus, FileText, Users, Settings, Download, Upload } from "lucide-react";

export default function QuickActions({ onAction }) {
  const actions = [
    {
      id: 'new-ticket',
      label: 'Nuevo Ticket',
      icon: Plus,
      color: 'bg-blue-600 hover:bg-blue-700 text-white',
      description: 'Crear un nuevo ticket'
    },
    {
      id: 'view-reports',
      label: 'Ver Reportes',
      icon: FileText,
      color: 'bg-green-600 hover:bg-green-700 text-white',
      description: 'Generar reportes'
    },
    {
      id: 'manage-users',
      label: 'Gestionar Usuarios',
      icon: Users,
      color: 'bg-purple-600 hover:bg-purple-700 text-white',
      description: 'Administrar usuarios'
    },
    {
      id: 'settings',
      label: 'Configuración',
      icon: Settings,
      color: 'bg-gray-600 hover:bg-gray-700 text-white',
      description: 'Configurar sistema'
    },
    {
      id: 'export-data',
      label: 'Exportar Datos',
      icon: Download,
      color: 'bg-orange-600 hover:bg-orange-700 text-white',
      description: 'Exportar información'
    },
    {
      id: 'import-data',
      label: 'Importar Datos',
      icon: Upload,
      color: 'bg-indigo-600 hover:bg-indigo-700 text-white',
      description: 'Importar información'
    }
  ];

  return (
    <Card>
      <CardHeader>
        <CardTitle>Acciones Rápidas</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          {actions.map((action) => {
            const Icon = action.icon;
            return (
              <Button
                key={action.id}
                onClick={() => onAction?.(action.id)}
                className={`h-20 flex flex-col items-center justify-center space-y-2 ${action.color}`}
              >
                <Icon className="w-6 h-6" />
                <span className="text-sm font-medium">{action.label}</span>
              </Button>
            );
          })}
        </div>
      </CardContent>
    </Card>
  );
}