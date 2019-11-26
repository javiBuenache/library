<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Token;

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
        $user = new Self();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $data_token = ["email"=>$user->email];
        
        $token = new Token($data_token);
        $token_encode= $token->encode();
        return response()->json(["token"=> $token_encode], 201);
    }
}
