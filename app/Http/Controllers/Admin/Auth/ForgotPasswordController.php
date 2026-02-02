<?php

namespace App\Http\Controllers\Admin\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Notifications\ForgotPassword\ForgotAdminPassword;
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
        return view('admin.auth.passwords.email');
    }

    public function verify(Request $request){
        $validator = $this->validate($request , [
            'email' => 'required|email',
        ]);

        $admin_email = Admin::where('email',$request->email)->first();

        if ($admin_email) {
            $admin_email->notify(new ForgotAdminPassword());
            Toastr()->success('Un email vous a été envoye merci de vérifier', 'Evnoi d\'email', ["positionClass" => "toast-top-right"]);
            return redirect()->route('utilisateur.index');
        }else {
            Toastr()->error('Cette adresse email n\'éxiste pas', 'Email inéxistant', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function confirm($id,$email){
        $admin_confirm = Admin::where('id',$id)->where('email',$email)->first();
        $token= str_replace('/','',Hash::make(Str::random(40)));
        if($admin_confirm){
            return view('admin.auth.passwords.reset',compact('admin_confirm','id','token','email'));
        }
    }

    public function update(Request $request,$email){
        $this->validate($request,[
            'password' => ['required', 'string', 'confirmed',
            Password::min(8)->letters() ->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        $token = $request->token;
        if ($token) {
            $update_admin_email = Admin::where('email',$email)->first();
            
            if ($update_admin_email) {
                $update_admin_email->update(['password' => Hash::make($request->password)]);
                Toastr()->success('Votre mot de passe a bien été reinitialisé', 'Reinitialisation de mot de passe', ["positionClass" => "toast-top-right"]);
                return redirect()->route('admin.login');
            }else {
                Toastr()->error('cette adresse email n\'éxiste pas', 'Email inexistant', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
        Toastr()->error('Ce lien n\'est plus valide', 'Lien invalide', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
