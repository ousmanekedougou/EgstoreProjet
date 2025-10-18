<?php

namespace App\Http\Controllers\Agent\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Magasin\Agent;
use App\Notifications\ForgotPassword\ForgotAgentPassword;
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
        return view('agent.auth.passwords.email');
    }

    public function verify(Request $request){
        $validator = $this->validate($request , [
            'email' => 'required|email',
        ]);

        $admin_email = Agent::where('email',$request->email)->first();

        if ($admin_email) {
            $admin_email->notify(new ForgotAgentPassword());
            Toastr()->success('Un email vous a été envoyé marci de verifier', 'Envoi d\'email', ["positionClass" => "toast-top-right"]);
            return redirect()->route('utilisateur.index');
        }else {
            Toastr()->error('Cette adresse email n\'existe pas', 'Adresse email inexistant', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    public function confirm($id,$email){
        $admin_confirm = Agent::where('id',$id)->where('email',$email)->first();
        $token= str_replace('/','',Hash::make(Str::random(40)));
        if($admin_confirm){
            return view('agent.auth.passwords.reset',compact('admin_confirm','id','token','email'));
        }
    }

    public function update(Request $request,$email){
        $this->validate($request,[
            'password' => ['required', 'string', 'confirmed',
            Password::min(8)->letters() ->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        $token = $request->token;
        if ($token) {
            $update_admin_email = Agent::where('email',$email)->first();
            
            if ($update_admin_email) {
                $update_admin_email->update(['password' => Hash::make($request->password)]);
                Toastr()->success('Votre mot de passe a bien été reinitialisé', 'Reinitialisation de mot de passe', ["positionClass" => "toast-top-right"]);
                return redirect()->route('agent.login');
            }else {
                Toastr()->error('Cette adresse email n\'existe pas', 'Adresse email inexistant', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }
        Toastr()->error('Ce lien n\'est plus valide', 'Lien invalide', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
