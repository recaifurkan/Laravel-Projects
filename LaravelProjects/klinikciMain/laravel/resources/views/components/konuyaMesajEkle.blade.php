
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>


<div style="position: fixed; z-index: 999">
        <button id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#forumKonu">
            <img style="width: 40px;height: 40px" src="../../images/f2.png" alt="" class="img-fluid">
        </button>
    </div>
    
    
        
     {{-- forum konu yazma yeri burası  --}}
    <div class="modal fade" id="forumKonu" tabindex="-100" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bir Mesaj Yaz</h5>
        <button id="kapamaButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            @if (!Auth::check())
    
            <div class="text-center" style="text-align: center; z-index: 10;">
                <p>Mesaj yazmak için lütfen giriş yapınız...</p>
    
                <button onclick="$('#kapamaButton').click()" id="loginButton" type="button" class="btn btn-danger ml-lg-5 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModel">
                        Giriş Yap
                    </button>
            </div>
    
    
            @else
           
           
            <form method="POST" id="mesajEkleForum" action="/mesajEkle" >
                @csrf
                <div   id="messagesKonu"></div>
               
            
            <input type="hidden" name ="konuid" value="{{$konu->id}}">
            
            
    
            <div class="form-group">
                    
                <label for="mesajIcerik" class=" col-form-label">Mesajınızı giriniz</label>
                <br>
                <textarea id="mesajIcerik" type="text"  name="mesajIcerik" value="" required>
                </textarea>
            </div>
    
            <script>
    
             ClassicEditor.create( document.querySelector( '#mesajIcerik' ) ,{
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
    
        
        
        <div style="margin-top: 15px;" class="right-w3l">
            <input type="submit" class="form-control border text-white" value="Mesajı Gönder">
        </div>
       
        
                        <script>
                
                $('#mesajEkleForum').submit(function(e){
                    submit = $(this).find('input[type="submit"]');
                    submit.attr('disabled', 'disabled');
        
                    // console.log('tiklandi');
                    e.preventDefault();
                    $.ajax({
                        type: $(this).attr('method'), 
                        url:  $(this).attr('action'), 
                        data: $(this).serialize(), 
                        success: function(data){
                            location.reload();
                            // console.log(data);
                            
                            },
                        error: function (xhr, ajaxOptions, thrownError) { 
                            $response = JSON.parse(xhr.responseText);
                            $errors = $response;
                            
                            $errorEmail = $errors.email;
                            text = '';
                            Object.keys($errors).forEach(function(error , index) {

                                // console.log($errors[error]);
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
                
                });
                        
                        
                        
                        
                        </script>
           
    
        </form>
    
        @endif
    
        </div>
        </div>
        </div>
        </div>
        {{-- forum konu yazma yeri burası  --}}
        
        