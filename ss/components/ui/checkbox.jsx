"use client";

import { forwardRef } from "react";

const Checkbox = forwardRef(({ className = "", checked, onCheckedChange, disabled, ...props }, ref) => {
  return (
    <input
      type="checkbox"
      ref={ref}
      checked={checked}
      onChange={(e) => onCheckedChange?.(e.target.checked)}
      disabled={disabled}
      className={`h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2 ${className}`}
      {...props}
    />
  );
});

Checkbox.displayName = "Checkbox";

export { Checkbox };