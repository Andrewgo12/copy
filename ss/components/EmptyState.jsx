"use client";

import { Button } from "@/components/ui/button";
import { FileText, Plus } from "lucide-react";

export default function EmptyState({ 
  title = "No hay datos", 
  description = "No se encontraron elementos para mostrar",
  icon: Icon = FileText,
  actionLabel,
  onAction,
  className = ""
}) {
  return (
    <div className={`flex flex-col items-center justify-center py-12 px-4 text-center ${className}`}>
      <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
        <Icon className="w-8 h-8 text-gray-400" />
      </div>
      <h3 className="text-lg font-medium text-gray-900 mb-2">{title}</h3>
      <p className="text-gray-500 mb-6 max-w-sm">{description}</p>
      {actionLabel && onAction && (
        <Button onClick={onAction} className="flex items-center gap-2">
          <Plus className="w-4 h-4" />
          {actionLabel}
        </Button>
      )}
    </div>
  );
}