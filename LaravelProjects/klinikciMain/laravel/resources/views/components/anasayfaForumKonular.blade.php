@foreach ($konular as $konu)
                       
                   
                  <div class="row text-center ">
                   
                    <div class="col-md-6  ">
                       
                    <a href="/forum/{{$konu->kategori->url}}/{{$konu->url}}">{!!htmlspecialchars_decode(ilkHarfBuyuk($konu->name))!!}</a>
                
                    </div>
                    <div  class="forum-bilgi col-md-6 text-muted">
                      
                                <span class="col-sm-3" ><i class="fas fa-comments">{{$konu->mesajlar->count()}}</i></span>
                           
                                <span class="card-text col-sm-3"><i class="far fa-eye">{{$konu->goruntulenme_sayisi}}</i></span>
                                
                        

                                 <span class="col-xs-3"  >
                                            @if (Auth::check()&& !userLikeKonu($konu)) 
                                            <a href="" class="badge badge-pill badge-danger col-md-2 konuBegen"><i style="color: white" class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</a>
                                           
                                           
                                            <form class="konuBegen" style="display: none;" action='/konuBegen' method="post">
                                                @csrf
                                                <input type="hidden" name="konuId" value="{{$konu->id}}">
                                            
                                            </form>
                                            @else
        
                                            <a  class="badge badge-pill col-md-2 badge-info "><i style="color: red" class="far fa-thumbs-up"></i> {{$konu->begenilme_sayisi}}</a>
        
        
                                            @endif
                                        </span> 
                                       
                                   
                               




                                  
                           
                          
                        </div>
                
                 
                 
                </div>
                    @endforeach
                   