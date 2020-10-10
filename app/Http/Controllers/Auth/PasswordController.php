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

    public function reset(Request $request)
    {

        $this->validate(
            $request,
            $this->getResetValidationRules(),
            $this->getResetValidationMessages(),
            $this->getResetValidationCustomAttributes()
        );

        if ($this->validacion($request)) {

            return view("auth.passwords.reset")->with($request->token);
        }
        $credentials = $this->getResetCredentials($request);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->reset($credentials, function ($user, $password) {

            $this->resetPassword($user, $password);
        });


        switch ($response) {
            case Password::PASSWORD_RESET:

                return $this->getResetSuccessResponse($response);
            default:

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

        $user = User::where("rut", $request->rut)->where("dv", $request->dv)->first();

        if (!$user) {

            $valor = 0;
            flash('El RUT ingresado es inválido.', 'info');
            return view('auth.password');
        }

        $email = $user->email;

        return redirect()->action('Auth\PasswordController@postEmail', compact('email'));
    }

    protected function getResetSuccessResponse($response)
    {

        $actualizacion = "si";


        return redirect()->action('CampaniaController@index', compact("actualizacion"));
    }

    protected function getResetFailureResponse(Request $request, $response)
    {

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateSendResetLinkEmail($request);
        $broker = $this->getBroker();


        $response = Password::broker($broker)->sendResetLink(
            $this->getSendResetLinkEmailCredentials($request),
            $this->resetEmailBuilder()
        );

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

        flash('Hemos enviado un link a tu correo electrónico para que recuperes tu clave.', 'info');
        return view('auth.password'); //->with('status', 'algo'));//trans($response));

    }

    protected function getSendResetLinkEmailFailureResponse($response)
    {
        flash('No se ha logrado enviar un mail de recuperación, contacte al administrador.', 'info');
        return view('auth.password');
    }

    protected function getEmailSubject()
    {
        return property_exists($this, 'subject') ? $this->subject : 'Recuperación de clave ADN';
    }

}
