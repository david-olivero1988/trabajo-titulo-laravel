<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table='notificaciones';

    protected $fillable=['notificaciones_id','campania_id','fecha_envio']
}
