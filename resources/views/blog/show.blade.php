@extends('layouts.app')
@section('content')
    <div class="container">
        
        @if (Auth::check() && $post->user_id == auth()->user()->user_id || Auth::check() && auth()->user()->role == 'admin')
        <div class="row">
            <div class="col-md-12">
                <a href="/blog/{{ $post->post_id }}/edit" class="btn btn-outline-primary">Edit Post</a>
                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete Post</button>
                </form>
            </div>
        </div>
        @endif
    
        <div class="row">
            <div class="col-md-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h1>{{ ucfirst($post->title) }}</h1>
                        <p class="card-text mb-auto">{{ ucfirst($post->description) }}</p>  
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="33%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        </div>
                        <p class="card-text mb-auto">Posted by {{ ucfirst($post->name) }}</p> 
                    </div>
                </div>
            </div>
        </div>
        
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

   
        
        
            <h5 class="card-header">Comments <span class="comment-count float-right badge badge-info"></span></h5>
            <div class="card-body">
                @if (Auth::check())
                {{-- Add Comment --}}
                <div class="add-comment mb-3">
                    @csrf
                    <textarea class="form-control comment" placeholder="Enter Comment"></textarea>
                    <button data-post="{{ $post->post_id }}" data-user="{{ Auth::user()->user_id }}" class="btn btn-dark btn-sm mt-2 save-comment">Submit</button>
                </div>
                @else

                @endif
            </div>  
            <div class="comments">
                
        @forelse($comments as $comment)
           
                <!-- COMMENT 1 - START -->
                <div class="media mb-5">
                    
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->name }}</h4>
                        <p>{{ ucfirst($comment->description) }}</p>
                        <ul class="list-unstyled list-inline media-detail pull-left">
                           
                            <li><i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</li>

                        </ul>
                        
                    </div>
                </div>

                <!-- COMMENT 1 - END -->
        @empty
            <p class="text-warning">No comments available</p>
        
        @endforelse
            </div>
            </div>
        </div>
    
        
    </div>
 @if (Auth::check())
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
// Save Comment
$(".save-comment").on('click',function(){
    var _comment=$(".comment").val();
    var _post=$(this).data('post');
    var _user=$(this).data('user');

    var vm=$(this);
    // Run Ajax
    $.ajax({
        url:"{{ url('save-comment') }}",
        type:"post",
        dataType:'json',
        data:{
            comment:_comment,
            post:_post,
            user:_user,
            _token:"{{ csrf_token() }}"
        },
        beforeSend:function(){
            vm.text('Saving...').addClass('disabled');
        },
        success:function(res){
            var _html='<div class="media blockquote animate__animated animate__bounce">\
                    <div class="media-body mb-5">\
                        <h4 class="media-heading">{{ Auth::user()->name }}</h4>\
                        <p>'+_comment+'</p>\
                        <ul class="list-unstyled list-inline media-detail pull-left">\
                            <li><i class="fa fa-calendar"></i>\
                            </li></ul>\
                    </div>\
                </div>';
            
            if(res.bool==true){
                $(".comments").prepend(_html);
                $(".comment").val('');
                $(".comment-count").text($('blockquote').length);
                $(".no-comments").hide();
            }
            vm.text('Save').removeClass('disabled');
        }   
    });
});
</script>
@endif

@endsection