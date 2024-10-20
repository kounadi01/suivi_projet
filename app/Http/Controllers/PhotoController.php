<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    //
    public function index()
    {
        $photos = Photo::all();

        return view('photos.index',['photos' => $photos]);
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            // 'photo' => 'file|mimetypes:application/jpg,application/png,application/gif',
        ]);

        // dd($request->all());
        if ($validator->fails()) {
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {

            

            if ($request->publier == 1) {
                # code...
                $photos = Photo::all();
                foreach($photos as $photo){
                    $photo->update(['publier'=>0]);
                }
            }
            $photo = $this->enregisterPhoto($request, 'photo');
            // dd($photo);
            Photo::create([
                'libelle' => $request->libelle,
                'publier' => $request->publier,
                'photo' => $photo
            ]);

            return redirect(route('photos.index'))->with("statut", "La photo  a bien été ajoutée avec succés");;
        }
    }

    public function getListe(Request $request) 
    {
        $photos = Photo::all();

        return view('photos.table')
            ->with('photos', $photos);
    }

    public function show(Photo $photo)
    {
        $view = view('photos.show');
        
            $view->with('photo',$photo);
     
        return $view;
    }

    public function edit(Photo $photo)
    {
        return view('photos.edit')->with('photo',$photo);
    }

    public function update(Request $request, Photo $photo)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required',
            // 'photo' => 'required|file|mimetypes:application/jpg,application/png,application/gif',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'erreur' => 'Données incohérentes',
            ], 422);
        } else {

            $image = $this->enregisterPhoto($request, 'photo');

            if ($request->publier == 1) {
                # code...
                $photos = Photo::all();
                foreach($photos as $pho){
                    $pho->update(['publier'=>0]);
                }
            }

            if ($image != ''){
                $data = [
                    'libelle' => $request->libelle,
                    'publier' => $request->publier,
                    'photo' => $image
                ];
            }else{
                $data = [
                    'libelle' => $request->libelle,
                    'publier' => $request->publier,
                ];
            }

            // dd($data);


            if ($photo->update($data)){
                return redirect()->route("photos.index")->with("statut", "La photo  a  été modifiée avec succés");
    
            }
            return redirect()->route("photos.index")->with("statut", "Echec de modification de la photo ");
        }
    }

    public function destroy($id)
    {
        $result = Photo::destroy($id);
       
        return redirect(route('photos.index'));
    }
}
