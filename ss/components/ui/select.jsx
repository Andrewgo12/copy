"use client";

import { createContext, useContext, useState, forwardRef } from "react";

const SelectContext = createContext();

const Select = ({ value, onValueChange, children, ...props }) => {
  const [internalValue, setInternalValue] = useState(value);
  const [isOpen, setIsOpen] = useState(false);
  
  const currentValue = value !== undefined ? value : internalValue;
  const handleValueChange = onValueChange || setInternalValue;

  return (
    <SelectContext.Provider value={{ 
      value: currentValue, 
      onValueChange: handleValueChange,
      isOpen,
      setIsOpen
    }}>
      <div className="relative" {...props}>
        {children}
      </div>
    </SelectContext.Provider>
  );
};

const SelectTrigger = forwardRef(({ className = "", children, ...props }, ref) => {
  const context = useContext(SelectContext);
  
  return (
    <button
      ref={ref}
      className={`flex h-10 w-full items-center justify-between rounded-md border border-gray-300 bg-white px-3 py-2 text-sm ring-offset-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 ${className}`}
      onClick={() => context?.setIsOpen(!context.isOpen)}
      {...props}
    >
      {children}
      <svg className="h-4 w-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
      </svg>
    </button>
  );
});

const SelectValue = ({ placeholder, className = "", ...props }) => {
  const context = useContext(SelectContext);
  
  return (
    <span className={className} {...props}>
      {context?.value || placeholder}
    </span>
  );
};

const SelectContent = ({ className = "", children, ...props }) => {
  const context = useContext(SelectContext);
  
  if (!context?.isOpen) return null;
  
  return (
    <div 
      className={`absolute top-full left-0 z-50 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-auto ${className}`}
      {...props}
    >
      {children}
    </div>
  );
};

const SelectItem = ({ value, children, className = "", ...props }) => {
  const context = useContext(SelectContext);
  
  return (
    <div
      className={`relative flex w-full cursor-pointer select-none items-center rounded-sm py-1.5 px-2 text-sm outline-none hover:bg-gray-100 focus:bg-gray-100 ${className}`}
      onClick={() => {
        context?.onValueChange(value);
        context?.setIsOpen(false);
      }}
      {...props}
    >
      {children}
    </div>
  );
};

SelectTrigger.displayName = "SelectTrigger";
SelectValue.displayName = "SelectValue";
SelectContent.displayName = "SelectContent";
SelectItem.displayName = "SelectItem";

export { Select, SelectTrigger, SelectValue, SelectContent, SelectItem };