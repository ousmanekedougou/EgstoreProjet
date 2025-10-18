<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Magasin;
use App\Models\Magasin\Product;
use App\Models\Magasin\Supply;
use App\Models\Magasin\SupplyOrder;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SupplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['isMagasinAgent']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('magasin.supplies.index',[
            'magasins' => Magasin::where('is_active',1)->where('confirmation_token',null)->where('id','!=',AuthMagasinAgent())->get(),
            // 'supplyExists' => Supply::where('owner_id',AuthMagasinAgent())->get()
        ]);
    }

    public function addSupply(int $id){
        $magasin = Magasin::where('is_active',1)->where('confirmation_token',null)->where('id',$id)->first();
        $supplyExist = Supply::where('owner_id',AuthMagasinAgent())->where('magasin_id',$magasin->id)->first();
        if ($supplyExist) {
            Toastr()->error('Ce magasin est déjà ajouté comme fournisseur', 'Ce magasin éxiste', ["positionClass" => "toast-top-right"]);
            return back();
        }else {
            Supply::create([
                'owner_id' => AuthMagasinAgent(),
                'magasin_id' => $magasin->id,
                'slug' => str_replace('/','',Hash::make(Str::random(2).$magasin->name)),
            ]);
            Toastr()->success('Ce magasin a été ajouté comme fourniseur', 'Ajout fournisseur', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('magasin.supplies.supplie',[
            'supplies' => Supply::where('owner_id',AuthMagasinAgent())->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|string|email|unique:supplies',
            'phone' => 'required|numeric|unique:supplies',
            'adresse' => 'required|string',
            'ninea' => 'required|string|unique:supplies',
            'registre_com' => 'required|string|unique:supplies',
            'visible' => 'required|boolean',
        ]);

        $imageName = '';
        if($request->image != null){
            $this->validate($request,[
                'image' => 'required|image|mimes:PNG,png,JPG,jpg,JPEG,jpeg,webp',
            ]);
            if(request()->hasFile('image'))
            {
                $file = request()->file('image');

                $Name = request()->name.'-'.time().'.'. $file->getClientOriginalExtension();
                if (!is_dir(storage_path("app/public/Supplies"))) {
                    mkdir(storage_path("app/public/Supplies/"), 0775, true);
                }
                $image = Image::read($file);
                // Resize image
                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/Supplies/' . $Name));

                $imageName = 'public/Supplies/'. $Name;
            }
        }

        // dd($request->all());

        Supply::create([
            'name' => $request->name,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'ninea' => $request->ninea,
            'registre_com' => $request->registre_com,
            'image' => $imageName,
            'status' => $request->visible,
            'owner_id' => AuthMagasinAgent(),
            'magasin_id' => null,
        ]);

        Toastr()->success('Votre fourniseur a été ajouté avec succéss', 'Ajout fournisseur', ["positionClass" => "toast-top-right"]);
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $magasin = Magasin::where('slug',$slug)
        ->where('is_active',1)->where('confirmation_token',null)
        ->where('id','!=',AuthMagasinAgent())
        ->first();
        $duration = '';
        if ($magasin->created_at->diffInDays(now()) < 30) {
            $duration = $magasin->created_at->diffInDays(now())." jour(s)";
        }elseif ($magasin->created_at->diffInMonths(now()) < 12) {
            $duration = $magasin->created_at->diffInMonths(now())." moi(s)";
        }else{
            $duration = $magasin->created_at->diffInYearss(now())." an(s)";
        }
        return view('magasin.supplies.magasin_show',
            [
                'magasin' => $magasin,
                'products' => Product::where('magasin_id',$magasin->id)
                    ->inRandomOrder()
                    ->limit(12)
                    ->orderBy('id','DESC')
                    ->get(),
                'duration' => $duration
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function about($slug)
    {
        
        $supply = Supply::where('slug',$slug)->first();
        // dd($supply->magasin->name);
        // $magasin = Magasin::where('id',$supply->magasin_id)
        // ->where('is_active',1)->where('confirmation_token',null)
        // ->where('id','!=',AuthMagasinAgent())
        // ->first();
        if ($supply->magasin->is_active == 1 && $supply->magasin->confirmation_token == null && $supply->magasin->id != AuthMagasinAgent()) 
        {
            $duration = '';
            if ($supply->magasin->created_at->diffInDays(now()) < 30) {
                $duration = $supply->magasin->created_at->diffInDays(now())." jour(s)";
            }elseif ($supply->magasin->created_at->diffInMonths(now()) < 12) {
                $duration = $supply->magasin->created_at->diffInMonths(now())." moi(s)";
            }else{
                $duration = $supply->magasin->created_at->diffInYearss(now())." an(s)";
            }
            return view('magasin.supplies.supplie_show',
                [
                    'magasin' => $supply->magasin,
                    'products' => Product::where('magasin_id',$supply->magasin->id)
                        ->inRandomOrder()
                        ->limit(12)
                        ->orderBy('id','DESC')
                        ->get(),
                    'duration' => $duration
                ]
            );
        }else{
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // dd($request->image);
        $supplyUpdate = Supply::where('id',$id)->where('owner_id',AuthMagasinAgent())->first();
        $imageName = null;
        if($request->image != null){
            $this->validate($request,[
                'image' => 'required|image|mimes:PNG,png,JPG,jpg,JPEG,jpeg,webp',
            ]);
            if(request()->hasFile('image'))
            {
                $file = request()->file('image');

                $Name = request()->name.'-'.time().'.'. $file->getClientOriginalExtension();
                $image = Image::read($file);
                // Resize image
                $image->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/Supplies/' . $Name));

                $imageName = 'public/Supplies/'. $Name;
                Storage::delete($supplyUpdate->image);
            }
        }else{
            $imageName = $supplyUpdate->image;
        }


        $supplyUpdate->update([
            'name' => $request->name,
            'slug' => str_replace('/','',Hash::make(Str::random(2).$request->name)),
            'email' => $request->email,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'ninea' => $request->ninea,
            'registre_com' => $request->registre_com,
            'image' => $imageName,
            'status' => $request->visible,
            'owner_id' => AuthMagasinAgent(),
            'magasin_id' => null,
        ]);

        Toastr()->success('Votre fourniseur a été modifié avec succéss', 'Ajout fournisseur', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $supplyGet = Supply::where('id',$id)->where('owner_id',AuthMagasinAgent())->first();
        $supplyOrder = SupplyOrder::where('supply_id',$supplyGet->id)->where('owner_id',AuthMagasinAgent())->where('status',2)->where('delivery',2)->first();
        if($supplyOrder){
            if ($supplyGet->magasin_id == null) {
                Storage::delete($supplyGet->image);
            }
            $supplyGet->delete();
            Toastr()->success('Fournisseur a été supprimé avec success', 'Suppréssion fournisseur', ["positionClass" => "toast-top-right"]);
            return back();
        }else{
            Toastr()->warning('Suppression impossible ce fornisseur a des commande en cours', 'Suppréssion fournisseur', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }
}
