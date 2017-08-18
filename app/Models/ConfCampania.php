<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfCampania extends Model
{
    protected $table='conf_campanias';

    protected $fillable=['mediodia','hora','num_notificaciones','mensaje_generico','usuario'];


}
