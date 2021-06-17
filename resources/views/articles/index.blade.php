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
                    <div class="col-8">
                        @if (is_array($articles) || is_object($articles))


                            @forelse ($articles as $article )
                                <div class="panel blog-container">
                                    <div class="panel-body">
                                        <div class="image-wrapper">

                                            @if ($article->image)
                                                <a class="image-wrapper image-zoom cboxElement" href="#">
                                                    <img src="{{ $article->image->url() }}" alt="Photo of Blog" style="max-height:250px; ">
                                                    <div class="image-overlay"></div>
                                                </a>

                                            @else
                                                <a class="image-wrapper image-zoom cboxElement" href="#">
                                                    <img src="{{ asset('img/articles.jpg') }}" alt="Photo of Blog"  style="max-height:250px; ">
                                                    <div class="image-overlay"></div>
                                                </a>
                                            @endif

                                        </div>
                                        @if ($article->comments_count)
                                            <p>{{ $article->comments_count }} comments</p>

                                        @else
                                            <p>0 comments</p>
                                        @endif

                                        <h4>
                                            {{-- add tags --}}


                                            @if ($article->trashed())
                                                <del>
                                            @endif
                                            <a class="{{ $article->trashed() ? 'text-muted' : '' }}"
                                                href="{{ route('articles.show', ['article' => $article->id]) }}">{{ $article->title }}</a>
                                            @if ($article->trashed())
                                                </del>
                                            @endif
                                        </h4>
                                        <div>
                                            @foreach ($article->tags as $tag)
                                                <a href="{{ route('articles.tags.index', ['tag' => $tag->id]) }}"
                                                    class="badge badge-success">{{ $tag->name }}</a>
                                            @endforeach
                                        </div>

                                        <small class="text-muted">By <a
                                                href="#"><strong>{{ $article->user->name }}</strong></a> | <p>
                                                {{ $article->created_at->diffForHumans() }}</p> </small>
                                    </div>
                                </div>
                                </>

                                <div class="mb-5 mt-1">
                                    @can('update', $article)
                                        <a class="btn btn-primary"
                                            href="{{ route('articles.edit', ['article' => $article->id]) }}">Edit</a>
                                    @endcan

                                    @if (!$article->trashed())
                                        @can('delete', $article)
                                            <form class="d-inline" method="POST"
                                                action={{ route('articles.destroy', ['article' => $article->id]) }}>
                                                @csrf
                                                @method('DELETE')
                                                <input class="btn btn-danger" type="submit" value="Delete!">
                                            </form>
                                        @endcan
                                    @endif

                                </div>

                            @empty
                                No post found
                            @endforelse

                        @else
                            echo "Something is wrong"

                        @endif
                    </div>

                    <div class="col-4">
                        <div class="container">
                            <div class="row">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <h5 class="card-title">Most commented</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">What people are talking about</h6>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($mostCommented as $post)
                                            <li class="list-group-item">
                                                <a
                                                    href="{{ route('articles.show', ['article' => $article->id]) }}">{{ $article->title }}</a>
                                            </li>

                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>

    @include('footer.footer')
@endsection
