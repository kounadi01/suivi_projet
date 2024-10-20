<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'login',
    //     'isenable',
    //     'prenom',
    //     'telephone',
    //     'profil_id'
    // ];
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }


    public static function authUserProfil()
    {

        $profil = DB::table('users')
            ->select('users.id', 'profils.nom')
            ->join('profils', 'profils.id', '=', 'users.profil_id')
            ->where('users.id', Auth::id())->first();
        //dd($profil);
        return $profil;
    }

    public static function infoUserConnect()
    {

        $profil = DB::table('users')
            ->select('*')
            ->join('structures', 'structures.id', '=', 'users.structure_id')
            ->where('users.id', Auth::id())->first();
        //dd($profil);
        return $profil;
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
