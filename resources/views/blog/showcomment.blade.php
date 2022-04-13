@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Auth::check() && $comment->user_id == auth()->user()->user_id )
        <div class="row">
            <div class="col-md-12">
                <a href="/mycomments/{{ $comment->comment_id }}/edit" class="btn btn-outline-primary">Edit comment</a>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete comment</button>
                </form>
            </div>
        </div>
        @endif         
        <div class="row mb-2">
            <div class="media mb-5">
                
               <div class="media-body">
                   <h4 class="media-heading">{{ $comment->name }}</h4>
                   <p>{{ ucfirst($comment->description) }}</p>
                   <ul class="list-unstyled list-inline media-detail pull-left">
                      
                    <li><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</li>
                    
                   </ul>
                   
               </div>
           </div>
        </div>
    </div>
@endsection