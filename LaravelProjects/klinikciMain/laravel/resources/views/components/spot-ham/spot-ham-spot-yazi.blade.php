<div id="instructions" class="paper text-center"> 
    {!! htmlspecialchars_decode(ilkHarfBuyuk($spot->icerik))!!}
    <br>
    <span style="height: 25px;line-height: 19px;" class="badge badge-light">
        </i>{{getAgo($spot->eklenme_tarihi)}} eklendi.</span>

    <span class="badge badge-pill badge-info"> <i class="far fa-eye"></i>{{$spot->hit}}</span>

    <span class="badge badge-pill badge-danger"><i class="far fa-thumbs-up"></i> {{$spot->like}}</span>
    @if (Auth::check()&& !userLikeSpot($spot))
    <a href="" class="badge badge-danger spotBegen" style="height: 25px;line-height: 19px;"  > Beğen</a>
    {{-- bu a linkinin spot beğenme bağlantısı spot-sliderde yapıldı  --}}
    <form class="spotBegen" style="display: none;" action='/spotBegen' method="post">
        @csrf
        <input type="hidden" name="spotId" value="{{$spot->id}}">
    
    </form> 
    @else
    
    
    @endif
   

</div> 

<style>
   
        .paper {
        padding: 37px 55px 27px;
        position: relative;
        border: 1px solid #B5B5B5;
        background: white;
        background: -webkit-linear-gradient(top, #DFE8EC 0%, white 8%) 0 57px;
        background: -moz-linear-gradient(top, #DFE8EC 0%, white 8%) 0 57px;
        background: linear-gradient(top, #DFE8EC 0%, white 8%) 0 57px;
        -webkit-background-size: 100% 30px;
        -moz-background-size: 100% 30px;
        -ms-background-size: 100% 30px;
        background-size: 100% 30px;
        line-height:30px;
    }
    .paper::before {content:""; z-index:-1; margin:0 1px; width:706px; height:10px; position:absolute; bottom:-3px; left:0; background:white; border:1px solid #B5B5B5;}
    .paper::after {content:''; position:absolute; width:0px; top:0; left:39px; bottom:0; border-left:1px solid #F8D3D3;}
        </style>