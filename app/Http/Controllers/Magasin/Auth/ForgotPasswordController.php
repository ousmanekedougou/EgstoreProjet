<?php

namespace App\Http\Controllers\Magasin\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Magasin\Magasin;
use App\Notifications\ForgotPassword\ForgotMagasinPassword;
use Illuminate\Validation\Rules\Password;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function reset(){
        return view('magasin.auth.passwords.email');
    }

    public function verify(Request $request){
        $validator = $this->validate($request , [
            'email' => 'required|email',
        ]);

        $admin_email = Magasin::where('email',$request->email)->first();

        if ($admin_email) {
            $admin_email->notify(new ForgotMagasinPassword());
            Toastr()->success('Un email vous été envoyer merci de verifier', 'Envoi d\'email', ["positionClass" => "toast-top-right"]);
            return redirect()->route('utilisateur.index');
        }else {
            Toastr()->error('Cette adresse email n\'existe pas', 'Email inexistant', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function confirm($id,$email){
        $admin_confirm = Magasin::where('id',$id)->where('email',$email)->first();
        $token= str_replace('/','',Hash::make(Str::random(40)));
        if($admin_confirm){
            return view('magasin.auth.passwords.reset',compact('admin_confirm','id','token','email'));
        }
    }

    public function update(Request $request,$email){
        $this->validate($request,[
            'password' => ['required', 'string', 'confirmed',
            Password::min(8)->letters() ->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        
        $token = $request->token;
        if ($token) {
            $update_admin_email = Magasin::where('email',$email)->first();
            
            if ($update_admin_email) {
                $update_admin_email->update(['password' => Hash::make($request->password)]);
                Toastr()->success('Votre mot de passe a bien été modifié, Veillez vous connecter a nouveau', 'Modification de mot de passe', ["positionClass" => "toast-top-right"]);
                return redirect()->route('magasin.login');
            }else {
                Toastr()->error('Cette adresse email n\'existe pas', 'Email inexistant', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
        Toastr()->error('Cette requete n\'est plus valide', 'Requete invalide', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
