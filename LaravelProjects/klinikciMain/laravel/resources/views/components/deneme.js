// kategori ekleyen ajax fonksiyonları var 


$.ajax({
    type: "POST",
    url: '/kategoriEkle',
    data: {'kategori_ad':girilenYazi,
            '_token':token},
    succes:function(data){



        if(data!=false){
            $('select[name="kategori"]').
            append(' <option value="'+data.id+'">'+data.name+'</option>');
            // $('#kategori_ad_sonuc').slideUp();
        }


        else{
            console.log('kayıtta problem var');
        }




    },
    error:function(xhr, ajaxOptions, thrownError){}
    
    
});


// Kategori tuşuna tıklanınca yapılan işlem işte



// veritabanında kategori var mı arayan jquery ajax metodu

$.ajax({
    type: "POST",
    url: '/kategoriAvaliable',
    data: {'kategori_ad':girilenYazi,
            '_token':token
    
    
    },
    success: function(data){ 
            sonuclar = data;
            
            if(sonuclar==false){
             
               $('#kategori_ad_sonuc span').html('Eklenebilir kategori '+' '+girilenYazi);
              
                
            
            }
            

            else{
              
                $.each (sonuclar, function (sonuc) {
            
            
            console.log (sonuclar[sonuc].name);
            kategori = sonuclar[sonuc].id;

            $('#kategori_ad_sonuc span').html('Benzer kategori '+' '+sonuclar[sonuc].name);
            });
                
                
            }




            },
    error: function (xhr, ajaxOptions, thrownError) { }
     
     });
