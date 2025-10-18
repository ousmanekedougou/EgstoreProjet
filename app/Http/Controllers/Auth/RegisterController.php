<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User\User;
use App\Notifications\NouveauCompte\NouveauCompteClient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Illuminate\Validation\Rules\Password;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web')->except(['confirmCompte','validationCode']);
    }

    public function confirmCompte($id , $token){
        $code = request('code_1').''.request('code_2').''.request('code_3').''.request('code_4').''.request('code_5').''.request('code_6');
        
        define('ACTIVE',1);
        $user = User::where('id',$id)->where('confirmation_token',$token)->where('code_validation',intval($code))->first();
        if ($user) {
            $user->update(['confirmation_token' => null , 'is_active' => ACTIVE,'code_validation',null]);
            $this->guard()->login($user);
            Toastr()->success('Votre compte client a bien été confirmé', 'Confirmation de compte clients', ["positionClass" => "toast-top-right"]);
            return redirect($this->redirectPath());
        }else {
            Toastr()->success('Ce lien n\'est plus valide', 'Lien invalide', ["positionClass" => "toast-top-right"]);
            return redirect()->route('login');
        }
    }

    public function validationCode(Request $request ,$id , $token){
        $user = User::where('id',$id)->where('confirmation_token',$token)->first();
    }

     public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $user = User::where('email',$request->email)->where('phone',$request->phone)->first();
        $user->notify(new NouveauCompteClient());

        Toastr()->success('Votre client a bien été ajouté', 'Ajout de clients', ["positionClass" => "toast-top-right"]);
        return view('client.auth.mfa2',compact('user'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'adresse' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed',
                Password::min(8)->letters() ->mixedCase()->numbers()->symbols()->uncompromised()],
            'termsService' => ['required', 'boolean'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd('djdhdf');
        $code = $this->generateCode();
        $verify = User::where("code_validation", $code)->first() && 
            strlen($code) !== 6;

        if ($verify) {
            $newCode = $this->generateCode();
        }else {
            $newCode = $code;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'adresse' => $data['adresse'],
            'password' => Hash::make('password'),
            'slug' =>  str_replace('/','',Hash::make(Str::random(4).'client'.$data['email'])),
            'is_active' => 0,
            'termsService' => $data['termsService'],
            'code_validation'=> $newCode,
            'confirmation_token' => str_replace('/','',Hash::make(Str::random(40))), 
        ]);
    }

    protected function generateCode(int $lenght = 6) : string
	{
	   return Random::generate($lenght, "0-9");
	}


   
}
