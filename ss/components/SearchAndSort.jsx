"use client";

import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { Search, SortAsc, SortDesc, Filter } from "lucide-react";

export default function SearchAndSort({ 
  onSearch, 
  onSort, 
  onFilter, 
  searchPlaceholder = "Buscar...",
  sortOptions = [],
  filterOptions = []
}) {
  const [searchTerm, setSearchTerm] = useState("");
  const [sortBy, setSortBy] = useState("");
  const [sortOrder, setSortOrder] = useState("asc");
  const [filterBy, setFilterBy] = useState("");

  const handleSearch = (value) => {
    setSearchTerm(value);
    onSearch(value);
  };

  const handleSort = (field) => {
    const newOrder = sortBy === field && sortOrder === "asc" ? "desc" : "asc";
    setSortBy(field);
    setSortOrder(newOrder);
    onSort(field, newOrder);
  };

  const handleFilter = (value) => {
    setFilterBy(value);
    onFilter(value);
  };

  return (
    <div className="flex flex-col sm:flex-row gap-4 p-4 bg-white rounded-lg shadow-sm border">
      {/* Search */}
      <div className="relative flex-1">
        <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4" />
        <Input
          placeholder={searchPlaceholder}
          value={searchTerm}
          onChange={(e) => handleSearch(e.target.value)}
          className="pl-10"
        />
      </div>

      {/* Sort */}
      {sortOptions.length > 0 && (
        <div className="flex items-center space-x-2">
          <Select value={sortBy} onValueChange={handleSort}>
            <SelectTrigger className="w-40">
              <SelectValue placeholder="Ordenar por" />
            </SelectTrigger>
            <SelectContent>
              {sortOptions.map((option) => (
                <SelectItem key={option.value} value={option.value}>
                  {option.label}
                </SelectItem>
              ))}
            </SelectContent>
          </Select>
          
          <Button
            variant="outline"
            size="sm"
            onClick={() => handleSort(sortBy)}
            disabled={!sortBy}
          >
            {sortOrder === "asc" ? (
              <SortAsc className="h-4 w-4" />
            ) : (
              <SortDesc className="h-4 w-4" />
            )}
          </Button>
        </div>
      )}

      {/* Filter */}
      {filterOptions.length > 0 && (
        <div className="flex items-center space-x-2">
          <Filter className="h-4 w-4 text-gray-400" />
          <Select value={filterBy} onValueChange={handleFilter}>
            <SelectTrigger className="w-40">
              <SelectValue placeholder="Filtrar por" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="">Todos</SelectItem>
              {filterOptions.map((option) => (
                <SelectItem key={option.value} value={option.value}>
                  {option.label}
                </SelectItem>
              ))}
            </SelectContent>
          </Select>
        </div>
      )}

      {/* Clear Filters */}
      {(searchTerm || sortBy || filterBy) && (
        <Button
          variant="outline"
          size="sm"
          onClick={() => {
            setSearchTerm("");
            setSortBy("");
            setFilterBy("");
            onSearch("");
            onSort("", "asc");
            onFilter("");
          }}
        >
          Limpiar
        </Button>
      )}
    </div>
  );
}