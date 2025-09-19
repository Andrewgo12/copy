<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends BaseModel
{
    use HasFactory;

    protected $table = 'cliente';
    protected $schema = 'schema2';
    protected $primaryKey = 'cliecodigos';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cliecodigos',
        'clienombres',
        'cliemails',
        'clieactivas',
        'clietelefono',
        'cliedirecciones',
        'clieciudades',
        'clieobservaciones'
    ];

    protected $casts = [
        'clieactivas' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return $this->schema . '.' . $this->table;
    }

    /**
     * Buscar cliente por código
     */
    public static function findByCode($codigo)
    {
        return static::where('cliecodigos', $codigo)->first();
    }

    /**
     * Buscar clientes activos
     */
    public static function findActive()
    {
        return static::where('clieactivas', 'A')->get();
    }

    /**
     * Buscar por email
     */
    public static function findByEmail($email)
    {
        return static::where('cliemails', $email)->first();
    }

    /**
     * Buscar por nombre
     */
    public static function findByName($nombre)
    {
        return static::where('clienombres', 'ILIKE', "%{$nombre}%")->get();
    }

    /**
     * Scope para clientes activos
     */
    public function scopeActive($query)
    {
        return $query->where('clieactivas', 'A');
    }

    /**
     * Scope para búsqueda por nombre
     */
    public function scopeByName($query, $nombre)
    {
        return $query->where('clienombres', 'ILIKE', "%{$nombre}%");
    }

    /**
     * Accessor para el nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return $this->clienombres;
    }

    /**
     * Accessor para el estado
     */
    public function getEstadoAttribute()
    {
        return $this->clieactivas === 'A' ? 'Activo' : 'Inactivo';
    }
}