<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\About;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Laravel\Facades\Image;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['isMagasin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duration = '';
        if (Auth::guard('magasin')->user()->created_at->diffInDays(now()) < 30) {
            $duration = Auth::guard('magasin')->user()->created_at->diffInDays(now())." jour(s)";
        }elseif (Auth::guard('magasin')->user()->created_at->diffInMonths(now()) < 12) {
            $duration = Auth::guard('magasin')->user()->created_at->diffInMonths(now())." moi(s)";
        }else{
            $duration = Auth::guard('magasin')->user()->created_at->diffInYearss(now())." an(s)";
        }
        return view('magasin.profile.index',
        [
            'auth_about' => About::where('magasin_id',Auth::guard('magasin')->user()->id)->first(),
            'auth_reseau' => Social::where('magasin_id',Auth::guard('magasin')->user()->id)->first(),
            'duration' => $duration
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateImageProfile($id)
    {
        $this->validate(request(),[
            'image' => 'image|mimes:PNG,png',
            'logo' => 'image|mimes:PNG,png', 
        ]);
        //update de l'image profile du magasinier
        // dd(request()->image);
        $imageName = '';
        if(request()->hasFile('image'))
        {
            // $imageName = request()()->file->store('public/Profiles/Images');
            $file = request()->file('image');

            $Name = request()->name.'-'.Auth::guard('magasin')->user()->name.'.'. $file->getClientOriginalExtension();
            $image = Image::read($file);
            // Resize image
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/Profiles' . $Name));

            $imageName = 'public/Profiles'. $Name;
        }else{
            $imageName = Auth::guard('magasin')->user()->image;
        }

        $logoName = '';
        if(request()->hasFile('logo'))
        {
            // $logoName = request()()->file->store('public/Logos');
            $file = request()->file('logo');

            $NameLogo = request()->name.'-'.Auth::guard('magasin')->user()->name.'.'. $file->getClientOriginalExtension();
            $imageLogo = Image::read($file);
            // Resize image
            $imageLogo->resize(360, 338, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/Logos' . $NameLogo));

            $logoName = 'public/Logos'. $NameLogo;
        }else{
            $logoName = Auth::guard('magasin')->user()->logo;
        }

        Magasin::find(Auth::guard('magasin')->user()->id)->update(['image' => $imageName,'logo' => $logoName]);

        Toastr()->success('Vos image ont bien été modifié', 'Modification des images', ["positionClass" => "toast-top-right"]);
        return back();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $auth_reseau = Social::where('magasin_id',Auth::guard('magasin')->user()->id)->first();
        if ( $auth_reseau) {
            $auth_reseau->update(
            [
                'facebook' => request()->facebook,
                'whatsapp' => request()->whatsapp,
                'instagram' => request()->instagram,
                'tiktok' => request()->tiktok,
            ]);
        }else {
            Social::create(
            [
                'facebook' => request()->facebook,
                'whatsapp' => request()->whatsapp,
                'instagram' => request()->instagram,
                'tiktok' => request()->tiktok,
                'magasin_id' => Auth::guard('magasin')->user()->id
            ]);
        }

        Toastr()->success('Vos réseaux sociaux ont bien été modifié', 'Modification de profiles', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request,[
            'admin_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'adresse' => ['required', 'string'],
        ]);

        // dd($request->shop_name);

        $password = null;
        $imageName = null;
        $logoName = null;

        
        if($request->password == null){
            $password = Auth::guard('magasin')->user()->password;
        }else {
            $this->validate($request,[ 'password' => ['confirmed',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            ]);
            $password = Hash::make($request->password);
        }

        // if($request->hasFile('logo'))
        // {
        //     $logoName = $request->logo->store('public/Profiles/Logos');
        // }else{
        //     $logoName = Auth::guard('magasin')->user()->logo;
        // }

        Magasin::find(Auth::guard('magasin')->user()->id)
        ->update(
        [
            'admin_name' => $request->admin_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'password' => $password,
        ]);

        Toastr()->success('Votre profile a bien été modifié', 'Modification de profiles', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_coordoonne(Request $request, string $id)
    {
        $this->validate($request,[
            'shop_name' => ['required', 'string'],
            'shop_phone' => ['required', 'numeric'],
            'visible' => ['required', 'boolean'],
        ]);


        $inv_at = null;
        if ($request->inv_at == null) {
            $inv_at = Auth::guard('magasin')->user()->inv_at;
        }else {
            $inv_at = $request->inv_at;
        }
        
        if ($request->prefix != null) {
            Magasin::find(Auth::guard('magasin')->user()->id)
            ->update(
                [
                    'name' => $request->shop_name,
                    'shop_phone' => $request->shop_phone,
                    'visible' => $request->visible,
                    'inv_at' => $inv_at,
                    'registre_com' => $request->rccm,
                    'prefix' => $request->prefix,
                    'ninea' => $request->ninea,
                ]);
                
            Toastr()->success('Vos coordonnées ont bien été modifié', 'Modification de coordonnées', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->error('Le prefix ne doit pas etre null', 'Modification de coordonnées', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

     /**
     * Update the specified resource in storage.
     */
    public function update_critere(Request $request, string $id)
    {
        // dd($request->all());
        $auth_about = About::where('magasin_id',Auth::guard('magasin')->user()->id)->first();

        if ( $auth_about) {
            $auth_about->update(
            [
                'our_history' => $request->our_history,
                'our_vision' => $request->our_vision,
                'our_mission' => $request->our_mission,
                'our_values' => $request->our_values,
                'our_invoice_info' => $request->our_invoice_info,
                'magasin_id' => Auth::guard('magasin')->user()->id
            ]);
        }else {
            About::create(
            [
                'our_history' => $request->our_history,
                'our_vision' => $request->our_vision,
                'our_mission' => $request->our_mission,
                'our_values' => $request->our_values,
                'our_invoice_info' => $request->our_invoice_info,
                'magasin_id' => Auth::guard('magasin')->user()->id
            ]);
        }

        

        Toastr()->success('Vos critères ont bien été modifié', 'Modification de profiles', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
