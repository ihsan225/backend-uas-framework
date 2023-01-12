<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    //auth Register, Login, Logout User
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function get_users(){
        $users = User::all();
        return response()->json(['users'=> $users]);
    }

    public function get_users_by_id($id){
        $users = User::where('id',$id)->get();
        return response()->json(['users'=> $users]);
    }
    
    public function update_user(Request $request)
    {
    $where = array('id' => $request->id);
        $data = array('name' => $request->name, 'email' => $request->email);
        $update = User::where($where)->update($data);
        if($update){
            return response()
            ->json(['message' => 'Update Data Success ', 'code' => 200, 'update data ' => $data, ]);
        }else{
            return response()
            ->json(['message' => 'Update Data Filed ', 'code' => 401, 'update data ' =>null, ]);
        }
    }

    public function deleteuser($id){
        $where = array('id' => $id);
        $del = User::where($where)->delete();
        if($del)
        {
            return response()
            ->json(['message' => 'Delete Data Success ', 'code' => 200, 'update data' => $data, ]);
        }else{
            return response()
            ->json(['message' => 'Delete Data Filled ', 'code' => 401, 'update data' => null, ]);
        }
    }
    //method for user logout and delete token

    public function delete($id)
    {
        $del = User::where('id', $id)->delete();
        if ($del) {
            return response()->json(['msg' => 'delete data user successfully']);
        }
    }

    }