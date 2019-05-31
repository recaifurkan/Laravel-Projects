

@foreach ($yorum->altYorumlar()->orderBy('yorum_tarihi','desc')->get(); as $altYorum)

<div style="margin-left: 50px;" class="media ">
    <a class="pr-3" href="#">
        <img class="yorumProfilImage"
        src="{{route('profilResim',['uyeId'=>$altYorum->user->id])}}" 
        alt="{{isset($altYorum->user->name) ? $altYorum->user->name: $altYorum->user->kullanici_adi }}">
    </a>
    <div class="media-body">
        <h5 class="mt-0">{{$altYorum->user->name}}</h5>
        <p> {!!htmlspecialchars_decode($altYorum->icerik)!!}</p>
        <p>{{getAgo($altYorum->yorum_tarihi)}} </p>
    </div>
</div>

<!--  alt yorum için                  -->
@endforeach