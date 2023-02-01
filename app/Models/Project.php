<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{


    protected $guarded = [];
    public function users() 
    {

        return $this->belongsToMany(User::class);
    }


    //HasManyThrough : çok sayıda ilişkili task getirir
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Team::class,
         'project_id',  //foreign key in users table
         'user_id',  //foreign key in tasks table
         'id',  //local key in projects table 
         'user_id'  // foreign key in project_user table 
        );
    
    }


    //HasOneThrough : bir adet ilişkişi task getirir
    public function task() 
    {
        return $this->hasOneThrough(Task::class, Team::class,
        'project_id',  //foreign key in users table
        'user_id',  //foreign key in tasks table
        'id',  //local key in projects table 
        'user_id'  // foreign key in project_user table 
       );

    }




    use HasFactory;
}
