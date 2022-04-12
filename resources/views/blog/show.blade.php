@extends('layouts.app')
@section('content')


    <div class="container">
        @if (Auth::check() && $post->user_id == auth()->user()->user_id )
        <div class="row">
            <div class="col-12 pt-2">
                
                
                
                <a href="/blog/{{ $post->post_id }}/edit" class="btn btn-outline-primary">Edit Post</a>
                
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete Post</button>
                </form>
            </div>
        </div>
        @endif
    
        <div class="row mb-2">
            
            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                    
                        <h1>{{ ucfirst($post->title) }}</h1>
                        
                        <p class="card-text mb-auto">{{ ucfirst($post->description) }}</p>
                            
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        
    </div>

@endsection