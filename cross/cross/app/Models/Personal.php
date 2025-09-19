<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personal extends BaseModel
{
    use HasFactory;

    protected $table = 'personal';
    protected $schema = 'schema2';
    protected $primaryKey = 'perscodigos';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'perscodigos',
        'persprinoms',
        'perssegundos',
        'perspriapels',
        'perssegapels',
        'persemail',
        'persactivas',
        'orgacodigos',
        'perstelefono',
        'persdirecciones'
    ];

    protected $casts = [
        'persactivas' => 'string',
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
     * Relación con Organización
     */
    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'orgacodigos', 'orgacodigos');
    }

    /**
     * Relación con Órdenes
     */
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'usuacodigos', 'perscodigos');
    }

    /**
     * Buscar personal por código
     */
    public static function findByCode($codigo)
    {
        return static::where('perscodigos', $codigo)->first();
    }

    /**
     * Buscar personal activo
     */
    public static function findActive()
    {
        return static::where('persactivas', 'A')->get();
    }

    /**
     * Buscar por email
     */
    public static function findByEmail($email)
    {
        return static::where('persemail', $email)->first();
    }

    /**
     * Obtener personal con organización
     */
    public static function findWithOrganization()
    {
        return static::with('organizacion')
            ->where('persactivas', 'A')
            ->get();
    }

    /**
     * Scope para personal activo
     */
    public function scopeActive($query)
    {
        return $query->where('persactivas', 'A');
    }

    /**
     * Scope para búsqueda por nombre
     */
    public function scopeByName($query, $nombre)
    {
        return $query->where('persprinoms', 'ILIKE', "%{$nombre}%")
                    ->orWhere('perssegundos', 'ILIKE', "%{$nombre}%");
    }

    /**
     * Accessor para el nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return trim($this->persprinoms . ' ' . $this->perssegundos . ' ' . 
                   $this->perspriapels . ' ' . $this->perssegapels);
    }

    /**
     * Accessor para el estado
     */
    public function getEstadoAttribute()
    {
        return $this->persactivas === 'A' ? 'Activo' : 'Inactivo';
    }
}