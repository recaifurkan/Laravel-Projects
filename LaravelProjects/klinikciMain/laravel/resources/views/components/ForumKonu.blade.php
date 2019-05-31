@foreach ($konular as $konu)


<div class="row ">
                   
        <div class="col-md-6 text-center ">
            <a href="{{$konu->kategori->url}}/{{$konu->url}}">{!!htmlspecialchars_decode($konu->name)!!}</a>
    
        </div>
        <div class="col-md-6 text-muted">
                <span class="card-text"> {{getAgo($konu->acilis_tarihi)}}</span>
                <span><i class="far fa-eye">{{$konu->goruntulenme_sayisi}}</i></span>
                <span class="badge badge-pill badge-danger"><i class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</span>
                @if (Auth::check()&& !userLikeKonu($konu)) 
                                        
                <span class="justify-content-center">
                        <a href="" class="badge konuBegen spotBegen" style="height: 25px;line-height: 19px;"  > Beğen</a>
                        <form class="konuBegen" style="display: none;" action='/konuBegen' method="post">
                            @csrf
                            <input type="hidden" name="konuId" value="{{$konu->id}}">
                        
                        </form>
                    </span> 
               
                @endif
            
            </div>
    
     
    
    </div>
                    @endforeach
