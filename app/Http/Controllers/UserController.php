<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Helpers\Token;


class UserController extends Controller
{

    public function login(Request $request)
    {

        if ($request->email != null) 
        {
            $user = User::where('email', $request->email)->first();
        }
        else 
        {
            return response()->json(['message' => 'No has enviado el email'], 401);    
        }
        if ($user->password == $request->password)
        {   
            $data_token = new Token(['email' => $user->email]);
            $token_encode = $data_token->encode();

            return response()->json(["token"=>$token_encode,], 200);
        }      
        return response()->json(['message' => 'No registrado'], 401);
    }

    public function lend(Request $request)
    {
        $request_token = $request->header('Authorization');
        $token = new Token();
        
        $decoded_token = $token->decode($request_token);     
       
        $user = User::where('email', '=', $decoded_token->email)->first();
       
        if (!$request->title != null)
        {
            $book = Book::where('title', '=', $request->title)->first();
            $book_id = $book->id;
            $user->books()->attach($book_id);

            return response()->json(['message' => 'Libro prestado'], 200); 

        } else
        
        {
            return response()->json(['message' => 'Libro no registrado'], 401);
        }

    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        foreach ($users as $key => $value) 
        {
            print($value);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->register($request);
        
        $data_token = ["email"=>$user->email];
        
        $token = new Token($data_token);
        $token_encode = $token->encode();
        return response()->json(["token"=> $token_encode], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   
}
