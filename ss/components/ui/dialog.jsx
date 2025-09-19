"use client";

import { createContext, useContext, forwardRef } from "react";

const DialogContext = createContext();

const Dialog = ({ open, onOpenChange, children }) => {
  return (
    <DialogContext.Provider value={{ open, onOpenChange }}>
      {children}
      {open && (
        <div className="fixed inset-0 z-50 flex items-center justify-center">
          <div 
            className="fixed inset-0 bg-black bg-opacity-50" 
            onClick={() => onOpenChange?.(false)}
          />
          {children}
        </div>
      )}
    </DialogContext.Provider>
  );
};

const DialogTrigger = ({ asChild, children, ...props }) => {
  const context = useContext(DialogContext);
  
  if (asChild) {
    return (
      <div onClick={() => context?.onOpenChange?.(true)} {...props}>
        {children}
      </div>
    );
  }
  
  return (
    <button onClick={() => context?.onOpenChange?.(true)} {...props}>
      {children}
    </button>
  );
};

const DialogContent = forwardRef(({ className = "", children, ...props }, ref) => {
  const context = useContext(DialogContext);
  
  if (!context?.open) return null;
  
  return (
    <div
      ref={ref}
      className={`relative z-50 bg-white rounded-lg shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto ${className}`}
      onClick={(e) => e.stopPropagation()}
      {...props}
    >
      {children}
    </div>
  );
});

const DialogHeader = ({ className = "", ...props }) => {
  return (
    <div
      className={`flex flex-col space-y-1.5 text-center sm:text-left p-6 pb-2 ${className}`}
      {...props}
    />
  );
};

const DialogTitle = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <h2
      ref={ref}
      className={`text-lg font-semibold leading-none tracking-tight ${className}`}
      {...props}
    />
  );
});

const DialogDescription = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <p
      ref={ref}
      className={`text-sm text-gray-500 ${className}`}
      {...props}
    />
  );
});

DialogContent.displayName = "DialogContent";
DialogTitle.displayName = "DialogTitle";
DialogDescription.displayName = "DialogDescription";

export { Dialog, DialogTrigger, DialogContent, DialogHeader, DialogTitle, DialogDescription };