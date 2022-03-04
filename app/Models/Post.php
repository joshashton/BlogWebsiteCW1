<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comment(){

        return $this->hasMany(Comment::class);
    }
}

