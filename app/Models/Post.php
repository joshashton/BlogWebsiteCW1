<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'title',
        'description'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){

        return $this->hasMany(Comment::class);
    }
}

