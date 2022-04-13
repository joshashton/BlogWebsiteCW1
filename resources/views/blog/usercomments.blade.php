@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">My Comments</h1>
                        
                    </div>
                   
                </div>          
            </div>
        </div>           
        <div class="row mb-2">
        @forelse($comments as $comment)
           
           <!-- COMMENT 1 - START -->
           <div class="media mb-5">
                
               <div class="media-body">
                   <h4 class="media-heading">{{ $comment->name }}</h4>
                   <p>{{ ucfirst($comment->description) }}</p>
                   <ul class="list-unstyled list-inline media-detail pull-left">
                      
                    <li><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</li>
                    <a href="./mycomments/{{ $comment->comment_id }}">Edit</a>
                   </ul>
                   
               </div>
           </div>

           <!-- COMMENT 1 - END -->
        @empty
       <p class="text-warning">No comments available</p>
        @endforelse
        </div>
    </div>
@endsection