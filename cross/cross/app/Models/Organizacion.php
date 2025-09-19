<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organizacion extends BaseModel
{
    use HasFactory;

    protected $table = 'organizacion';
    protected $schema = 'schema2';
    protected $primaryKey = 'orgacodigos';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'orgacodigos',
        'organombres',
        'orgadescrips',
        'orgaactivas',
        'orgatelefono',
        'orgaemail',
        'orgadirecciones'
    ];

    protected $casts = [
        'orgaactivas' => 'string',
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
     * Relación con Personal
     */
    public function personal()
    {
        return $this->hasMany(Personal::class, 'orgacodigos', 'orgacodigos');
    }

    /**
     * Relación con Órdenes
     */
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'orgacodigos', 'orgacodigos');
    }

    /**
     * Scope para organizaciones activas
     */
    public function scopeActive($query)
    {
        return $query->where('orgaactivas', 'A');
    }

    /**
     * Accessor para el estado
     */
    public function getEstadoAttribute()
    {
        return $this->orgaactivas === 'A' ? 'Activa' : 'Inactiva';
    }
}