<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilRequest;
use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {

        $profils = Profil::all();
        return view('profils.index_profil',['profils' => $profils]);
    }

    public function create()
    {
        return view('profils.create');
    }

   
    public function store(ProfilRequest $request)
    {
        $input = $request->all();

            Profil::create($input);
        
        return redirect(route('profils.index'));
    }

    public function getListe(Request $request) 
    {
        $profils = Profil::all();

        return view('profils.table')
            ->with('profils', $profils);
    }

    public function show(Profil $profil)
    {
        $view = view('profils.show');
        
            $view->with('profil',$profil);
     
        return $view;
    }

    public function edit(Profil $profil)
    {
        return view('profils.edit',['profil' => $profil]);
    }


    public function update(Request $request, Profil $profil)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:profils,nom,'.$profil->id]);
        $profil->update($request->all());

        return redirect(route('profils.index'));
    }


    public function destroy($id)
    {
        $result = Profil::destroy($id);
       
        return redirect(route('profils.index'));
    }
}
