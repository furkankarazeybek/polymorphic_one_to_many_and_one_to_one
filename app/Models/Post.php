<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\MagicConst\Method;

class Post extends Model
{

    protected $fillable = ['user_id','title'];
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest User'
        ]);

    }

    //BelongsToMany (many to many)
    public function tags() 
    {
        return $this->belongsToMany(Tag::class, 'post_tag','post_id','tag_id')
        ->using(PostTag::class)
        ->withTimestamps()
        ->withPivot('status');

        //(foreign model, locale ait-foreign key, foreign key)
    }

    //Morphmany - one to many
    public function comments() 
    {
        return $this->morphMany(Comment::class, "commentable");
        
    }
    public function comment() 
    {
        return $this->morphOne(Comment::class, 'commentable')->latest();
    }
    use HasFactory;
}
