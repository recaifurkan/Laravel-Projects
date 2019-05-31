<div class="contact-top1">
        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

        <h1>Yorumlar</h1>
            <hr>
        <!-- burası yorum yap kısmı -->
        <a id="yorumButton" href=""><h5 class="text-dark text-danger mb-4 text-capitalize">Bir yorum yap</h5></a>
        <div>
       
           
            @if (!Auth::check())
            <div style="text-align: center;">
            <p>Yorum yapabilmek için lütfen giriş yapınız...</p>

            <button type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModel">
                    Giriş Yap
                </button>
            </div>
               

              
            @else  
            
            <div class="form-group">
                    <form action="/haberYorum" method="POST" class="f-color p-3">
                        {{ csrf_field() }}
                    <input type="hidden" name="haberid" value="{{$haber->id}}">
                        <label for="contactcomment">Yorumunuz</label>
                        <textarea style="width: 100%" placeholder="Yorumunuz" name="yorumText" class="yorumText"></textarea>
                       

                    </div>
                    <button type="submit" value="haberYorum" name="haberYorum" class="mt-3 btn btn-danger btn-block">Yorumu gönder</button>
                </form>
            
            @endif
              
            
        
    </div>




@foreach ($yorumlar as $yorum)
<!--      yorum tekrar edilecek kısım         -->
<div class="media py-5">
    <img class="mr-3 yorumProfilImage" 
    src="{{route('profilResim',['uyeId'=>$yorum->user->id])}}" 
    alt="{{isset($yorum->user->name) ? $yorum->user->name : $yorum->user->kullanici_adi }}">
    <div class="media-body">
        <h5 class="mt-0">{{$yorum->user->name}}</h5>
        <p>{!!htmlspecialchars_decode($yorum->icerik)!!}
        </p>
        <p>{{getAgo($yorum->yorum_tarihi)}} </p>
        <a class="cevaplaButton" href=""><span><i class="fas fa-reply"></i>Cevapla</span></a>
        

        <!--  alt yorum için -->



        @if (!Auth::check())

        <div style="display: none;text-align: center;">
            <p>Cevap verebilmek için lütfen giriş yapınız...</p>

            <button id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModel">
                    Giriş Yap
                </button>
        </div>


        @else
       
        <div style="display: none;">

            <form action="/haberYorum" method="POST" class="f-color p-3">
                {{ csrf_field() }}
                <div class="form-group">
                <input type="hidden" name="ustYorum" value="{{$yorum->id}}">
                    
                <textarea style="width: 100%" placeholder="Yorumunuz" name="altYorumText" class="yorumText"></textarea>
                   </div>
                <button type="submit" value="altYorum" name="altYorum" class="mt-3 btn btn-danger btn-block">Yorumu gönder</button>
            </form>
        </div>
        @endif
    @include('haberler-yorum.altyorumlar')

    </div>
</div>

<!--      yorum tekrar edilecek kısım         -->



@endforeach

</div>

@section('js')
<script>
    $(function(){

         $('.yorumText').each(function(index,elem){
        // console.log(elem);

         ClassicEditor.create(elem,{
                toolbar: [  'bold', 'italic', 'link' ],
                heading: {
                options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
                }
                });





    });


   $('.cevaplaButton').click(function(e){
       e.preventDefault();
       $(this).next().slideToggle();


   });

        





    });
   
                
</script>
@endsection

