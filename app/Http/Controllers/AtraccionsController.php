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
use \App\AssignacioAtraccion;


use \App\Horari;
use \App\Rol;
use \App\DadesEmpleat;
use \App\User;


class AtraccionsController extends Controller
{
    private $data_inici_global;

    private $data_fi_global;
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


    public function assigna()
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

        //$atraccions = Atraccion::all();
        return view('/gestio/atraccions/assigna', compact('atraccionetes'));
    }


    public function crearAssignacioManteniment(Request $request, $id)
    {

    //  dd($request->get('data_fi_assignacio_empleat'));


        $atraccio = Atraccion::find($id);
        $users = User::whereNotNull('email_verified_at')
        ->where('id_rol',3)
        ->whereNotNull('id_dades_empleat')
        ->leftJoin('dades_empleats','dades_empleats.id', 'users.id_dades_empleat')
        ->leftJoin('rols','rols.id', 'users.id_rol')
        ->leftJoin('horaris', 'horaris.id', 'dades_empleats.id_horari')
        ->get([
            'users.id as id',
            'users.nom as nom',
            'users.cognom1',
            'users.cognom2',
            'users.email',
            'users.password',
            'users.data_naixement',
            'users.adreca',
            'users.ciutat',
            'users.provincia',
            'users.codi_postal',
            'users.tipus_document',
            'users.numero_document',
            'users.sexe',
            'users.telefon',
            'users.cognom2',
            'users.id_rol',
            'dades_empleats.codi_seg_social as codi_seg_social',
            'dades_empleats.num_nomina as num_nomina',
            'dades_empleats.IBAN as IBAN',
            'dades_empleats.especialitat as especialitat',
            'dades_empleats.carrec as carrec',
            'dades_empleats.data_inici_contracte as data_inici_contracte',
            'dades_empleats.data_fi_contracte as data_fi_contracte',
            'horaris.torn as id_horari',
        ]);
        $data_inici_global = $request->get('data_inici_assignacio_empleat');

        $data_fi_global = $request->get('data_fi_assignacio_empleat');



        return view('/gestio/atraccions/crearassignaciomanteniment', compact('users', 'atraccio', 'data_fi_global'));
    }

    public function crearAssignacioMantenimentDate(Request $request, $id)
{
//        $id = 1;

        $atraccio = Atraccion::find($id);
        return view('/gestio/atraccions/crearassignaciomantenimentdate', compact('atraccio','data_fi_global'));
    }


    public function crearAssignacioNeteja($id)
    {
        $atraccio = Atraccion::find($id);
        $users = User::whereNotNull('email_verified_at')
        ->where('id_rol',4)
        ->whereNotNull('id_dades_empleat')
        ->leftJoin('dades_empleats','dades_empleats.id', 'users.id_dades_empleat')
        ->leftJoin('rols','rols.id', 'users.id_rol')
        ->leftJoin('horaris', 'horaris.id', 'dades_empleats.id_horari')
        ->get([
            'users.id',
            'users.nom',
            'users.cognom1',
            'users.cognom2',
            'users.email',
            'users.password',
            'users.data_naixement',
            'users.adreca',
            'users.ciutat',
            'users.provincia',
            'users.codi_postal',
            'users.tipus_document',
            'users.numero_document',
            'users.sexe',
            'users.telefon',
            'users.cognom2',
            'users.id_rol',
            'dades_empleats.codi_seg_social as codi_seg_social',
            'dades_empleats.num_nomina as num_nomina',
            'dades_empleats.IBAN as IBAN',
            'dades_empleats.especialitat as especialitat',
            'dades_empleats.carrec as carrec',
            'dades_empleats.data_inici_contracte as data_inici_contracte',
            'dades_empleats.data_fi_contracte as data_fi_contracte',
            'horaris.torn as id_horari',
        ]);

        return view('/gestio/atraccions/crearassignacioneteja', compact('users','atraccio'));
    }


    public function crearAssignacioGeneral($id)
    {
        $atraccio = Atraccion::find($id);

        $users = User::whereNotNull('email_verified_at')
        ->where('id_rol',5)
        ->whereNotNull('id_dades_empleat')
        ->leftJoin('dades_empleats','dades_empleats.id', 'users.id_dades_empleat')
        ->leftJoin('rols','rols.id', 'users.id_rol')
        ->leftJoin('horaris', 'horaris.id', 'dades_empleats.id_horari')
        ->get([
            'users.id',
            'users.nom',
            'users.cognom1',
            'users.cognom2',
            'users.email',
            'users.password',
            'users.data_naixement',
            'users.adreca',
            'users.ciutat',
            'users.provincia',
            'users.codi_postal',
            'users.tipus_document',
            'users.numero_document',
            'users.sexe',
            'users.telefon',
            'users.cognom2',
            'users.id_rol',
            'dades_empleats.codi_seg_social as codi_seg_social',
            'dades_empleats.num_nomina as num_nomina',
            'dades_empleats.IBAN as IBAN',
            'dades_empleats.especialitat as especialitat',
            'dades_empleats.carrec as carrec',
            'dades_empleats.data_inici_contracte as data_inici_contracte',
            'dades_empleats.data_fi_contracte as data_fi_contracte',
            'horaris.torn as id_horari',
        ]);


        return view('/gestio/atraccions/crearassignaciogeneral', compact('users', 'atraccio'));
    }


    public function guardarAssignacio(Request $request, $id)
    {
        $atraccio = Atraccion::find($id);

        $request->validate([
            'id_empleat'=>['required', 'integer'],
            'id_atraccio'=>['required', 'integer'],
            'data_inici'=>['required', 'date'],
            'data_fi'=>['required', 'date'],
        ]);
        $assignacio = new AssignacioAtraccion([
            'id_empleat'=>$request->get('id_empleat'),
            'id_atraccio'=>$request->get('id_atraccio'),
            'data_inici'=>$request->get('data_inici_assignacio_empleat'),
            'data_fi'=>$request->get('data_fi_assignacio_empleat')
        ]);
        $assignacio->save();

        return redirect('/gestio/atraccions/assigna')->with('success', 'OK bro :)');
    }

        public function assignacions()
        {
            $assignacio = DB::table('assign_emp_atraccions')
            ->leftJoin('users','users.id', 'assign_emp_atraccions.id_empleat')
            ->leftJoin('atraccions','atraccions.id', 'assign_emp_atraccions.id_atraccio')
            ->leftJoin('rols','rols.id', 'users.id')
                  ->get([
                    'assign_emp_atraccions.id as id',
                    'assign_emp_atraccions.id_empleat as id_empleat',
                    'assign_emp_atraccions.id_atraccio as id_atraccio',
                    'assign_emp_atraccions.data_inici as data_inici',
                    'assign_emp_atraccions.data_fi as data_fi',
                    'users.nom as nom_empleat',
                    'users.cognom1 as cognom_empleat',
                    'atraccions.nom_atraccio as nom_atraccio',
                    'rols.nom_rol as nom_rol'
                ]);

            return view('gestio/atraccions/assignacions', compact('assignacio'));

        }

        public function editAssignacions($id)
        {
            $assignacio = AssignacioAtraccion::find($id);
            $dades_user = User::find($assignacio->id_empleat);
            $dades_atraccio =Atraccion::find($assignacio->id);

            return view('gestio/atraccions/editAssignacions', compact(['assignacio','dades_user','dades_atraccio']));
        }

        public function updateAssignacions(Request $request, $id)
        {

            $assignacio = AssignacioAtraccion::findOrFail($id);

            $assignacio->data_inici = $request->get('data_inici');
            $assignacio->data_fi = $request->get('data_fi');

            $assignacio->save();



            return redirect('/gestio/atraccions/assignacions')->with('success', 'Assignacio modificada correctament');

        }

        public function destroyAssignacions($id)
        {
            $assignacio = AssignacioAtraccion::find($id);
            $assignacio->delete();

            return view('/gestio/atraccions/assignacions'->with('success', 'Assignacio suprimida correctament'));
        }




}
