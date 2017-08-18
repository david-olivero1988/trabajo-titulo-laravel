<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Universo extends Model
{
    protected $table='universos';
    protected $fillable=['nombre', 'descripcion', 'proceso_id'];
}
