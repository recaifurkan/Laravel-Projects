@php
if(session()->get('hatalar')){
 $hatalar = session()->get('hatalar');
}

if(session()->get('succes')){
 $succes = session()->get('succes');
}
    
@endphp
  @if(isset($hatalar))
<div class="alert-danger" >                 
  @foreach ($hatalar as $error)
  {{$error}}  <br>                 
  @endforeach
</div>
@endif

{{-- başarılı bir şekilde kayıt yapıldı mı o göstermek için  --}}


@if(isset($succes))

<div class="alert-success" >
    {{$succes}} 
 </div>


  @endif