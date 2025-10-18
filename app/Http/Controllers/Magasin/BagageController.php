<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Bagage;
use App\Models\Magasin\Commande;
use App\Models\Magasin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BagageController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function post(Request $request){
        $this->validate($request,[
            'inputs' => 'required',
        ]);

        // dd($request->inputs);

        foreach ($request->inputs as $input) 
        {
            Bagage::create([
                'name' => $input['name'],
                'slug' => str_replace('/','',Hash::make(Str::random(2).$input['name'])),
                'reference' => $input['reference'],
                'price' => $input['price'],
                'quantity' => $input['qty'],
                'type' => $request->type,
                'amount' => $input['price'] * $input['qty'],
                'date' => now(),
                'magasin_id' => AuthMagasinAgent(),
                'commande_id' => $request->reserve_id
            ]);
        }

        $amountBagageTotal = Bagage::where('commande_id',$request->reserve_id)->where('magasin_id',AuthMagasinAgent())->sum('amount');
        // dd($commande);
        Commande::where('id',$request->reserve_id)
            ->where('magasin_id',AuthMagasinAgent())
            ->where('type',1)->update(['amount' => $amountBagageTotal ]);

        Toastr()->success('Votre bagage a bien été ajouté', 'Ajout de bagages', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'inputs' => 'required',
        // ]);
        // foreach ($request->inputs as $input) 
        // {
        //     Bagage::create([
        //         'name' => $input['name'],
        //         'slug' => str_replace('/','',Hash::make(Str::random(2).$input['name'])),
        //         'reference' => $input['reference'],
        //         'price' => $input['price'],
        //         'quantity' => $input['qty'],
        //         'type' => $request->type,
        //         'amount' => $input['price'] * $input['qty'],
        //         'date' => now(),
        //         'magasin_id' => AuthMagasinAgent(),
        //         'commande_id' => $request->reserve_id
        //     ]);
        // }

        $this->validate($request,[
            'unique_code' => 'required|string',
            'quantity' => 'required|numeric',
        ]);

        $item_product = Product::where('unique_code',$request->unique_code)->where('magasin_id',AuthMagasinAgent())->first();
        // dd($item_product);
        $bagage_existe = Bagage::where('unique_code',$request->unique_code)->where('color',$request->color)->where('size',$request->size)->first();
        // dd($bagage_existe);
        if(!$bagage_existe){

            if($item_product->quantity > 0){
                if ($item_product->quantity >= $request->quantity) {
                    
                    Bagage::create([
                        'name' => $item_product->name,
                        'slug' => $item_product->slug,
                        'reference' => $item_product->reference,
                        'price' => $item_product->price,
                        'quantity' => $request->quantity,
                        'image' => $item_product->image,
                        'type' => $request->type,
                        'amount' => $item_product->price * $request->quantity,
                        'date' => now(),
                        'color' => $request->color,
                        'size' => $request->size,
                        'unique_code' => $item_product->unique_code,
                        'exp_date' => $item_product->exp_date,
                        'magasin_id' => AuthMagasinAgent(),
                        'commande_id' => $request->reserve_id
                    ]);

                    $amountBagageTotal = Bagage::where('commande_id',$request->reserve_id)->where('magasin_id',AuthMagasinAgent())->sum('amount');
                    // dd($amountBagageTotal);
                    Commande::where('id',$request->reserve_id)
                    ->where('magasin_id',AuthMagasinAgent())
                    ->where('type',0)->update(['amount' => $amountBagageTotal ]);

                    $item_product->update(['quantity' => $item_product->quantity - $request->quantity]);
                    
                    Toastr()->success('Votre bagage a bien été ajouté', 'Ajout de bagages', ["positionClass" => "toast-top-right"]);
                    return back();
                }else{
                    Toastr()->warning('Cette quantite n\'existe pas pour ce produit', 'Ajout de bagages', ["positionClass" => "toast-top-right"]);
                    return back();
                }
            }else{
                Toastr()->error('Ce produits est epuisé', 'Ajout de bagages', ["positionClass" => "toast-top-right"]);
                return back();
            }
        }else{
            Toastr()->warning('Ce produits est existe pour cette commande', 'Ajout de bagages', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // return view('magasin.bon.product',['product' => Bagage::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        // return view('magasin.produits.show',['product' => Bagage::where('slug',$slug)->where('magasin_id',AuthMagasinAgent())->first()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bagage = Bagage::where('id',$id)->where('magasin_id',AuthMagasinAgent())->first();

        $bagage->commande->update(['amount' => $bagage->commande->amount - $bagage->amount ]);
        
        $bagage->delete();
        Toastr()->success('Votre bagage a bien été supprimé', 'Suppréssion de bagages', ["positionClass" => "toast-top-right"]);
        return back();
    }
}
