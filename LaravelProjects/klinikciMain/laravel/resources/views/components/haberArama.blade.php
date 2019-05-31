   <!-- Search Widget -->
   <div class="card mb-4">
        <div class="card-body">

            <form id="searchForm" class="input-group" method="post" action="/haberSearch">
                @csrf
                <input id="search-text" name="searchText" type="text" class="form-control" placeholder="Haber Ara">
                <span class="input-group-btn">
                    <button value="searchHaber" name="searchHaber" class="btn btn-secondary" type="submit">Ara!</button>
                </span>


            </form>






        </div>
        </div>

        <!-- arama sonucunda açılacak -->
    <!-- latest post -->
    <div style="display: none;" id="search-result" class="row">
            
            <div  class="card my-4 p-3 post_link col-md-12">
                    <h5 class=" card-header"><span id="aranan-kelime" class="badge badge-info"></span><span> için sonuçlar</span> </h5>
                <div id="result">


                </div>


                <!--     konunun limki buraya koyulacak        -->

              
                <!--     konunun limki buraya koyulacak        -->

            </div>



        </div>


<script>



        var searchTime = 700;
    
        //aramayla ilgili fonksiyonlar işlemler burada yapılıyor
            $(function(){
    
                var form = $('#searchForm').submit(function(e){
                        
                    e.preventDefault();
    
    
                    });
                   
                  
            $('#search-text').on('input',function(e){
              var girilenYazi = $(this).val();
               
                if(girilenYazi==''){
                    $('#search-result').slideUp(searchTime);
                }
                else{
                    $('#search-result').slideDown(searchTime);
                            $('#aranan-kelime').html(girilenYazi);
                    
                    // burada jquery post atacan gelenle işlem yapacan
                    $.ajax({
                        type: "POST",
                        url: form.attr('action'),
                        data: form.serialize(),
                        success: function(data){
                            var result = $('#result');
                           
                               
                               
                            
                           
                            var text = '';
                            
                            data = JSON.parse(data);
                            // console.log(typeof data !== 'undefined' && data.length > 0);
                            if(typeof data !== 'undefined' && data.length > 0){
                                // console.log('boş');
                                Object.keys(data).forEach(function(haber , index) {
    
                                    text += '<div class="row mt-3">'+
                                                '<div class="forum-home-parent text-center col-12 pl-0">'+
                                                        '<div class="text-center col-md-12">'+
                                                            '<a style="height:20px;" class="text-center" href="'+'/haber/kategori/' + data[haber]["url"] +'">'+ data[haber]["baslik"]  +'</a>'+
                                                            '</div> </div> <div class="hr"></div></div>';
    
        
                                    //  console.log(data[haber]['baslik']);
                              });
                              
                            }
                            else{
                                text='<span class="text-justify badge badge-danger">'+girilenYazi + ' için sonuç bulunamadı...'+'</span>';
                            }
                            
    
                            
                           
                            
                              result.html(text);
                            
                            },
    
    
    
                            
                            
                        error: function (xhr, ajaxOptions, thrownError) { 
                           
                            }
                        
                       
                        });
    
                  
                }
               
        
        });
        
        
        
        });
        </script>