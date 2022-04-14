<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use DB;
use Mail;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all(); //fetch all blog posts from DB
	    // return $posts; //returns the fetched posts
        
        $posts = Post::paginate(10);//get 10 posts
        return view('blog.index', [
            'posts' => $posts,
        ]); //returns the view with posts
        
    }

    public function save_comment(Request $request){
        
        $data=new Comment;
        $data->post_id=$request->post;
        $data->description=$request->comment;
        $data->user_id=$request->user;
        $data->save();
        
        $posts_user_id = DB::table('posts')
        
        ->where('posts.post_id', '=', $data->post_id)
        ->get();

        
        

        $email = DB::table('users')
        ->where('users.user_id', '=', $posts_user_id->first()->post_id)
        ->get();


        $to_name = $email->first()->name;
        $to_email = $email->first()->email;
        $data = array('name'=>$email->first()->name, "body" => "Someone has added a comment to your post");
        Mail::send('blog.mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Laravel Test Mail');
        $message->from('hello@example.com','Test Mail');
        });
        

        return response()->json([
            'bool'=>true,'email'=> $email->first()->email
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'description' => 'required|max:255',  
        ]);
        $newPost = Post::create([
            'title' => $request->title,
            'description' => $request->body,
            'user_id' => auth()->user()->user_id        
        ]);

        return redirect('blog/' . $newPost->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {    
        //gets id of post
        $postid = $post -> post_id;
        
        //joins commment table and the post table 
        //gets all comments associated with the post
        $comments = DB::table('comments')
                ->leftjoin('users','users.user_id','=','comments.user_id')
                ->where('comments.post_id', '=', $postid)
                ->orderby('comments.created_at', 'desc')
                ->get();
        //gets the user who created the post 
        $posts = DB::table('posts')
                ->leftjoin('users','users.user_id','=','posts.user_id')
                ->where('posts.post_id', '=', $postid)
                ->get();
        
        //var_dump($posts);
        //exit();
        return view('blog.show', [
            'post' => $posts->first(), 'comments' => $comments,
        ]); //returns the view with the post and comments
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' => $post, ]); //returns the edit view with the post
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'description' => $request->body
        ]);

        return redirect('blog/' . $post->post_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/blog');
    }
}
