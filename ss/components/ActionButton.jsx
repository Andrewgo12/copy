"use client";

import { Button } from "@/components/ui/button";

export default function ActionButton({ 
  icon: Icon, 
  label, 
  onClick, 
  variant = "outline", 
  size = "sm",
  color = "default",
  disabled = false,
  loading = false
}) {
  const colorClasses = {
    default: "",
    danger: "text-red-600 hover:text-red-700 hover:bg-red-50",
    success: "text-green-600 hover:text-green-700 hover:bg-green-50",
    warning: "text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50"
  };

  return (
    <Button
      variant={variant}
      size={size}
      onClick={onClick}
      disabled={disabled || loading}
      className={`${colorClasses[color]} ${loading ? 'opacity-50' : ''}`}
      title={label}
    >
      {loading ? (
        <div className="w-4 h-4 border-2 border-current border-t-transparent rounded-full animate-spin" />
      ) : (
        Icon && <Icon className="h-4 w-4" />
      )}
      {label && size !== "sm" && <span className="ml-2">{label}</span>}
    </Button>
  );
}