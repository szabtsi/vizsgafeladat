<form action="{{ route('post.store') }}" class="login_form" method="post">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Példa Cím" value="{{ old('title') }}">
        <label for="title">Cím</label>

        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Leave a comment here" id="body"></textarea>
        <label for="body">Bejegyzés tartalma</label>

        @error('body')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" id="createPostBtn" class="btn btn-primary animate__animated animate__bounceIn">Létrehozás</button>
    </div>
</form>