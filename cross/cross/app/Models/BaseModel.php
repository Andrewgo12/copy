<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    protected $connection = 'pgsql';
    protected $schema = 'schema2';
    
    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return $this->schema . '.' . ($this->table ?? str_replace(
            '\\', '', snake_case(str_replace($this->getNamespace(), '', get_class($this)))
        ));
    }

    /**
     * Get the namespace of the model.
     */
    protected function getNamespace()
    {
        return 'App\\Models\\';
    }

    /**
     * Obtener todos los registros con límite
     */
    public static function findAll($limit = 100)
    {
        return static::limit($limit)->get();
    }

    /**
     * Buscar por ID específico
     */
    public static function findById($id, $idField = 'id')
    {
        return static::where($idField, $id)->first();
    }

    /**
     * Crear nuevo registro
     */
    public static function createRecord(array $data)
    {
        return static::create($data);
    }

    /**
     * Actualizar registro por ID
     */
    public static function updateRecord($id, array $data, $idField = 'id')
    {
        $record = static::where($idField, $id)->first();
        if ($record) {
            $record->update($data);
            return $record->fresh();
        }
        return null;
    }

    /**
     * Eliminar registro por ID
     */
    public static function deleteRecord($id, $idField = 'id')
    {
        $record = static::where($idField, $id)->first();
        if ($record) {
            $deleted = $record->toArray();
            $record->delete();
            return $deleted;
        }
        return null;
    }

    /**
     * Contar registros
     */
    public static function countRecords()
    {
        return static::count();
    }

    /**
     * Ejecutar query personalizado
     */
    public static function customQuery($query, $bindings = [])
    {
        return DB::select($query, $bindings);
    }
}