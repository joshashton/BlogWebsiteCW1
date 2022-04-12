@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">My Posts</h1>
                        
                    </div>
                   
                </div>          
            </div>
        </div>           
        <div class="row mb-2">
            @forelse($posts as $post)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                    
                        <h3 class="mb-0">{{ ucfirst($post->title) }}</h3>
                        <div class="mb-1 text-muted">{{$post->created_at->format('d F Y')}}</div>
                            <p class="card-text mb-auto">{{ ucfirst($post->description) }}</p>
                            <a href="./blog/{{ $post->post_id }}" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

                        </div>
                    </div>
                </div>
        
            @empty
            <p class="text-warning">No blog Posts available</p>
            @endforelse
            
        </div>
    </div>
@endsection