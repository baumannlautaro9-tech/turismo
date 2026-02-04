<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación muchos a muchos con Establecimientos (favoritos)
     * 
     * IMPORTANTE: Los nombres de las columnas deben coincidir exactamente
     * con los de la tabla favoritos: user_id y establecimiento_id
     */
    public function favoritos()
    {
        return $this->belongsToMany(
            Establecimiento::class,    // Modelo relacionado
            'favoritos',               // Nombre de la tabla pivot
            'user_id',                 // Columna FK del usuario en la tabla favoritos
            'establecimiento_id'       // Columna FK del establecimiento en la tabla favoritos
        )->withTimestamps();
    }

    /**
     * Verificar si un establecimiento está en favoritos
     */
    public function hasFavorito($establecimientoId): bool
    {
        return $this->favoritos()->where('establecimiento_id', $establecimientoId)->exists();
    }

    /**
     * Añadir un establecimiento a favoritos
     */
    public function addFavorito($establecimientoId): void
    {
        if (!$this->hasFavorito($establecimientoId)) {
            $this->favoritos()->attach($establecimientoId);
        }
    }

    /**
     * Eliminar un establecimiento de favoritos
     */
    public function removeFavorito($establecimientoId): void
    {
        $this->favoritos()->detach($establecimientoId);
    }

    /**
     * Toggle favorito (añadir si no existe, eliminar si existe)
     */
    public function toggleFavorito($establecimientoId): bool
    {
        if ($this->hasFavorito($establecimientoId)) {
            $this->removeFavorito($establecimientoId);
            return false; // Eliminado
        } else {
            $this->addFavorito($establecimientoId);
            return true; // Añadido
        }
    }
}