<div class="card mb-3 mx-auto animate__animated animate__fadeInRight">
    <div class="card-body">
        <h3 class="card-title">{{ $post->title }}</h3>
        <p class="card-text">{{ $post->body }}</p>
        <h5>{{ $post->user->name }}</h5>
        <small>{{ $post->created_at }}</small>
        @auth    
            @if (auth()->user()->id === $post->user->id)
                <div class="d-flex flex-row">
                    <a href="{{ route('myposts.edit', $post->id) }}" class="btn btn-warning me-2" title="Szerkesztés"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('myposts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Törlés"><i class="bi bi-trash3"></i></button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</div>