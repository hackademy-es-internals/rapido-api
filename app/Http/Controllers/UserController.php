<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class UserController extends Controller
{
   

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['message'=>'user_not_found'], 404);
            }
            } catch (TokenExpiredException $e) {
                    return response()->json(['message' =>'token_expired'], $e->getStatusCode());
            } catch (TokenInvalidException $e) {
                    return response()->json(['message' =>'token_invalid'], $e->getStatusCode());
            } catch (JWTException $e) {
                    return response()->json(['message' =>'token_absent'], $e->getStatusCode());
            }
        return new UserResource($user);
    }
    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            "name"=>'required|min:2|max:255',
            "email"=>'required|string|email|max:255|unique:users',
            "password"=>'required',
            "password_confirmation"=>'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }   

        $userData = $validator->validated();
        
        $userData['password'] = Hash::make($request->get('password'));
        
        $user = User::create($userData);
        $token = JWTAuth::fromUser($user);
        $user = new UserResource($user);
        return response()->json(compact('user','token'),201);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($user->update($request->all()))
            return new UserResource($user);
        
        return response()->json(['message' => 'Error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete())
            return response()->json(['message' =>'success'],200);
        
        return response()->json(['message' => 'Error'], 500);
        
    }
}
