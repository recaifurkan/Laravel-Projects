<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resim extends Model
{
    protected $table = 'resimler';

    public function getHaber(){
        $imageSizes = ['550x330Id','390x240Id','300x215Id','112x112Id','75x75Id'];
        foreach ($imageSizes as $imageSize ) {
            $haber =  $this->hasOne('App\Models\Haber', $imageSize, 'id');
            
            if(isset($haber)){
                break;
            }
        }

        

        return $haber ;
    }
}
