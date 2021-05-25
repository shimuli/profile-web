<div class="form-group">
    <label for="title">Title</label>

    <br>
    <input class="form-control" type="text" id="title" name="title" value="{{ old('title', optional($article ?? null)->title) }}" autofocus>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<br>
<div class="form-group">
    <label for="content">Content</label>
    <br>
    <textarea class="form-control"  name="content" id="content" cols="20" rows="10">{{ old('content', optional($article ?? null)->content) }}</textarea>
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<br>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
