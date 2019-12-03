<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function books()
    {
        return $this->belongsToMany('App\Book', 'user_lend_book');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
    }
}
