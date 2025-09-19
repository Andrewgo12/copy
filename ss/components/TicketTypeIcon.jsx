"use client";

import { Building, Cog, Truck, FileText } from "lucide-react";

export default function TicketTypeIcon({ type, className = "w-5 h-5" }) {
  const getTypeConfig = (type) => {
    switch (type?.toLowerCase()) {
      case 'biomedicos':
        return {
          icon: Building,
          color: 'text-blue-600',
          bgColor: 'bg-blue-100',
          label: 'Biomédico'
        };
      case 'industriales':
        return {
          icon: Cog,
          color: 'text-green-600',
          bgColor: 'bg-green-100',
          label: 'Industrial'
        };
      case 'transporte':
        return {
          icon: Truck,
          color: 'text-orange-600',
          bgColor: 'bg-orange-100',
          label: 'Transporte'
        };
      default:
        return {
          icon: FileText,
          color: 'text-gray-600',
          bgColor: 'bg-gray-100',
          label: 'General'
        };
    }
  };

  const config = getTypeConfig(type);
  const Icon = config.icon;

  return (
    <div className={`inline-flex items-center justify-center p-2 rounded-full ${config.bgColor}`}>
      <Icon className={`${className} ${config.color}`} />
    </div>
  );
}