
@foreach ($haberler as $haber )

    {{-- haberin onayına göre gösterme sağlanacak --}}

<!-- blog grid -->
    <div class="col-lg-6 col-md-6 haber_card">
        <div class="card">
            <div class="card-header p-0">
            <a href="haber/{{$haber->kategori->url}}/{{$haber->url}}">
                   
                    <img class="card-img-haber" src="{{asset('storage/assets').'/'.$haber->kapakResim->url}}" alt="{{$haber->kapakResim->aciklama}}">
                </a>
            </div>
            <div class="card-body">
                <div class="border-bottom py-2">
                    <h5 class="blog-title card-title font-weight-bold">
                        <a href="single.html">{{$haber->baslik}}</a>
                    </h5>
                </div>
                <div class="blog_w3icon pt-4">
                    <span>
                        <i class="fas fa-user mr-2"></i>{{$haber->user->name}}</span>
                    <span class="ml-3">
                            <i class="far fa-eye"></i>{{$haber->hit}} </span>
                </div>
                <p class="card-text mt-3">{{$haber->kisa_aciklama}}</p>
                <a href="haber/{{$haber->kategori->url}}/{{$haber->url}}" class="blog-btn text-dark">Habere git</a>
            </div>
            <div class="card-footer">
                <p class="card-text text-right">
                    <small class="text-muted">{{$haber->eklenme_tarihi}}</small>
                </p>
            </div>
        </div>
    </div>
    <!-- //blog grid -->


    <!-- haber tekrar edilecek burada -->
@endforeach