@extends('layouts.app')

@section('title', 'Blog Posts')
@section('content')

    {{-- @foreach ($articles as $key => $article)
<div>{{$key}}.{{ $article['title'] }}</div>
@endforeach --}}

    <main id="main">
        <section class="section gray-bg" id="blog">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <div class="section-title">
                            <h2>Articles</h2>

                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($articles as $article )

                        @include('articles.partials.articles')
                    @empty
                        No post found
                    @endforelse

    </main>

    @include('footer.footer')
@endsection
