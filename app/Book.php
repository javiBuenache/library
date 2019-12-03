<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Book extends Model
{
    protected $table = "books";
    protected $fillable = ['title', 'description'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_lend_book');
    }

    public function register(Request $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->save();
    }
}
