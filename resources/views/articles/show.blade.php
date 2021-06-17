@extends('layouts.app')

@section('title', $article['title'])


@section('content')
    <main class="mt-5">
        <div class="container">
            <!--Section: Content-->
            <section>
                <div class="row">
                    <div class="col-md-6 gx-5 mb-4">
                        <div class="bg-image hover-overlay ripple shadow-2-strong" data-mdb-ripple-color="light">

                            @if ($article->image)
                                <img src="{{ $article->image->url() }}" class="img-fluid" alt="Image" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>

                                @else
                                 <img src="{{ asset('img/articles.jpg') }}" class="img-fluid" alt="Image" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6 gx-5 mb-4">
                        <h4><strong>{{ $article['title'] }}</strong></h4>
                        <div>
                            @foreach ($article->tags as $tag)
                                <a href="{{ route('articles.tags.index', ['tag' => $tag->id]) }}"
                                    class="badge badge-success">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                        <p class="text-muted">
                            {{ $article['content'] }}
                        </p>
                        {{-- <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
                        <p class="text-muted">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod
                            itaque voluptate nesciunt laborum incidunt. Officia, quam
                            consectetur. Earum eligendi aliquam illum alias, unde optio
                            accusantium soluta, iusto molestiae adipisci et?
                        </p> --}}
                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <div class="card card-white post">
                                    <h3 class="mt-2 ms-5">Comments</h3>

                                    @include('comments._form')
                                    @forelse ($article->comments as $comment )
                                        <div class="post-heading">
                                            <div class="float-left image">
                                                <img src="http://bootdey.com/img/Content/user_1.jpg"
                                                    class="img-circle avatar" alt="user profile image">

                                             
                                            </div>
                                            <div class="float-left meta">

                                                <div class="title h5">
                                                    <a href="#"><b>{{ $comment->user->name }}</b></a>
                                                    made a comment.
                                                </div>
                                                <h6 class="text-muted time"> {{ $comment->created_at->diffForHumans() }}
                                                </h6>
                                            </div>

                                        </div>
                                        <div class="post-description">
                                            <p>{{ $comment->content }}</p>

                                        </div>
                                    @empty
                                        <p>No comments</p>
                                    @endforelse

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            {{-- <!--Section: Content--> --}}
    </main>


    @include('footer.footer')
@endsection
