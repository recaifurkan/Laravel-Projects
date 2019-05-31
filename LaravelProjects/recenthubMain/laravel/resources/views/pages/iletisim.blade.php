@extends('layouts.master')

@section('title')
@php
    $title = 'Contact : recentHub'
@endphp
<title>{{$title}}</title>
@endsection
@section('meta')
<meta name="description" content="Contact us Here">
<meta name="keywords" content="contact,us,talk,comment">

@endsection

@section('css')

@endsection

@section('icerik')
<section id="ContactContent">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="contact_area">
              <h1>Contacts</h1>
              <p>Hello! All your inquiries and feedback is important to us please contact here.</p>
              <div class="contact_bottom">
                <div class="contact_us wow fadeInRightBig">
                  <h2>Contact Us</h2>
                  <form action="/contact" method="post" class="contact_form">
                    @if(count($errors)>0)
                            @foreach ($errors as $error)
                            <div class='alert alert-danger'>{{$error}}    </div>
                            @endforeach
                
                        @endif
                        @php
                        if(session()->get('succes')){
                            $succes = session()->get('succes');
                        }
                           
                        @endphp
                        @if (isset($succes))
                        <div class='alert alert-success'>{{$succes}}    </div>
                        @endif
                      @csrf
                    <input class="form-control" type="text" name="name" required placeholder="Name(required)">
                    <input class="form-control" type="email" name="email" required placeholder="E-mail(required)">
                    <input class="form-control" type="text" name="konu" required placeholder="Subject">
                    <textarea required class="form-control" cols="30" name="mesaj" rows="10" placeholder="Message(required)"></textarea>
                    <input type="submit" value="Send">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>









    
@endsection

@section('js')
    
@endsection