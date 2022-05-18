<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;

class Commentar extends Model
{
    use HasFactory;

    protected $table = 'commentars';

    protected $fillable = [
        'user_id',
        'post_id',
        'comment'
    ];

    public function userto(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function postto(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
