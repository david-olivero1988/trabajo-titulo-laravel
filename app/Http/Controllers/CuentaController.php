<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
##nuevas clases

use Illuminate\Support\Facades\Hash;
use App\User;
use Laracasts\Flash\Flash;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cuenta.cuenta');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $usuario=User::find($request->id);

       // dd($request->nueva_clave);
        if($request->nueva_clave==$request->repite_nueva_clave)
            {
                if (Hash::check($request->clave_actual, $usuario->password))
                    {
                        $usuario->password=bcrypt($request->nueva_clave);
                        $usuario->save();
                        Flash::success('Tu clave se actualizó exitosamente', 'Actualización de clave');
                        return view('cuenta.cuenta');
                    }else
                    {
                        Flash::error("La clave ingresada no corresponde a tu contraseña actual");
                        return view('cuenta.cuenta');
                    }

             }else
             {
                 Flash::error("Tu clave no coincide con la ingresada anteriormente");
                return view('cuenta.cuenta');
             }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd("hola");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
