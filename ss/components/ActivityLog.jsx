"use client";

import { useState, useEffect } from "react";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { Clock, User, FileText, Edit, Trash2, Plus } from "lucide-react";

export default function ActivityLog({ limit = 10 }) {
  const [activities, setActivities] = useState([
    {
      id: 1,
      type: 'create',
      user: 'Juan Pérez',
      action: 'Creó ticket BIO-001',
      description: 'Mantenimiento preventivo de ventilador mecánico',
      timestamp: new Date(Date.now() - 1000 * 60 * 30), // 30 min ago
      icon: Plus,
      color: 'text-green-600 bg-green-100'
    },
    {
      id: 2,
      type: 'update',
      user: 'María García',
      action: 'Actualizó ticket IND-002',
      description: 'Cambió estado a "En Proceso"',
      timestamp: new Date(Date.now() - 1000 * 60 * 60), // 1 hour ago
      icon: Edit,
      color: 'text-blue-600 bg-blue-100'
    },
    {
      id: 3,
      type: 'complete',
      user: 'Carlos López',
      action: 'Completó ticket TRA-003',
      description: 'Cambio de llantas finalizado',
      timestamp: new Date(Date.now() - 1000 * 60 * 60 * 2), // 2 hours ago
      icon: FileText,
      color: 'text-purple-600 bg-purple-100'
    },
    {
      id: 4,
      type: 'delete',
      user: 'Ana Rodríguez',
      action: 'Eliminó ticket BIO-004',
      description: 'Ticket duplicado',
      timestamp: new Date(Date.now() - 1000 * 60 * 60 * 3), // 3 hours ago
      icon: Trash2,
      color: 'text-red-600 bg-red-100'
    },
    {
      id: 5,
      type: 'create',
      user: 'Luis Martínez',
      action: 'Creó ticket IND-005',
      description: 'Revisión de sistema eléctrico',
      timestamp: new Date(Date.now() - 1000 * 60 * 60 * 4), // 4 hours ago
      icon: Plus,
      color: 'text-green-600 bg-green-100'
    }
  ]);

  const formatTimeAgo = (timestamp) => {
    const now = new Date();
    const diff = now - timestamp;
    const minutes = Math.floor(diff / (1000 * 60));
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));

    if (minutes < 60) {
      return `hace ${minutes} min`;
    } else if (hours < 24) {
      return `hace ${hours}h`;
    } else {
      return `hace ${days}d`;
    }
  };

  const displayedActivities = activities.slice(0, limit);

  return (
    <Card>
      <CardHeader>
        <CardTitle className="flex items-center">
          <Clock className="w-5 h-5 mr-2" />
          Actividad Reciente
        </CardTitle>
      </CardHeader>
      <CardContent>
        <div className="space-y-4">
          {displayedActivities.map((activity) => {
            const IconComponent = activity.icon;
            return (
              <div key={activity.id} className="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                <div className={`p-2 rounded-full ${activity.color}`}>
                  <IconComponent className="w-4 h-4" />
                </div>
                <div className="flex-1 min-w-0">
                  <div className="flex items-center justify-between">
                    <p className="text-sm font-medium text-gray-900">
                      {activity.action}
                    </p>
                    <span className="text-xs text-gray-500">
                      {formatTimeAgo(activity.timestamp)}
                    </span>
                  </div>
                  <p className="text-sm text-gray-600 mt-1">
                    {activity.description}
                  </p>
                  <div className="flex items-center mt-2 space-x-2">
                    <User className="w-3 h-3 text-gray-400" />
                    <span className="text-xs text-gray-500">{activity.user}</span>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
        
        {activities.length > limit && (
          <div className="mt-4 text-center">
            <Button variant="outline" size="sm">
              Ver todas las actividades
            </Button>
          </div>
        )}
      </CardContent>
    </Card>
  );
}