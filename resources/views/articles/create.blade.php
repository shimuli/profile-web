@extends('layouts.app')

@section('title','Create new Article')

@section('content')

<main id="main">

<br>
<br>
<br>
<form class="container" action="{{ route('articles.store') }}" method="POST">
    @csrf
    @include('articles.partials.form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Create">
    </div>
</form>

</main>
  @include('footer.footer')
@endsection
