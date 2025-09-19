"use client";

import { Badge } from "@/components/ui/badge";
import { Circle, Clock, CheckCircle, XCircle } from "lucide-react";

export default function TicketStatusBadge({ status, showIcon = true }) {
  const getStatusConfig = (status) => {
    switch (status?.toLowerCase()) {
      case 'abierto':
        return {
          className: 'bg-red-100 text-red-800 border-red-200',
          icon: Circle,
          label: 'Abierto'
        };
      case 'en proceso':
        return {
          className: 'bg-yellow-100 text-yellow-800 border-yellow-200',
          icon: Clock,
          label: 'En Proceso'
        };
      case 'cerrado':
        return {
          className: 'bg-green-100 text-green-800 border-green-200',
          icon: CheckCircle,
          label: 'Cerrado'
        };
      case 'cancelado':
        return {
          className: 'bg-gray-100 text-gray-800 border-gray-200',
          icon: XCircle,
          label: 'Cancelado'
        };
      default:
        return {
          className: 'bg-gray-100 text-gray-800 border-gray-200',
          icon: Circle,
          label: status || 'Sin estado'
        };
    }
  };

  const config = getStatusConfig(status);
  const Icon = config.icon;

  return (
    <Badge className={`${config.className} border flex items-center gap-1`}>
      {showIcon && <Icon className="w-3 h-3" />}
      {config.label}
    </Badge>
  );
}