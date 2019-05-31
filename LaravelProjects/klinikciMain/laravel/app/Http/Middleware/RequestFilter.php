<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\IpAdress;


class requestFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
    public function handle($request, Closure $next)
    {
        // dd($request->url());
        $clearUrl =urldecode ($request->url());
        // $sonuc = Systems::create($request->all(), ['url' => $clearUrl]);
        // $sonuc = $request->merge(['url' => $clearUrl]);
       
        // dd($request);
        $benimIp = "127.0.0.1";
        $requestIp = $request->ip();
        if($requestIp == $benimIp){ // localde 2 farklı ip gönderdiği için bu işlemi yaptık
            $requestIp = "::1";
           
        }
        // dd($requestIp) ;
        
        try{
            $ip = IpAdress::where('ipadress',$requestIp)->first();
        }
        catch (Illuminate\Database\QueryException $e){
           
            }

      
        
        // dd($ip);
        // dd( $ipvarmi);
        if(!$ip){
            
            $newIp = new IpAdress;
           $newIp->ipEkle($requestIp);
            // dd($newIpSave);
        }
        else{
            $ip->hitArttir();
            

        }
        // $now = Carbon::now();
            
        // dd(date_default_timezone_get());
        // dd($now);
        



        foreach ($request->all() as $key => $value) {
          
            if (is_string($request->$key)) {
               if ($request->$key != htmlspecialchars(trim($value))) {
                //    echo 'nabıyon sen';
                // dd($request->$key);
                // script kaydırma yapılmaya çalışıyo olabilir bunun filtresi burada yapılacak
                // $request->$key = htmlspecialchars(trim($value));// her halukarda trim ve html special chars filteri koyuldu
            }
             
            // her stringin geçtiği yer geçtiği yer işlemleri burada yapabilirsin
            



            $request->$key = htmlspecialchars(trim($value));// her halukarda trim ve html special chars filteri koyuldu
           }
          
        }

        return $next($request);
    }
}
