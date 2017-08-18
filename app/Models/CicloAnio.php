<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CicloAnio extends Model
{
    protected $table='ciclo_anios';
    protected $fillable=['tipo_ciclo_anios','int_ciclos_anios','int_repetir_el_0','str_del_mes_0','str_repetir_el_1','str_dia_1','str_mes_1',];
}
