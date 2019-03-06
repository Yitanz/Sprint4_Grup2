<?php

namespace App\Http\Controllers;

use \App\Atraccion;
use \App\TipusAtraccions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Image;
use PDF;
use Carbon;

use Illuminate\Http\Request;

class TendaController extends Controller
{
    
	public function  indexTenda(){
		return view ('tenda/tendaIndex');
	}

	public function indexAtraccions(){

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

		return view ('tenda/tendaFotos', compact('atraccionetes'));
	}

  public function imprimirFotos($id){
      
  }
}
