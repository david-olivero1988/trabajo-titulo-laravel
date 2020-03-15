<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
//
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laracasts\Flash\Flash;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */

    public function getEmail(Request $request)
    {
        //if($request->valor)
        // flash('El RUT ingresado no esta en los registros de usuarios.', 'danger');
        // flash()->overlay('Configuración exitosa!, se enviará un mensaje genérico cuando el RUT reciba '.$request->num_notificaciones.' o más notificaciones', 'Información');

        return view('auth.password');
    }

    protected function getResetCredentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }
    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:1',
        ];
    }


public function postEmail(Request $request){

    Mail::send('login.clave',$request->all(), function($msj){
    $msj->subject('correo de prueba');
    $msj->to('davidoliverom@gmail.com');
    });

    Flash::success("algo");

    return Redirect::to('login');

//return redirect()->route('login');
}


    public function reset(Request $request)
    {
        //dd();
        $this->validate(
            $request,
            $this->getResetValidationRules(),
            $this->getResetValidationMessages(),
            $this->getResetValidationCustomAttributes()
        );
//dd("distintos");
        if ($this->validacion($request)) {

            return view("auth.passwords.reset")->with($request->token);
        }
        $credentials = $this->getResetCredentials($request);

        $broker = $this->getBroker();

        //$user=User::where('email',$credentials['email']);
        //$password=$credentials['password'];
        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {
            //dd("algo");
            $this->resetPassword($user, $password);
        });
        // dd($response);
        //dd($response);
        switch ($response) {
            case Password::PASSWORD_RESET:
                // dd("bien");
                return $this->getResetSuccessResponse($response);
            default:
                // dd($response);
                return $this->getResetFailureResponse($request, $response);
        }
    }

    protected function validacion($req)
    {
        if ($req->password != $req->password_confirmation) {
            return true;
        }
        return false;
    }

    public function postEmails(Request $request)
    {

        $respuesta = User::where("rut", $request->rut)->where("dv", $request->dv)->first();
        if ($respuesta) {
            $email = $respuesta->email;
        } else {

            $valor = 0;
            flash('El RUT ingresado es inválido.', 'info');
            return view('auth.password');
            //flash('Error! Por favor ingresar horario PM o AM.', 'danger');
            //return redirect()->action('ConfiguracionGeneralController@index');
        }

        return redirect()->action('Auth\PasswordController@postEmail', compact("email"));
    }

    protected function getResetSuccessResponse($response)
    {
        //flash()->overlay('Tu clave se actualizó exitosamente', 'Recuperación de clave');
        $actualizacion = "si";
        //return redirect("listado_campanas");//->action('CampaniaController@index');//->with('status', trans($response));
        return redirect()->action('CampaniaController@index', compact("actualizacion"));
    }

    protected function getResetFailureResponse(Request $request, $response)
    {
        //dd(trans($response));
        // dd(['email' => trans($response)]);
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

###envio de mail trait################################################
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateSendResetLinkEmail($request);

        $broker = $this->getBroker();
        //dd($broker);
        $response = Password::broker($broker)->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request),
            $this->resetEmailBuilder()
        );
        //dd($response);
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);
            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }

    protected function getSendResetLinkEmailSuccessResponse($response)
    {

        // Session::flash('message', "Special message goes here");

        //dd("hola");
        //$resultado="si";
        flash('Hemos enviado un link a tu correo electrónico para que recuperes tu clave.', 'info');
        return view('auth.password'); //->with('status', 'algo'));//trans($response));

    }

    protected function getSendResetLinkEmailFailureResponse($response)
    {
        flash('No se ha logrado enviar un mail de recuperación, contacte al administrador.', 'info');
        return view('auth.password');
        //return redirect()->back()->withErrors(['email' => trans($response)]);
    }

    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Recuperación de clave ADN';
    }

###envio de mail trait################################################

}
