"use client";

import { useState, useEffect } from "react";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { FileText, Settings, CheckCircle, Users, TrendingUp, Calendar, AlertTriangle } from "lucide-react";
import StatsCard from "@/components/StatsCard";
import SimpleChart from "@/components/SimpleChart";
import globalStore from "../store/globalStore";

export default function Dashboard({ tickets = [] }) {
  const [allTickets, setAllTickets] = useState(globalStore.getTickets());
  const [selectedPeriod, setSelectedPeriod] = useState("week");

  useEffect(() => {
    const unsubscribe = globalStore.subscribe((tickets) => {
      setAllTickets(tickets);
    });
    return unsubscribe;
  }, []);

  const stats = globalStore.getStats();
  
  const ticketsByType = {
    biomedicos: allTickets.filter(t => t.type === 'biomedicos').length,
    industriales: allTickets.filter(t => t.type === 'industriales').length,
    transporte: allTickets.filter(t => t.type === 'transporte').length
  };

  const recentTickets = allTickets.slice(0, 5);

  const chartData = [
    { name: 'Biomédicos', value: ticketsByType.biomedicos, color: '#3b82f6' },
    { name: 'Industriales', value: ticketsByType.industriales, color: '#10b981' },
    { name: 'Transporte', value: ticketsByType.transporte, color: '#f59e0b' }
  ];

  const statusData = [
    { name: 'Abiertos', value: stats.abiertos, color: '#ef4444' },
    { name: 'En Proceso', value: stats.enProceso, color: '#f59e0b' },
    { name: 'Cerrados', value: stats.cerrados, color: '#10b981' }
  ];

  return (
    <div className="p-6 space-y-6 bg-gray-50 min-h-screen">
      {/* Header */}
      <div className="flex justify-between items-center">
        <div>
          <h1 className="text-3xl font-bold text-gray-900">Dashboard</h1>
          <p className="text-gray-600 mt-1">Resumen general del sistema de tickets</p>
        </div>
        <div className="flex space-x-2">
          <Button variant="outline" size="sm">
            <Calendar className="w-4 h-4 mr-2" />
            Hoy
          </Button>
          <Button variant="outline" size="sm">
            <TrendingUp className="w-4 h-4 mr-2" />
            Reportes
          </Button>
        </div>
      </div>

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <StatsCard
          title="Total Tickets"
          value={stats.total}
          icon={FileText}
          color="blue"
          trend={{ positive: true, value: "+12%" }}
        />
        <StatsCard
          title="Tickets Abiertos"
          value={stats.abiertos}
          icon={AlertTriangle}
          color="red"
          trend={{ positive: false, value: "-3%" }}
        />
        <StatsCard
          title="En Proceso"
          value={stats.enProceso}
          icon={Settings}
          color="yellow"
          trend={{ positive: true, value: "+8%" }}
        />
        <StatsCard
          title="Completados"
          value={stats.cerrados}
          icon={CheckCircle}
          color="green"
          trend={{ positive: true, value: "+15%" }}
        />
      </div>

      {/* Charts Section */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card>
          <CardHeader>
            <CardTitle>Tickets por Tipo</CardTitle>
          </CardHeader>
          <CardContent>
            <SimpleChart data={chartData} type="pie" />
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle>Estado de Tickets</CardTitle>
          </CardHeader>
          <CardContent>
            <SimpleChart data={statusData} type="bar" />
          </CardContent>
        </Card>
      </div>

      {/* Recent Activity */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card>
          <CardHeader>
            <CardTitle>Tickets Recientes</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {recentTickets.map((ticket) => (
                <div key={ticket.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                  <div>
                    <p className="font-medium text-sm">{ticket.id}</p>
                    <p className="text-xs text-gray-500 truncate max-w-xs">{ticket.description}</p>
                  </div>
                  <div className="flex items-center space-x-2">
                    <Badge 
                      className={
                        ticket.status === 'Abierto' ? 'bg-red-100 text-red-800' :
                        ticket.status === 'En Proceso' ? 'bg-yellow-100 text-yellow-800' :
                        'bg-green-100 text-green-800'
                      }
                    >
                      {ticket.status}
                    </Badge>
                    <span className="text-xs text-gray-400">{ticket.date}</span>
                  </div>
                </div>
              ))}
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle>Resumen por Departamento</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              <div className="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <div className="w-3 h-3 bg-blue-500 rounded-full"></div>
                  <span className="font-medium">Biomédicos</span>
                </div>
                <span className="text-lg font-bold text-blue-600">{ticketsByType.biomedicos}</span>
              </div>
              <div className="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <div className="w-3 h-3 bg-green-500 rounded-full"></div>
                  <span className="font-medium">Industriales</span>
                </div>
                <span className="text-lg font-bold text-green-600">{ticketsByType.industriales}</span>
              </div>
              <div className="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                <div className="flex items-center space-x-3">
                  <div className="w-3 h-3 bg-orange-500 rounded-full"></div>
                  <span className="font-medium">Transporte</span>
                </div>
                <span className="text-lg font-bold text-orange-600">{ticketsByType.transporte}</span>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Quick Actions */}
      <Card>
        <CardHeader>
          <CardTitle>Acciones Rápidas</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <Button className="h-20 flex flex-col items-center justify-center space-y-2">
              <FileText className="w-6 h-6" />
              <span>Nuevo Ticket</span>
            </Button>
            <Button variant="outline" className="h-20 flex flex-col items-center justify-center space-y-2">
              <TrendingUp className="w-6 h-6" />
              <span>Ver Reportes</span>
            </Button>
            <Button variant="outline" className="h-20 flex flex-col items-center justify-center space-y-2">
              <Users className="w-6 h-6" />
              <span>Gestionar Usuarios</span>
            </Button>
          </div>
        </CardContent>
      </Card>
    </div>
  );
}