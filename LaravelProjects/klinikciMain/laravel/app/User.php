<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','kullanici_adi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function begenilenKonuMesajlar(){
        
        return $this->belongsToMany('App\Models\Forum_konu_mesaj', 'user_konu_mesajs', 'user_id', 'forum_konu_id');
        
    }

    public function begenilenKonular(){
        
        return $this->belongsToMany('App\Models\Forum_konu', 'konu_users', 'user_id', 'konu_id');
        
    }



    public function begenilenSpotlar(){
        
        return $this->belongsToMany('App\Models\Spot', 'spot_users', 'user_id', 'spot_id');
        
    }

    public function girilenIpler(){
        return $this->belongsToMany('App\Models\IpAdress', 'user_ipadresses', 'user_id', 'ipadress_id');
        
    }

    public function HasThisIp($ipadress){
        $sayiIp= $this->girilenIpler()->where('ipadress',$ipadress)->count();
        if($sayiIp>0){
            return true;
        }
        return false;

    }

    public function ipKaydet($ipadress){
        $ip = IpAdress::where('ipadress',$ipadress)->first();
        return $this->girilenIpler()->save($ip);

    }


    
    public function roller(){
        return $this->belongsToMany('App\Models\Role', 'roles_users', 'users_id', 'roles_id');
    }


    public function profilResim(){
        return $this->hasOne('App\Models\Uye_resim', 'user_id', 'id');
    }

    public function sinav(){
        return $this->belongsTo('App\Models\Sinav', 'sinavlar_id', 'id');
    }

    public function uyelikSeviye(){
        return $this->belongsTo('App\Models\Uyelik_seviye', 'uyelik_seviye_id', 'id');
    }


    public function formKonuMesajlar(){
        return $this->hasMany('App\Models\Forum_konu_mesaj', 'user_id', 'id');
    }

    public function formKonular(){
        return $this->hasMany('App\Models\Forum_konu', 'user_id', 'id');
    }

    public function haberYorumlar(){
        return $this->hasMany('App\Models\Haber_yorum', 'user_id', 'id');
    }

    public function haberler(){
        return $this->hasMany('App\Models\Haber', 'user_id', 'id');
    }

    public function spotYorumlar(){
        return $this->hasMany('App\Models\Spot_yorum', 'user_id', 'id');
    }

    public function gelenMesajlar(){
        return $this->hasMany('App\Models\Ozel_mesajlar', 'gonderilen_user_id', 'id');
    }

    public function gidenMesajlar(){
        return $this->hasMany('App\Models\Ozel_mesajlar', 'gonderen_user_id', 'id');
    }

    public function spotlar(){
        return $this->hasMany('App\Models\Spot', 'user_id', 'id');
    }




}
