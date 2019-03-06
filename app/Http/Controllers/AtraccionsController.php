<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Atraccion;
use \App\TipusAtraccions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Image;
use PDF;
use Carbon;


class AtraccionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $atraccionetes = DB::table('tipus_atraccions')
            ->join('atraccions', 'atraccions.tipus_atraccio', '=', 'tipus_atraccions.id')
            ->get([
              'tipus_atraccions.tipus as nom',
              'tipus_atraccions.id as id_tipus',
              'atraccions.nom_atraccio',
              'atraccions.tipus_atraccio',
              'atraccions.data_inauguracio',
              'atraccions.altura_min',
              'atraccions.altura_max',
              'atraccions.accessibilitat',
              'atraccions.acces_express',
              'atraccions.id',
              'atraccions.path',
              'atraccions.descripcio'

            ]);

        $atraccions = Atraccion::all();
        return view('gestio/atraccions/index', compact('atraccionetes'));
      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipusAtraccions = TipusAtraccions::all();

        return view('gestio/atraccions/create', compact('tipusAtraccions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'alturamin' => 'required|integer',
            'alturamax' => 'required|integer'
        ]);

        $file = $request->file('image');
        $file_name = time() . $file->getClientOriginalName();
        $file_path = 'storage/atraccions';
        $img = Image::make($file->getRealPath())->resize(800, 600)
        ->save($file_path."/".$file_name);
        
        $atraccio = new Atraccion([
            'nom_atraccio' => $request->get('nom'),
            'tipus_atraccio' => $request->get('tipusatraccio'),
            'data_inauguracio' => $request->get('datainauguracio'),
            'altura_min' => $request->get('alturamin'),
            'altura_max' => $request->get('alturamax'),
            'accessibilitat' => $request->get('accessible'),
            'acces_express' => $request->get('accesexpress'),
            'descripcio' => $request->get('descripcio'),
            'path' => "/".$file_path."/".$file_name,
        ]);

        $atraccio->save();
        return redirect('/gestio/atraccions')->with('success', 'atraccio afegida');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $atraccio  = Atraccion::findOrFail($id);
      return view('gestio/atraccions/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atraccio = Atraccion::find($id);
        $tipus = TipusAtraccions::all();

        return view('gestio/atraccions/edit', compact('atraccio','tipus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $atraccio = Atraccion::findOrFail($id);

        $atraccio->nom_atraccio = $request->get('nom');
        $atraccio->tipus_atraccio = $request->get('tipusatraccio');
        $atraccio->data_inauguracio = $request->get('datainauguracio');
        $atraccio->altura_min = $request->get('alturamin');
        $atraccio->altura_max = $request->get('alturamax');
        $atraccio->accessibilitat = $request->get('accessible');
        $atraccio->acces_express = $request->get('accesexpress');
        
        if ($request->has('image')) {
            $image_path = public_path().$atraccio->path;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        

            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file_path = 'storage/atraccions';
            $img = Image::make($file->getRealPath())->resize(800, 600)
            ->save($file_path."/".$file_name);    
            
            $atraccio->path = "/".$file_path."/".$file_name;
        }
            $atraccio->save();
//$path=Storage::put($imageName, $laruka2);
//request()->image->move(public_path('images'), $imageName);

        

        return redirect('/gestio/atraccions')->with('success', 'atraccio modificada');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atraccio = Atraccion::find($id);
        $atraccio->delete();
        return redirect('/gestio/atraccions')->with('success', 'atraccio suprimida correctament');

    }


    public function guardarPDF()
    {
        $atraccionetes = DB::table('tipus_atraccions')
        ->join('atraccions', 'atraccions.tipus_atraccio', '=', 'tipus_atraccions.id')
        ->get([
          'tipus_atraccions.tipus as nom',
          'tipus_atraccions.id as id_tipus',
          'atraccions.nom_atraccio',
          'atraccions.tipus_atraccio',
          'atraccions.data_inauguracio',
          'atraccions.altura_min',
          'atraccions.altura_max',
          'atraccions.accessibilitat',
          'atraccions.acces_express',
          'atraccions.id',
          'atraccions.path',
          'atraccions.descripcio'

        ]);

        $mytime = Carbon\Carbon::now();
        $temps = $mytime->toDateString();

        $atraccions = Atraccion::all();
        $pdf = PDF::loadView('/gestio/atraccions/pdf', compact('atraccionetes'));
        return $pdf->download('atraccions'.$temps.'.pdf');

    }
 
}
