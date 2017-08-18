<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CicloMes extends Model
{
    protected $table='ciclo_mes';
    protected $fillable=['tipo_ciclo_mes','int_repetir_dia_0','int_por_meses_0','str_repetir_el_1','str_dia_1','int_por_1'];
}
