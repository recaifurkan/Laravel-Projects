<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Models\Uye_resim;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login( Request $request)
    {
        $this->validateLogin($request);

        // var_dump($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

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
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        //?: back();
      
        return  $this->authenticated($request, $this->guard()->user()); 
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // dd($user->uye_isbanlandi);
        if($user->uye_isbanlandi == 1){
           return $this->bannedLogout($request);

        }

        return 'true';
    }

    public function bannedLogout(Request $request)
    {
         $this->guard()->logout();

        $request->session()->invalidate();
        
         
        
        if($this->loggedOut($request)){
           
           
            return  'banned';

        }
        
        
       
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
         $this->guard()->logout();

        $request->session()->invalidate();
        
         
        
        if($this->loggedOut($request)){
           
           
            return  redirect('/');

        }
        
        
       
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
        // $this->middleware('logout.cache');

        return true;
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($network)
    {
        return Socialite::driver($network)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($network)
    {
        if($network == 'google'){ // google işlemleri başlangıç
            $userSocial = Socialite::driver('google')->stateless()->user();

            // dd($userSocial->user['givenName']);
        } // google işlemleri bitiş

       
        
        else{ // facebook login işlemleri yapıldı
            $userSocial = Socialite::driver($network)->user();
            // dd($userSocial->avatar_original);
        
        } // facebook login işlemleri bitiş

        $user = User::where('email',$userSocial->email)->first();
        // dd($user);
        if(isset($user)){
            Auth::login($user);
            return redirect(route('anasayfa'));

        }
        else{
            $user = new User;
            $user->name = $userSocial->name;
            $user->email= $userSocial->email;
            $user->password = Hash::make('123456');
            $user->uyelik_tarihi = Carbon::now();
            $user->roller()->attach(1);

           
            $user->save();
        }

        // dd($user->name);
            $resim = file_get_contents($userSocial->avatar_original);
            $extension = 'jpg';
            // $uyeId = $user->id;
            $uyeId = $user->id;
            $filePath = 'uyeler/'.$uyeId;
            $fileName = 'user'.$uyeId.'.'.$extension;
            $databasePath = $filePath . '/'. $fileName;
            $sonuc = Storage::put($databasePath, $resim);
           if($sonuc){
            $profilImage = new Uye_resim;
            $profilImage->url = $databasePath;
           
            $sonuc =$profilImage->uye()->associate($user);
            $sonuc = $profilImage->save();
           
           }
           if($sonuc){
                Auth::login($user);
                return redirect(route('anasayfa'));
            }
           
            // dd($sonuc);
            // dd($fileName);
            // $sonuc = File::put($databasePath, $resim);
            // $sonuc = $resim->storeAs($filePath,$fileName );
            // dd($sonuc);
           
         
        // dd($fileContents);
        // File::put(public_path() . '/uploads/profile/' . $user->getId() . ".jpg", $fileContents);
        // dd($user);
      

        // $user->token;

        
    }
}
