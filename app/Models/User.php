<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class User extends Model
{
    use HasFactory;
    use Authenticatable;
    
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_name',
        'email',
        'password'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }



    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comments::class);
    }

}
