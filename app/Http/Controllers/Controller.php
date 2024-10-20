<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function enregisterFichier(Request $request, $fichier) {
        //
        
        if ($request->file($fichier) == null) {
            $nom = '';
        } else {
            $nom = date('Y').date('m').date('d').'.'.date('h').date('m').date('s').'_'.$request->file($fichier)->getClientOriginalName();

            $request->file($fichier)->move('uploads/demande/', $nom);

        }

        //dd($nom);
        return $nom;
    }

    public function enregisterPhoto(Request $request, $photo) {
        //
        // dd($request->file($photo)->getClientOriginalName());
        if ($request->file($photo) == null) {
            $nom = '';
        } else {
            
            $img = Image::read($request->file($photo));

            // resize image
            $img->resize(width :1920, height :1200);

            // save image
            $nom = date('Y').date('m').date('d').'.'.date('h').date('m').date('s').'_'.$request->file($photo)->getClientOriginalName();

            $img->save('uploads/photo/' . $nom);

            $photo = $nom;

        }

        //dd($nom);
        return $nom;

        
    }
}
