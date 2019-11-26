<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";
    protected $fillable = ['title', 'description'];
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_lend_book');
    }
}
