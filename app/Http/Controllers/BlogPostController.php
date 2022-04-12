<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use DB;


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
        
        return response()->json([
            'bool'=>true
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
        //$posts = Post::where('user_id', '=', auth()->user()->user_id)->get();//get all post from current user
        //return $post; //returns the fetched posts

        //$comment = Comment::all();
        $postid = $post -> post_id;
        
        $comments = DB::table('comments')
                ->leftjoin('users','users.user_id','=','comments.user_id')
                ->where('comments.post_id', '=', $postid)
                ->orderby('comments.created_at', 'desc')
                ->get();
        

        //$comments = Comment::where('post_id', '=', $postid)->get();
        //$users = User::where('user_id', '=', $comments->user_id)->get();
        //$post -> post_id
        //var_dump($comments);
        //exit();
        return view('blog.show', [
            'post' => $post, 'comments' => $comments,
        ]); //returns the view with the post
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
