<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use App\User;
use App\user_role;

class HomeController extends Controller
{

    
    public function index(){
    	return view('indexpage.home');
    }

    public function Users(){
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $users=User::find($userId);
        return response()->json(compact('user'));
    }

    public function loginform(){
        return "load login form";
    }

    public function getAuthenticatedUser(){
    	try{
    		if(!$user=JWTAuth::parseToken()->authenticate()){
    			return response()->json(['user not found'], 404);
    		}
    	}
    	catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
    		return response()->json(['token-expired'], $e->getStatusCode());
    	}
    	catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
    		return response()->json(['token_invalid'], $e->getStatusCode());
    	}
    	catch(Tymon\JWTAuth\Exceptions\JWTException $e){
    		return response()->json(['token_absent'], $e->getStatusCode());
    	}
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $role=User::find($userId)->userRole;
    	return response()->json(compact('user','role'));
    }
}
