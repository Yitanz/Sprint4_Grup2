<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use \App\Incidencia;
use \App\PrioritatIncidencia;
use Auth;

use \App\Producte;
use \App\Tipus_producte;
use \App\Atributs_producte;
use \App\Cistella;
use \App\Linia_cistella;
use \App\Venta_productes;
use \App\Linia_ventes;
use \App\Atraccion;
use \App\User;
use \App\TipusAtraccions;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //Add Verified middleware
        //$this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function noticies()
    {
      return view('noticies');
    }

    public function promocions()
    {
      return view("promocions");
    }

    public function atraccions(){
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

      return view("atraccions", compact('atraccionetes'));
    }

    public function entrades()
    {
      $tipus_producte = Tipus_producte::all();

      return view("entrades", compact('tipus_producte'));
    }

    public function login()
    {
      return view("login");
    }

    public function contacte()
    {
      return view("contacte");
    }

    public function gestio()
    {
      return view("gestio/index");
    }

    public function perfil()
    {
      return view('perfil');
    }

    public function pizzeria()
    {
      return view('pizzeria');
    }

    public function form()
    {
      return view('form');
    }


    public function incidencia()
    {
      $prioritats = PrioritatIncidencia::all();

      return view('incidencia', compact('prioritats'));
    }

    /**
     * Store a newly created client resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_incidencia(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required|integer'
        ]);

        $user = Auth::user();

        $incidencia = new Incidencia([
            'titol' => $request->get('title'),
            'descripcio' => $request->get('description'),
            'id_prioritat' => $request->get('priority'),
            'id_estat' => 1,
            'id_usuari_reportador' => $user->id,
        ]);

        $incidencia->save();

        return redirect('incidencia')->with('success', 'Incidència reportada correctament');
    }
    /*Funcio que rep*/
    public function parc_afegir_cistella(Request $request){

      if (Auth::check() == true) {
        /*si el tipus 6 o 7 rep tiquet numero de viatges*/
        if ($request->get('tipus_select') == 6 || $request->get('tipus_select') == 7) {
          /*Si es 3 te 3 viatges si no es 6 o 7 e*/
          if ($request->get('num_viatges') == 3) {

            $preu_base = Tipus_producte::find($request->get('tipus_select'))->preu_base;
            $preu_final = $preu_base + 5;
            $viatges = $request->get('num_viatges');

          }
          elseif ($request->get('num_viatges') == 6) {

            $preu_base = Tipus_producte::find($request->get('tipus_select'))->preu_base;
            $preu_final = $preu_base + 10;
            $viatges = $request->get('num_viatges');

          }
          /*Si no es 6 o 7 tindra 100 viatges*/
        }else {

          $preu_final = Tipus_producte::find($request->get('tipus_select'))->preu_base;
          $viatges = 100;

        }

        /*devolucio no funciona estat defecte*/
        $estat_defecte = 1;

        /*insert taula atributs*/
        $atributs_producte = new Atributs_producte([

            'nom' => $request->get('tipus_select'),
            'tickets_viatges' => $viatges,
            'preu' => $preu_final

        ]);

        $atributs_producte->save();

        /*Després es guarda el producte*/
        $producte = new producte([

            'atributs' => $atributs_producte->id,
            'estat' => $estat_defecte,
            'descripcio' => " "
        ]);

        $producte->save();

        /*Generacio de la entrada en lo codi QR*/
        $file_path = 'storage/tickets_parc';
        $file_name_path =  $file_path . '/'. time(). $producte->id . '.png';
        $imatge = QrCode::format('png')->size(399)->color(40,40,40)->generate($producte->id, $file_name_path);
        //$imatge = QrCode::format('png')->size(399)->color(40,40,40)->generate('a', 'storage/tickets_parc/a.png');

        /*Afegim el codi QR a la base de dades*/
        DB::table('atributs_producte')
            ->where('id', $atributs_producte->id)
            ->update(['foto_path' => $file_name_path]);

            /*Afegir producte a la cistella*/
            /*Comprovem si existeix la cistella i si no existeix la creem*/
        if (Cistella::where('id_usuari', '=', Auth::id())->count() > 0) {

          $cistella = DB::table('cistelles')
                        ->where('id_usuari', '=', Auth::id())
                        ->first();
          $linia_cistella = new Linia_cistella([
              'id_cistella' => $cistella->id,
              'producte' => $producte->id,
              'quantitat' => $request->get('quantitat')
          ]);
          $linia_cistella ->save();

          /*Creem la cistella si no existeix*/
        }else {

          $cistella = new Cistella([
              'id_usuari' => Auth::id()
          ]);
          $cistella ->save();

          $linia_cistella = new Linia_cistella([
              'id_cistella' => $cistella->id,
              'producte' => $producte->id,
              'quantitat' => $request->get('quantitat')
          ]);
          $linia_cistella ->save();
        }

      }else {
      }

      return redirect('/cistella')->with('success', 'Ticket afegit a la cistella correctament');
    }

    public function compra(){

      return view("/compra");

    }

    public function compra_finalitzada(){

      $elements_cistella = DB::table('linia_cistelles')
          ->join('cistelles', 'linia_cistelles.id_cistella', '=', 'cistelles.id')
          ->join('productes', 'linia_cistelles.producte', '=', 'productes.id')
          ->join('atributs_producte', 'productes.atributs', '=', 'atributs_producte.id')
          ->select('cistelles.id_usuari as id_usuari', 'cistelles.id as id_cistella_orig', 'linia_cistelles.id as id_linia', 'linia_cistelles.id_cistella as id_cistella_linia', 'linia_cistelles.producte as producte', 'linia_cistelles.quantitat as quantitat', 'atributs_producte.preu as preu')
          ->where('cistelles.id_usuari', '=', Auth::id())
          ->get();
      //dd($elements_cistella);
      $preu_total = 0;

      foreach ($elements_cistella as $element_cistella) {
        //dd($element_cistella->preu);
        $preu_total = $preu_total + ($element_cistella->preu * $element_cistella->quantitat);
      }

      $venta = new Venta_productes([
              'id_usuari' => Auth::id(),
              'preu_total' => $preu_total,
              'estat' => 1
      ]);

      $venta ->save();

      foreach ($elements_cistella as $element_cistella) {

        $linia_venta = new Linia_ventes([
                'id_venta' => $venta->id,
                'producte' => $element_cistella->producte,
                'quantitat' => $element_cistella->quantitat
        ]);

        $linia_venta ->save();
        $linia_cistella_element = Linia_cistella::find($element_cistella->id_linia);
        $linia_cistella_element->delete();
        /*DB::table('linia_ventes')->insert([
            ['id_venta' => $venta->id, 'producte' => $element_cistella->producte, 'quantitat' => $element_cistella->quantitat]
        ]);*/
      }

      return view("/compra_finalitzada");

    }

    public function cistella(){

      $linia_cistella = Cistella::join('linia_cistelles', 'linia_cistelles.id_cistella', '=', 'cistelles.id')
          ->join('productes', 'linia_cistelles.producte', '=', 'productes.id')
          ->join('atributs_producte', 'productes.atributs', '=', 'atributs_producte.id')
          ->join('tipus_producte', 'atributs_producte.nom', '=', 'tipus_producte.id')
          ->select('linia_cistelles.id as id', 'tipus_producte.nom as nom' ,'atributs_producte.tickets_viatges as tickets_viatges', 'atributs_producte.mida as mida', 'atributs_producte.preu as preu', 'linia_cistelles.quantitat as quantitat')
          ->where('cistelles.id_usuari', '=', Auth::id())
          ->where('atributs_producte.foto_path_aigua','=', null)
          ->orderBy('nom', 'ASC')
          ->paginate(100);

          $numeroTickets = $linia_cistella->count();

      $total = 0;
      $total2=0;
      $compteTotal=0;

      $fotos = DB::table('cistelles')

          ->join('linia_cistelles', 'linia_cistelles.id_cistella', '=', 'cistelles.id')
          ->join('productes', 'linia_cistelles.producte', '=', 'productes.id')
          ->join('atributs_producte', 'productes.atributs', '=', 'atributs_producte.id')
          ->join('tipus_producte', 'atributs_producte.nom', '=', 'tipus_producte.id')
          ->select('linia_cistelles.id as id', 'tipus_producte.nom as nom' ,'atributs_producte.tickets_viatges as tickets_viatges', 'atributs_producte.mida as mida', 'atributs_producte.preu as preu','atributs_producte.foto_path_aigua as fotoaigua', 'linia_cistelles.quantitat as quantitat')
          ->where('cistelles.id_usuari', '=', Auth::id())
          ->where('atributs_producte.foto_path_aigua','!=', null)
          ->orderBy('nom', 'ASC')
          ->paginate(100);

      $numeroFotos = $fotos->count();

      $user = Auth::user();

      $usuari = User::where('id', '=', Auth::id());

          return view('/cistella', compact('linia_cistella', 'total','fotos','total2','compteTotal','numeroFotos','numeroTickets','user'));


    }

    public function cistella_delete(Request $request){

      $linia_cistella = Linia_cistella::find($request->get('id_linia_producte'));
      $producte = producte::find($linia_cistella->producte);
      $atributs_producte = Atributs_producte::find($producte->atributs);

      $linia_cistella->delete();
      //$producte->delete();
      //$atributs_producte->delete();

      return redirect('/cistella')->with('success', 'Producte eliminat correctament');
    }

    public function llistarAtraccionsPublic($id)
    {
      $atraccions = Atraccion::find($id);
      $tipus_atraccio = TipusAtraccions::find($atraccions->tipus_atraccio);
      return view('/atraccions_generades', compact('atraccions', 'tipus_atraccio'));
    }

}
