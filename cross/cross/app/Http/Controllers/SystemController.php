<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    /**
     * Información del sistema
     */
    public function getSystemInfo()
    {
        try {
            $systemInfo = [
                'name' => 'Sistema CROSS',
                'version' => '1.0.0',
                'database' => 'PostgreSQL',
                'totalTables' => 146,
                'schemas' => ['profiles', 'schema2'],
                'description' => 'Sistema de gestión integral CROSS',
                'framework' => 'Laravel ' . app()->version(),
                'php_version' => PHP_VERSION
            ];
            
            return $this->success($systemInfo);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Obtener todas las tablas
     */
    public function getAllTables()
    {
        try {
            $tables = DB::select("
                SELECT schemaname, tablename 
                FROM pg_tables 
                WHERE schemaname IN ('profiles', 'schema2')
                ORDER BY schemaname, tablename
            ");
            
            return $this->success([
                'total' => count($tables),
                'tables' => $tables
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Obtener datos de una tabla específica
     */
    public function getTableData(Request $request, $schema, $table)
    {
        try {
            $limit = $request->query('limit', 10);
            
            // Validar esquema permitido
            if (!in_array($schema, ['profiles', 'schema2'])) {
                return $this->error('Esquema no permitido', 400);
            }
            
            $data = DB::select("
                SELECT * FROM {$schema}.{$table} 
                LIMIT ?
            ", [$limit]);
            
            return $this->success([
                'schema' => $schema,
                'table' => $table,
                'count' => count($data),
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Estadísticas del sistema
     */
    public function getStats()
    {
        try {
            $stats = [
                'database_size' => DB::select("SELECT pg_size_pretty(pg_database_size(current_database())) as size")[0]->size ?? 'N/A',
                'active_connections' => DB::select("SELECT count(*) as count FROM pg_stat_activity")[0]->count ?? 0,
                'uptime' => DB::select("SELECT date_trunc('second', current_timestamp - pg_postmaster_start_time()) as uptime")[0]->uptime ?? 'N/A'
            ];
            
            return $this->success($stats);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}