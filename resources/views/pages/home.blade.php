@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="flex flex-column col-12 col-md-10 col-lg-8 col-xl-6 mt-5">
                
            <div class="text-center mb-5">
                <h3>Blog bejegyzések</h3>
                <x-alert />
            </div>

            @if (count($posts) < 1)
                <h4 class="text-center">Még nincs egy bejegyzés sem!</h4>
            @else
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            @endif
            
        </div>
    </div>
</div>
@endsection