"use client";

import { forwardRef } from "react";

const Badge = forwardRef(({ className = "", variant = "default", ...props }, ref) => {
  const variants = {
    default: "bg-gray-100 text-gray-900 hover:bg-gray-200",
    secondary: "bg-gray-100 text-gray-900 hover:bg-gray-200",
    destructive: "bg-red-100 text-red-900 hover:bg-red-200",
    outline: "border border-gray-300 text-gray-900"
  };

  return (
    <div
      ref={ref}
      className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 ${variants[variant]} ${className}`}
      {...props}
    />
  );
});

Badge.displayName = "Badge";

export { Badge };