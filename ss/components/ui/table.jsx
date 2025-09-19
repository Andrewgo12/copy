"use client";

import { forwardRef } from "react";

const Table = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <div className="relative w-full overflow-auto">
      <table
        ref={ref}
        className={`w-full caption-bottom text-sm ${className}`}
        {...props}
      />
    </div>
  );
});

const TableHeader = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <thead
      ref={ref}
      className={`[&_tr]:border-b ${className}`}
      {...props}
    />
  );
});

const TableBody = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <tbody
      ref={ref}
      className={`[&_tr:last-child]:border-0 ${className}`}
      {...props}
    />
  );
});

const TableFooter = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <tfoot
      ref={ref}
      className={`border-t bg-gray-100/50 font-medium [&>tr]:last:border-b-0 ${className}`}
      {...props}
    />
  );
});

const TableRow = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <tr
      ref={ref}
      className={`border-b transition-colors hover:bg-gray-100/50 data-[state=selected]:bg-gray-100 ${className}`}
      {...props}
    />
  );
});

const TableHead = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <th
      ref={ref}
      className={`h-12 px-4 text-left align-middle font-medium text-gray-500 [&:has([role=checkbox])]:pr-0 ${className}`}
      {...props}
    />
  );
});

const TableCell = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <td
      ref={ref}
      className={`p-4 align-middle [&:has([role=checkbox])]:pr-0 ${className}`}
      {...props}
    />
  );
});

const TableCaption = forwardRef(({ className = "", ...props }, ref) => {
  return (
    <caption
      ref={ref}
      className={`mt-4 text-sm text-gray-500 ${className}`}
      {...props}
    />
  );
});

Table.displayName = "Table";
TableHeader.displayName = "TableHeader";
TableBody.displayName = "TableBody";
TableFooter.displayName = "TableFooter";
TableRow.displayName = "TableRow";
TableHead.displayName = "TableHead";
TableCell.displayName = "TableCell";
TableCaption.displayName = "TableCaption";

export {
  Table,
  TableHeader,
  TableBody,
  TableFooter,
  TableHead,
  TableRow,
  TableCell,
  TableCaption,
};