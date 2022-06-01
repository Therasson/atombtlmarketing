<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
     /**
     * Inscription de nouvel utilisateur
     */
    public function register(Request $request)
    {
   
        //validate user
        $attrs = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        //create user
        $user = User::create([
            'name' => $attrs['name'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password'])
        ]);

        $userRole = $request->role;
       
        //Assignation de rôle user
        $role = Role::where('name', $userRole)->first();
       
        if($role){
            $user->assignRole($role->name);
        }
        else{
            return response ([
                'message' => 'Invalid role'
            ], 403);
        }

        //return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);

    }
    

    /**
     * Connexion d'un utilisateur
     */
    public function loginOld(Request $request)
    {
       
        //validate user
        $attrs= $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        //attempt login
        if(!Auth::attempt($attrs))
        {
            return response ([
                'message' => 'Invalid credentials'
            ], 403);
        }


        //return user & token in response 
        return response([
            'user' => auth()->user(),
            'Role' => auth()->user()->getRoleNames(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);

    }


    public function login (Request $request){
        
        $success = true;
        return response([
            'success' => $success
        ], 200);

        
        /*$credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if(Auth::attempt($credentials)){
            $success = true;
            $message = 'User login successfully';
        }else{
            $success = false;
            $message = "Unauthorised";
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];

        return response()->json($response);*/
    }


    /**
     * Logout function
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ]);
    }

}
