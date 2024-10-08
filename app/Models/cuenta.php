<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuenta extends Model
{
    use HasFactory;
    protected $fillable = [
        'correo',
        'plataforma',
        'disponibles',
        'id_proveedor',
        'pagado',
        'dias_restantes',
        'contrasena',
    ];
    public function perfiles()
    {
        return $this->hasMany(perfile::class, 'id_cuenta'); // Asegúrate de que 'cuenta_id' sea la clave foránea correcta
    }
}