"use client";

import { Badge } from "@/components/ui/badge";
import { AlertTriangle, Clock, CheckCircle } from "lucide-react";

export default function TicketPriorityBadge({ priority, showIcon = true }) {
  const getPriorityConfig = (priority) => {
    switch (priority?.toLowerCase()) {
      case 'alta':
        return {
          className: 'bg-red-100 text-red-800 border-red-200',
          icon: AlertTriangle,
          label: 'Alta'
        };
      case 'media':
        return {
          className: 'bg-yellow-100 text-yellow-800 border-yellow-200',
          icon: Clock,
          label: 'Media'
        };
      case 'baja':
        return {
          className: 'bg-green-100 text-green-800 border-green-200',
          icon: CheckCircle,
          label: 'Baja'
        };
      default:
        return {
          className: 'bg-gray-100 text-gray-800 border-gray-200',
          icon: Clock,
          label: priority || 'Sin definir'
        };
    }
  };

  const config = getPriorityConfig(priority);
  const Icon = config.icon;

  return (
    <Badge className={`${config.className} border flex items-center gap-1`}>
      {showIcon && <Icon className="w-3 h-3" />}
      {config.label}
    </Badge>
  );
}