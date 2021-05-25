@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
  {{--  Hero Section  --}}
  <section id="hero" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center" data-aos="zoom-in" data-aos-delay="100">
      <h1 style="color: white">Cedric</h1>
      <h2 style="color: #00FFFF" >Full stack Software Developer</h2>
      <a href="{{ route('about.index') }}" class="btn-about">About Me</a>
    </div>
  </section>

  @include('footer.footer')
@endsection

