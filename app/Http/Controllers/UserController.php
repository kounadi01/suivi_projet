<?php

namespace App\Http\Controllers;


use App\Models\Profil;
use App\Models\Province;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::table('users')

            ->join('profils', 'users.profil_id', '=', 'profils.id')

            ->select('users.*', 'profils.nom')
            ->whereNull('users.deleted_at')
            ->get();
        return view('user.index', ['users' => $users]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profils = Profil::all()->pluck('nom', 'id');
        $structures = Structure::all()->pluck('nom_struct', 'id');

        return view('user.create', ['profils' => $profils, 'structures' => $structures]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed'],
            'login' => 'required|string|max:255|unique:users',
            'isenable' => 'integer',
            'telephone' => 'required|string',
            'profil_id' => 'required|integer',
        ]);

        if ($user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isenable' => $request->isenable,
            'telephone' => $request->telephone,
            'profil_id' => $request->profil_id,
            'structure_id' => $request->structure_id,


        ])) {
            return redirect()->route("user.index")->with("statut", "L'Utilisateur  a bien été ajoutée avec succés");
        }
        return redirect()->route("user.index")->with("statut", "Echec de l'ajout de la structure ");
    }



    public function getListe(Request $request)
    {

        $users = DB::table('users')

            ->join('profils', 'users.profil_id', '=', 'profils.id')

            ->select('users.*', 'profils.nom')
            ->whereNull('users.deleted_at')
            ->get();

        return view('user.table')
            ->with('users', $users);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::table('users')

            ->join('profils', 'users.profil_id', '=', 'profils.id')

            ->select('users.*', 'profils.nom')
            ->get()->where('id', $id);
        $users = $users->first();

        return view('user.show', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $option = $_GET['option'];
        $profils = Profil::all()->pluck('nom', 'id');
        $users = DB::table('users')
            ->join('profils', 'users.profil_id', '=', 'profils.id')
            ->select('users.*', 'profils.nom')
            ->where('users.id', $id)
            ->get();
        $users = $users->first();

        $structures = Structure::all()->pluck('nom_struct', 'id');


        return view('user.edit', ['users' => $users, 'profils' => $profils, 'option' => $option, 'structures' => $structures]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $option = $_GET['option'];

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'login' => 'required|string',
            'telephone' => 'required|string'
        ]);
        if ($option = 'profil') {
            if ($user->update($request->all())) {
                return redirect()->route("dashboard")->with("statut", "L'utilisateur  a bien été modifié avec succés");
            }
            return redirect()->route("dashboard")->with("statut", "Echec de modification de l'utilisateur ");
        } else {

            if ($user->update($request->all())) {
                return redirect()->route("user.index")->with("statut", "L'utilisateur  a bien été modifié avec succés");
            }
            return redirect()->route("user.index")->with("statut", "Echec de modification de l'utilisateur ");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = User::destroy($id);

        return redirect(route('user.index'));
    }


    public function desactiverUtilisateur($id)
    {
        $data = array('isenable' => 0);
        $user = DB::table('users')->where('id', $id)->update($data);
        $users = DB::table('users')

            ->join('profils', 'users.profil_id', '=', 'profils.id')

            ->select('users.*', 'profils.nom')
            ->get();

        return view('user.index')
            ->with('users', $users);
        //        return view('user.index');

    }
    public function reactiverUtilisateur($id)
    {

        $data = array('isenable' => 1);
        $user = DB::table('users')->where('id', $id)->update($data);

        $users = DB::table('users')

            ->join('profils', 'users.profil_id', '=', 'profils.id')

            ->select('users.*', 'profils.nom')
            ->get();

        return view('user.index')
            ->with('users', $users);
    }


    public function showChangePasswordForm()
    {

        return view('user.changepassword');
    }


    public function changeUserPassword(Request $request)
    {

        if (!(Hash::check($request->get('currentpassword'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Votre mot de passe actuel ne correspond pas au mot de passe que vous avez fourni. Veuillez réessayer.");
        }

        if (strcmp($request->get('currentpassword'), $request->get('newpassword')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Le nouveau mot de passe ne peut pas être identique à votre mot de passe actuel. Veuillez choisir un autre mot de passe.");
        }

        $validatedData = $request->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required|min:6|confirmed',
        ]);
        if ($validatedData) {
            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('newpassword'));
            $user->save();

            return redirect()->back()->with("success", "Le mot de passe a été modifié avec succès !");
        }
    }
}
