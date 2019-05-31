

@foreach ($yorum->altYorumlar()->orderBy('eklenme_tarih','desc')->get(); as $altYorum)

<div style="margin-left: 50px;" class="media ">
    <a class="pr-3" href="#">
        <img class="yorumProfilImage"
        src="{{route('profilResim',['uyeId'=>$altYorum->user->id])}}" 
        alt="{{isset($altYorum->user->kullanici_adi) ?$altYorum->user->kullanici_adi:  $altYorum->user->name }}">
    </a>
    <div class="media-body">
        <h5 class="mt-0">{{isset($altYorum->user->kullanici_adi) ?$altYorum->user->kullanici_adi:  $altYorum->user->name }}</h5>
        <p> {!!htmlspecialchars_decode($altYorum->icerik)!!}</p>
        <p>{{getAgo($altYorum->eklenme_tarih)}} </p>
    </div>
</div>

<!--  alt yorum için                  -->
@endforeach