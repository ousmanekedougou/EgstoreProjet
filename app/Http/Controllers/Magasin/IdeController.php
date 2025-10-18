<?php

namespace App\Http\Controllers\Magasin;

use App\Http\Controllers\Controller;
use App\Models\Magasin\Ide;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
class IdeController extends Controller
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
        return view('magasin.ides.index',
        [
            'ides' => Ide::where('magasin_id',AuthMagasinAgent())->orderBy('id','desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'sujet' => 'required|string',
            'msg' => 'required|string',
        ]);

        $logoName = '';
        if(request()->hasFile('image'))
        {
            $file = request()->file('image');

            $NameLogo = time().'.'. $file->getClientOriginalExtension();
            $imageLogo = Image::read($file);
            // Resize image
            if (!is_dir(storage_path("app/public/Idées"))) {
                mkdir(storage_path("app/public/Idées"), 0775, true);
            }
            $imageLogo->resize(360, 338, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/Idées/' . $NameLogo));

            $logoName = 'public/Idées/'. $NameLogo;
        }

        Ide::create([
            'sujet' => $request->sujet,
            'msg' => $request->msg,
            'image' => $logoName,
            'magasin_id' => AuthMagasinAgent()
        ]);

        Toastr()->success('Votre idée ou suggestion a bien été ajoutée', 'Ajout d\'idées', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
