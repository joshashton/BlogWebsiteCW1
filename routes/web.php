<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::post('/viewpost', function () {
    return view('viewpost');
})->name('viewpost');


// The route we have created to show all blog posts.
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index'])->name('blog');

Route::get('/blog/{post}', [\App\Http\Controllers\BlogPostController::class, 'show']);

Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create'])->middleware('auth')->name('create/post'); //shows create post form
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']); //saves the created post to the databse
Route::get('/blog/{post}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); //shows edit post form

Route::put('/blog/{post}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); //commits edited post to the database 
Route::delete('/blog/{post}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); //deletes post from the database

//gets all posts created by that user 
Route::get('/myposts', [\App\Http\Controllers\UserPostController::class, 'index'])->middleware('auth')->name('myposts');

Route::post('save-comment','\App\Http\Controllers\BlogPostController@save_comment');

Route::get('/mycomments', [\App\Http\Controllers\CommentController::class, 'index'])->middleware('auth')->name('mycomments');
Route::get('/mycomments/{comment}', [\App\Http\Controllers\CommentController::class, 'show']);
Route::get('/mycomments/{comment}/edit', [\App\Http\Controllers\CommentController::class, 'edit']); //shows edit post form

Route::put('/mycomments/{comment}/edit', [\App\Http\Controllers\CommentController::class, 'update']); //commits edited post to the database 
Route::delete('/mycomments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy']); //deletes post from the database

require __DIR__.'/auth.php';
