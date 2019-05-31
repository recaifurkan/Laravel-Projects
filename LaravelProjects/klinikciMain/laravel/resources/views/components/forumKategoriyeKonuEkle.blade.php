
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>


<div style="position: fixed; z-index: 999">
        <button id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#forumKonu">
            <img style="width: 40px;height: 40px" src="../images/f2.png" alt="" class="img-fluid">
        </button>
    </div>
    
    
        
     {{-- forum konu yazma yeri burası  --}}
    <div class="modal fade" id="forumKonu" tabindex="-100" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konu Aç</h5>
        <button id="kapamaButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            @if (!Auth::check())
    
            <div class="text-center" style="text-align: center; z-index: 10;">
                <p>"{{$kategori->name}}" kategorisine konu eklemek için lütfen giriş yapınız...</p>
    
                <button onclick="$('#kapamaButton').click()" id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModel">
                        Giriş Yap
                    </button>
            </div>
    
    
            @else
           
           
            <form method="POST" id="konuEkleForum" action="/forumKonu" >
                @csrf
                <div   id="messagesKonu"></div>
               
            <div style="display: none" class="form-group">
                   
                    <label for="kategori"  class=" col-form-label">Kategori seç</label>
                    <br>
                    <select  name="kategori" class="form-control">
                        
                           
                    <option value="{{$kategori->id}}">{{ilkHarfBuyuk($kategori->name)}}</option>
                          
                        
                           
                            
                     </select> 
            </div>
          
            <div class="form-group">

                    <div class="alert-success">
                        "{{$kategori->name}}" kategorisine konu ekliyorsunuz...
                    </div>
                
                    <label for="name" class=" col-form-label">Konuna isim ver<small> *Konununuzun anasayfada görünecek ismi</small></label>
                    <br>
                    <input id="name" type="text" class="form-control"  name="name" value="{{ old('name') }}" required>
            </div>
            
    
            <div class="form-group">
                    
                <label for="konuIcerik" class=" col-form-label">Konu açılış mesajın</label>
                <br>
                <textarea id="konuIcerik" type="text"  name="konuIcerik" value="" required>
                        {{ old('konuIcerik') }}
                </textarea>
            </div>
    
            <script>
    
             ClassicEditor.create( document.querySelector( '#konuIcerik' ) ,{
                    toolbar: [  'bold', 'italic', 'link' ],
                    heading: {
                    options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                    }
                    });
    
            
    
            
            </script>
       

        @include('components.recaptcha',['forumId'=>'#konuEkleForum'])
   
        
        
        <div style="margin-top: 15px;" class="right-w3l">
            <input type="submit" class="form-control border text-white" value="Konu Oluştur">
        </div>
       
        
                        <script>
               
                
                // e.preventDefault();
                // alert('clicked');
                $('#konuEkleForum').submit(function(e){
                    // console.log(captchaSubmit);
                    e.preventDefault();
                    if(!captchaSubmit){
                        $('#recaptchaButton').click();
                    }
                    else{
                    submit = $(this).find('input[type="submit"]');
                    submit.attr('disabled', 'disabled');
                        $.ajax({
                        type: $(this).attr('method'), 
                        url:  $(this).attr('action'), 
                        data: $(this).serialize(), 
                        success: function(data){
                            // location.reload();
                            // console.log(data);
                            console.log(data);
                          
                            
                            },
                        error: function (xhr, ajaxOptions, thrownError) { 
                            $response = JSON.parse(xhr.responseText);
                            $errors = $response;
                            
                            $errorEmail = $errors.email;
                            text = '';
                            Object.keys($errors).forEach(function(error , index) {

                                console.log($errors[error]);
                        //         Object.keys($errors[error]).forEach(function(value , index) {
                               
                               text += $errors[error] + '<br>';
                        //        // console.log($errors[error][value]);
                        submit.removeAttr('disabled');
        
        
                        //    });
                                
                                
                               
                            })
        
                             $('#messagesKonu').html(text).addClass('alert alert-danger');
        
                            // console.log(text);
                            // console.log($response.message);
                            //  console.log(thrownError);
                                
                            }
                         
                    });
                    }
                    
                
                });
           
                
                        
                        
                        
                        
                        </script>
           
    
        </form>
    
        @endif
    
        </div>
        </div>
        </div>
        </div>
        {{-- forum konu yazma yeri burası  --}}
        
        