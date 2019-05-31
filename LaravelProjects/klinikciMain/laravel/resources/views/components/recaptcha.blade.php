<div  id="captcha">
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <button style="display: none" id="recaptchaButton"
        class="g-recaptcha"
        data-sitekey="{{env('INVISIBLE_RECAPTCHA_SITEKEY')}}"
        data-callback="recaptchaSubmit"
        data-badge="inline"
        
        >
     </button>

     <style> 
     /* bu satırla altta çıkan invisible captha tarafından korunuyor yazısı kaldırıldı*/
     .grecaptcha-badge {
    display: none;
}
     
     </style>
</div> 
<script>
   
                var captchaSubmit = false;
                var forumId = "{{$forumId}}";
                function recaptchaSubmit(){
                    v = grecaptcha.getResponse();
                            if(v){
                               captchaSubmit = true;
                            //    alert('okey');
                            //    console.log(captchaSubmit);
                               $(forumId).submit();

                            }
                      
                }
</script>