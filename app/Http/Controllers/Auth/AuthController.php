<?php

namespace App\Http\Controllers\Auth;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
// use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        // $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function authentications(Request $request){

        $validator = Validator::make($request->all(), [
            'email'       => 'required|email',
            'password'    =>'required'
        ]);
        if ($validator->fails()) {
            // return $validator->errors()->all();
          return response()->json(['error'=>"validation failed"],401);
        }else{
            // $user = User::first();

        // return $token = JWTAuth::fromUser($user);
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'],400);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        
        return response()->json(compact('token'),200);

        }
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname'   => 'required',
            'lastname'    => 'required',
            'email'       => 'required|email',
            'password'    =>'required',
            'passwordconfirmation' =>'required|same:password'
        ]);
        if ($validator->fails()) {
            // return $validator->errors()->all();
          return response()->json(['error'=>"validation failed"],401);
        }
        else{
            if (User::where('email', '=', $request->email)->exists()) {
              return response()->json(['error'=>"email exists"],400);
          }
         $user=new User;
         $user ->firstname =$request->firstname;
         $user ->lastname  =$request->lastname;
         $user ->email     =$request->email;
         $user ->password  =bcrypt($request->password);
         $user->save();
         return response()->json('success',200);
        }
    }
    public function logout()
    {
       return response()->json(['success' =>"logout success"]);
    }
}
