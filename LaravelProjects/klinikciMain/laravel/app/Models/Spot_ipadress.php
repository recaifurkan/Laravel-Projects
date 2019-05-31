<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot_ipadress extends Model
{
    //spota giren ip adresleri kaydedilir ve ona göre işlemler yapılır
    // aynı zamanda ip adresi bu spota kaç kere girmiş onun da kaydı tutulur
    // veritabanında her saat silinir haberin olsun
}
