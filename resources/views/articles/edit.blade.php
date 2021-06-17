@extends('layouts.app')

@section('title','Edit Article')

@section('content')
<br>
<br>
<br>
<br>
<form class="container" action="{{ route('articles.update', ['article' => $article->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('articles.partials.form')
    <div>
        <input class="btn btn-primary btn-block" type="submit" value="Update">
    </div>
</form>

  @include('footer.footer')
@endsection
