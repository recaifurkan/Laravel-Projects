@extends('layouts.master')

@section('title')
@php
    $title = 'Searched Text "'. $searchText .'"'; 
@endphp
<title>{{$title}}</title>
@endsection
@section('meta')
<meta name="description" content="Results for {{$searchText}}">
<meta name="keywords" content="{{$searchText}}">

@endsection 

@section('css')

@endsection

@section('icerik')

<div class="searchResults">
        @if ($haberler->count()==0)
        <div class="alert alert-danger" >Not found result for "{{$searchText}}"</div>
                
                @else
                <h2>Results for "<span class="alert alert-danger">{{$searchText}}</span>"</h2>
                <ul class="small_catg popular_catg wow fadeInDown">
                   
                    @foreach ($haberler as $haber)
                    @php
                        $haberResim = $haber->getResim('112x112');
                    @endphp
                    <li>
                    <div class="media wow fadeInDown"> <a href="{{getHaberUrl($haber)}}" class="media-left"> 
                        {!!getHaberResim($haberResim) !!} </a>
                            <div class="media-body">
                            <h4 class="media-heading">
                                @php
                                $searchTextLenght = strlen($searchText);
        
                                
                                $posIcerik = strpos($haber->icerik,$searchText);
        
                                
                                $haber->icerik = mb_substr($haber->icerik,$posIcerik);
        
                                
                                $searchTextIcerik = mb_substr($haber->icerik,0,$searchTextLenght);
        
                                
                                $icerikGeriKalan = mb_substr($haber->icerik,$searchTextLenght);

                                
                                $icerikCharacter = strlen($icerikGeriKalan);
                                // dd($icerikCharacter);

                                

                                if($icerikCharacter>60){
                                    $icerikGeriKalan = mb_substr($icerikGeriKalan,0,59);
                                }
                                // dd(strlen($icerikGeriKalan));
                                // dd($posBaslik);
                               
                                
                                if($posIcerik){
                                    $haber->icerik = '<mark>'.$searchTextIcerik .'</mark>'.$icerikGeriKalan;
                                }else{
                                    $haber->icerik = mb_substr($haber->icerik,0,59);
                                }
                                // dd($haber->icerik);
        
                                //    dd($posBaslik);
                                @endphp
                                <a href="{{getHaberUrl($haber)}}">{!!$haber->baslik!!} </a></h4>
                            <p>{!!$haber->icerik!!} </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                   
                 
                 
                </ul>  
               
            @endif

        <div class="text-center">

                {{$haberler->appends('search',$searchText)->links()}}
        </div>
        
      </div>
    
@endsection

@section('js')
    
@endsection