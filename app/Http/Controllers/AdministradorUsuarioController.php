<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

##clases agregadas
use Validator;
use App\User;
use Malahierba\ChileRut\ChileRut;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class AdministradorUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $usuarios=User::select('users.id', 'users.rut', 'users.dv', 'users.nombre', 'users.apellido_paterno', 'users.email', 'users.estado', 'users.nombre_usuario', 'perfil_usuarios.perfil')->join('perfil_usuarios','users.perfil_id','=','perfil_usuarios.id')->orderBy('users.id')
          ->paginate(17);
       // dd($usuarios);
        $request= new Request;
        return view('administrador_usuario.administrador_usuario',compact('usuarios','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        dd($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required',
            'rut' => 'required',
            'nombre' => 'required',
            'email' => 'required',
            'estado' => 'required',
            'perfil' => 'required',
            'nombre_usuario' => 'required',
            'apellido_paterno' => 'required',
        ]);
    }


    public function store(Request $request)
    {   
        
//dd($request);
        $id         =$request->get('id');

        $rut        = $request->get('rut');
        $nombre     =$request->get('nombre');
        $email      = $request->get('email');
        $estado     = $request->get('estado');
        $perfil     =$request->get('perfil');
        $nombre_usuario= $request->get('nombre_usuario');
        $apellido_paterno=$request->get('apellido_paterno');

        $datos= $arrayName = array('id' => $id ,'nombre' => $nombre,'apellido_paterno' => $apellido_paterno, 'email' => $email, 'estado' => $estado, 'rut' => $rut, 'nombre_usuario' => $nombre_usuario, 'perfil' => $perfil);
        //dd($datos);
        $validacion=$this->validator($datos);
        if($validacion->fails())
        {
            //flash()->overlay('Faltan datos requeridos', 'Información');
            flash('Faltan datos requeridos', 'success');
            return redirect()->route('administrador_usuarios.index');
        }

        //if($request->) validar que vengan los parametros correctos
        
        if ($id==0) 
        {//crea un nuevo usuario
            $nuevo_usuario=new User;
            $nuevo_usuario->rut=$rut;
            $nuevo_usuario->nombre=$nombre;
            $nuevo_usuario->email=$email;
            $nuevo_usuario->estado=$estado;
            $nuevo_usuario->perfil_id=$perfil;
            $nuevo_usuario->nombre_usuario=$nombre_usuario;
            $nuevo_usuario->apellido_paterno=$apellido_paterno;
            $nuevo_usuario->password=bcrypt("123456");//clave por defecto


            $ChileRut=new ChileRut;
            $digitoVerificador = $ChileRut->digitoVerificador($rut);
           // dd($digitoVerificador);
            $nuevo_usuario->dv=$digitoVerificador;
            $nuevo_usuario->save();
            //flash()->overlay('El usuario se creó exitosamente', 'Creación de usuario');
            flash('El usuario se creó exitosamente', 'success');
            return redirect()->route('administrador_usuarios.index');
        }else
        {//actualización de usuario
            
            
            $editar_usuario=User::find($id);
           //dd($editar_usuario);
            $editar_usuario->rut                = $rut;
            $editar_usuario->nombre             = $nombre;
            $editar_usuario->email              = $email;
            $editar_usuario->estado             = $estado;
            $editar_usuario->perfil_id          = $perfil;
            $editar_usuario->nombre_usuario     = $nombre_usuario;
            $editar_usuario->apellido_paterno   = $apellido_paterno;
            $editar_usuario->password           = bcrypt("123456");

            $ChileRut=new ChileRut;
            $digitoVerificador = $ChileRut->digitoVerificador($request->rut);
           
            $editar_usuario->dv = $digitoVerificador;
           //dd($editar_usuario);
            $editar_usuario->save();
           // flash()->overlay('La información se actualizó exitosamente', 'Actualización de usuario');
            flash('La información se actualizó exitosamente', 'success');
            return redirect()->route('administrador_usuarios.index');
        }
        
       
    }

    public function filtros(Request $request)
    {
        //dd($request->page);
        $nombre= $request->get("nombre");
        $mail=  $request->get("mail");
        $estado= $request->get("estado");
        $perfil= $request->get("perfil");

         $filtros="?";
        if ($nombre) {
          $filtros.="nombre=".$nombre."&";
        }
        if ($mail) {
          $filtros.="mail=".$mail."&";
        }
        if ($estado) {
          $filtros.="estado=".$estado."&";
        }
        if ($perfil) {
          $filtros.="perfil=".$perfil."&";
        }
          
          

          $usuarios_query=$this->query($nombre,$mail,$estado,$perfil);

          $usuarios_colleccion=collect($usuarios_query);
          $usuarios= $this->paginate($usuarios_colleccion);
          //dd($usuarios);
          $path="/ADNLaravel/public/filtro_usuarios".$filtros;
        
            $usuarios->setPath($path);
            //dd($usuarios);
         
          return view('administrador_usuario.administrador_usuario',compact('usuarios','request'));

    }
    
          
        
    

    protected function paginate($items, $perPage = 17)
    {

       // dd($items);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
      
        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage);
        
        return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    }

    protected function query($nombre,$mail,$estado,$perfil)
    {

       

          $condicion = " 0=0";

      if($nombre != ""){
        $condicion.= " and nombre ilike '".$nombre."%' or apellido_paterno ilike '".$nombre."%'";
      }
      if($mail != ""){
        $condicion.= " and email like '%".$mail."%'";
      }
      if($estado != ""){
        $condicion .= " and estado = '".$estado."'";
      }
      if($perfil != ""){
        $condicion .= " and perfil = '".$perfil."'";
      }

        $q="select  
                u.id,
                u.rut,
                u.dv,
                u.nombre,
                u.apellido_paterno,
                u.email,
                u.estado,
                u.nombre_usuario,
                p.perfil
                from users u
                inner join perfil_usuarios p on (u.perfil_id = p.id)
                where".$condicion."order by u.id";

             

      return $usuarios = DB::select($q);
       
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

        $usuarios=User::select('users.id', 'users.rut', 'users.dv', 'users.nombre', 'users.apellido_paterno', 'users.email', 'users.estado', 'users.nombre_usuario', 'perfil_usuarios.perfil')->join('perfil_usuarios','users.perfil_id','=','perfil_usuarios.id')->orderBy('users.id')
          ->paginate(17);
        $usuario_editar=User::find($id);
        $request=new Request;
        //dd($usuario_editar);
        return view('administrador_usuario.administrador_usuario',compact('usuario_editar','usuarios','request'));
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
        //
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
