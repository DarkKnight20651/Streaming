<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_cuenta',
        'pin',
        'nombre',
        'id_usuario',
        'dias_restantes',
        'precio',
        'pagado',
    ];
    public function cuenta()
    {
        return $this->belongsTo(cuenta::class, 'id_cuenta');
    }

    // Relación de Perfil a un Cliente
    public function cliente()
    {
        return $this->belongsTo(cliente::class, 'id_usuario');}
}