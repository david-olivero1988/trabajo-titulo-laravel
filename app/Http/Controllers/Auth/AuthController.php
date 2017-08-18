<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

//agregan 

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Lang;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    

       protected $redirectTo = 'listado_campanas';
        //protected $username = 'rut';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin(){

        return view('auth.login');

    }


     
    public function postLogin(Request $request)
    {
        //dd($this->login($request));
        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();
        //dd($request);
        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
       // dd($credentials["password"]);
       // if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

        $existe=User::where('rut',$credentials["rut"])->first();
       // dd($existe);
        if($existe)
        {
           
            if($existe->estado=="Activo")
            {

            

                if(Auth::attempt(['rut' => $credentials["rut"], 'password' => $credentials["password"], 'estado' => 'Activo'])){

                    return $this->handleUserWasAuthenticated($request, $throttles);
                
                }
            }else
            {
                return redirect()->back()
                    ->withInput($request->only($this->loginUsername(), 'remember'))
                    ->withErrors([
                        $this->loginUsername() => $this->getFailedLoginMessageActivo(),
                    ]);
            }

         }else
         {
           
            return redirect()->back()
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessageRut(),
                ]);

        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        //dd($this->loginUsername());
        $this->validate($request, [
            /*$this->loginUsername()*/ 'rut' => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        //dd($request);
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {  // dd(Lang::has('auth.failed'));
        return Lang::has('auth.failed')
                ? 'El RUT y/o la clave es(son) incorrecto(s)'
                : 'These credentials do not match our records.';
    }

    protected function getFailedLoginMessageRut()
    {  // dd(Lang::has('auth.failed'));
        return Lang::has('auth.failed')
                ? 'El RUT ingresado no está en los registros de usuarios.'
                : 'These credentials do not match our records.';
    }

    protected function getFailedLoginMessageActivo()
    {  // dd(Lang::has('auth.failed'));
        return Lang::has('auth.failed')
                ? 'El RUT ingresado está inactivo y sin acceso al sistema'
                : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->logout();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {
        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        //dd(property_exists($this, 'username') ? $this->username : "rut");
        return property_exists($this, 'username') ? $this->username : "rut";
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }



  /*  public function postLogin(Request $request){
       
//reglas de validación
        $this->validate($request, [
            'rut'=>'required',
            'dv'=>'required',
            'password'=>'required'
            ]);

//validación
//dd();
/*
        $user= new User;
       $user->rut="12345678";
       $user->dv="1";
       $user->password=bcrypt("123456");
       $user->email="davidoliverom@gmail.com";
       $user->save();
       */
     //  $credentials = $request->only('rut','password');
       


//dd($credentials);
        //$user = User::where('rut', '=', $request->rut)->first();
     // dd(Auth::attempt($credentials, $request->has('remember')));

       //dd();
        //$this->auth->attempt($credentials, $request->has('remember'))
        /*if(Auth::attempt($credentials)){
            //dd(Auth::check());
           // dd(Auth::guest());
           // dd(Auth::user());
           // dd($this->auth->guest());
          //  dd($this->auth);
            //Auth::guard($this->getGuard())->user();
            dd(Auth::user());
            return redirect('listado_campañas');
        }

        return view('login.login')->with("msjerror","credenciales incorrectas");

    } */


    
}
