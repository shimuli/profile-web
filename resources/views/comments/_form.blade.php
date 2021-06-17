<div class="mb-2 mt-2 mr-15">
    @auth

    <form action=" {{ route('articles.comments.store', ['article'=>$article->id]) }}" method="POST" >
        {{--   --}}
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-control"></textarea>
        </div>
        @error('content')
        <div class="alert alert-danger"  role="alert">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary btn-block">Add Comment!</button>
    </form>
    @else
    <a href="{{ route('login') }}">Sign in to post comments</a>
    @endauth
</div>
</hr>


