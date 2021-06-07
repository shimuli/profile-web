<div class="col-md-8">
    <div class="panel blog-container">
        <div class="panel-body">
            <div class="image-wrapper">
                <a class="image-wrapper image-zoom cboxElement" href="#">
                    <img src="{{ asset('img/articles.jpg') }}" alt="Photo of Blog">
                    <div class="image-overlay"></div>
                </a>
            </div>
            @if ($article->comments_count)
                <p>{{ $article->comments_count }} comments</p>

            @else
                <p>0 comments</p>
            @endif
            <h4><a href="{{ route('articles.show', ['article' => $article->id]) }}">{{ $article->title }}</a> </h4>
            <small class="text-muted">By <a href="#"><strong>{{ $article->user->name }}</strong></a> | <p>
                    {{ $article->created_at->diffForHumans() }}</p> </small>
        </div>
    </div>
</div>

<div class="mb-5 mt-1">
    <a class="btn btn-primary" href="{{ route('articles.edit', ['article' => $article->id]) }}">Edit</a>
    <form class="d-inline" method="POST" action={{ route('articles.destroy', ['article' => $article->id]) }}>
        @csrf
        @method('DELETE')
        <input class="btn btn-danger" type="submit" value="Delete!">
    </form>
</div>
