"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { FileText, Settings, Archive } from "lucide-react";

// Importar las vistas
import MyTickets from "./MyTickets";
import GestionTickets from "./GestionTickets";
import ClosedTickets from "./ClosedTickets";
import Dashboard from "./components/Dashboard";

export default function App() {
  const [activeTab, setActiveTab] = useState("dashboard");
  const [allTickets, setAllTickets] = useState([]);

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header Principal */}
      <header className="bg-white shadow-sm border-b border-gray-200">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center py-4">
            <div>
              <h1 className="text-2xl font-bold text-gray-900">
                Sistema de Tickets
              </h1>
              <p className="text-sm text-gray-600">
                Gestión integral de tickets y documentos
              </p>
            </div>
          </div>
        </div>
      </header>

      {/* Navegación por pestañas */}
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <Tabs value={activeTab} onValueChange={setActiveTab} className="w-full">
          <TabsList className="grid w-full grid-cols-4 mb-6">
            <TabsTrigger 
              value="dashboard" 
              className="flex items-center gap-2"
            >
              <FileText className="w-4 h-4" />
              Dashboard
            </TabsTrigger>
            <TabsTrigger 
              value="my-tickets" 
              className="flex items-center gap-2"
            >
              <FileText className="w-4 h-4" />
              Mis Tickets
            </TabsTrigger>
            <TabsTrigger 
              value="gestion-tickets" 
              className="flex items-center gap-2"
            >
              <Settings className="w-4 h-4" />
              Gestión de Tickets
            </TabsTrigger>
            <TabsTrigger 
              value="closed-tickets" 
              className="flex items-center gap-2"
            >
              <Archive className="w-4 h-4" />
              Documentos Cerrados
            </TabsTrigger>
          </TabsList>

          <TabsContent value="dashboard" className="mt-0">
            <Dashboard tickets={allTickets} />
          </TabsContent>

          <TabsContent value="my-tickets" className="mt-0">
            <MyTickets onTicketsChange={setAllTickets} />
          </TabsContent>

          <TabsContent value="gestion-tickets" className="mt-0">
            <GestionTickets />
          </TabsContent>

          <TabsContent value="closed-tickets" className="mt-0">
            <ClosedTickets />
          </TabsContent>
        </Tabs>
      </div>
    </div>
  );
}