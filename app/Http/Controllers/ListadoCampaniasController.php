<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

use Auth; 
use Illuminate\Contracts\Auth\Guard;
use App\Models\Proceso;
use App\Models\Universo;

use App\Models\Campania;

class ListadoCampaniasController extends Controller
{
    //

     public function index(Request $request)
    {
        if($request->ajax())
        {
    
        	$universos=Universo::where('proceso_id','=',$request->get('dato'))->get();
          //dd($universos);
        	return compact('universos');
        }
        
       
        $campanias = Campania::campanias();

          $procesos = Proceso::all();
          
           \Log::info('Info log test=========================');
           dd('test');
         
          $filtros="?dato=dato";
          //dd($request->actualizacion);
          
        
        return view('campanias.listado_campanias',compact('campanias','procesos','filtros','request'));
        
    }

}
