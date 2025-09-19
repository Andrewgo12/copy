<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden extends BaseModel
{
    use HasFactory;

    protected $table = 'orden';
    protected $schema = 'schema2';
    protected $primaryKey = 'ordenumeros';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ordenumeros',
        'ordenactivas',
        'usuacodigos',
        'orgacodigos',
        'ordenfecregis',
        'ordendescrips',
        'ordenestados',
        'ordenprioridad',
        'ordenfecvenci'
    ];

    protected $casts = [
        'ordenfecregis' => 'datetime',
        'ordenfecvenci' => 'datetime',
        'ordenactivas' => 'string',
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return $this->schema . '.' . $this->table;
    }

    /**
     * Relación con Personal (Usuario)
     */
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'usuacodigos', 'perscodigos');
    }

    /**
     * Relación con Organización
     */
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'orgacodigos', 'orgacodigos');
    }

    /**
     * Buscar orden por número
     */
    public static function findByNumber($numero)
    {
        return static::where('ordenumeros', $numero)->first();
    }

    /**
     * Buscar órdenes activas
     */
    public static function findActive()
    {
        return static::where('ordenactivas', 'A')->get();
    }

    /**
     * Buscar por usuario
     */
    public static function findByUser($usuacodigos)
    {
        return static::where('usuacodigos', $usuacodigos)->get();
    }

    /**
     * Obtener órdenes con detalles
     */
    public static function findWithDetails()
    {
        return static::with(['personal', 'organizacion'])
            ->where('ordenactivas', 'A')
            ->orderBy('ordenfecregis', 'desc')
            ->get();
    }

    /**
     * Scope para órdenes activas
     */
    public function scopeActive($query)
    {
        return $query->where('ordenactivas', 'A');
    }

    /**
     * Scope para órdenes por estado
     */
    public function scopeByEstado($query, $estado)
    {
        return $query->where('ordenestados', $estado);
    }

    /**
     * Accessor para el estado
     */
    public function getEstadoAttribute()
    {
        return $this->ordenactivas === 'A' ? 'Activa' : 'Inactiva';
    }
}