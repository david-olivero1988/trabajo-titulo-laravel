<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    protected $table='frecuencias';
    protected $fillablle=['tipo_frecuencia','int_ciclo_dias_0','int_ciclo_semanas_1','str_dias_1','mensual_id','anual_id',];
}
