<?php

namespace App\Http\Controllers;

use App\Models\Haber;
use Illuminate\Http\Request;
use App\Models\IletisimMesaj;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function contact(Request $request){
        // dd($request->all());
        $message = [
            'name.required'=>'Please enter yours name',
            'name.min'=>'Yours name must be min 2 characters',
            'name.max'=>'Yours name must be max 100 characters',
            'email.required'=>'Please enter yours name',
            'konu.required'=>'Please enter subject',
            'konu.min'=>'Subject must be min 2 characters',
            'konu.max'=>'Subject must be max 100 characters',
            'mesaj.required'=>'Please enter message',
            'mesaj.min'=>'Message must be min 10 characters',
            'mesaj.max'=>'Message must be min 500 characters'

        ];
        $validator = Validator::make($request->all(), [
            'name' => 'min:2|required|max:100',
            'email' => 'min:2|required|max:100|email',
            'konu' => 'min:2|required|max:100',
            'mesaj' => 'min:10|required|max:500',
        ],$message);
         if($validator->errors()->all()){
             return Redirect::to(route('iletisim'))->with('errors', $validator->errors()->all());
 
         }

         $mesaj = new IletisimMesaj;
         $mesaj->name = $request->name;
         $mesaj->email = $request->email;
         $mesaj->konu=$request->konu;
         $mesaj->mesaj = htmlspecialchars($request->mesaj);
         $sonuc = $mesaj->save();
         if($sonuc){
            return Redirect::to(route('iletisim'))->with('succes', 'Yours message come us succesfuly.Thanks for sending message to us');
         }
         else{
            return Redirect::to(route('iletisim'))->with('errors', ['Ops! We have a problem. We will solve this problem as soon as possible...']);
         }
        //  dd($sonuc);
        //  dd($request->all());
    }

    public function search(Request $request){
        $haberler = Haber::where('icerik', $request->search)
        ->orWhere('icerik', 'like', '%' . $request->search . '%')->
        orWhere('baslik', 'like', '%' . $request->search . '%')->orWhere('baslik', $request->search)->paginate(2);
        // dd($haberler);
        // dd($request->all());
        return view('pages.searchPage',[
            'searchText'=>$request->search,
            'haberler'=>$haberler
        ]);

        

    }
}
