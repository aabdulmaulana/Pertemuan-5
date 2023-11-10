<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\user;

class Authcontroller extends Controller
{
    //membuat fitur register
    public function register(Request $request){
        #menangkap inputan
        $input=[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        #menginsert data ke table user
        $user = User::create($input);
        $data = [
            'message' => 'User is created successfully'
        ];

        #mengirim respone JSON
        return respone()->json($data,200);
    }

    # membuat fitur login
    public function login(Request $request){
        # menangkap input user
        $input =[
            'email' => $request->email,
            'password' => $request->password
        ];

        # Mengambil data user (DB)
        $user = User::where('email', $input['email'])->first();

        # Membandingkan input user dengan data user (DB)
        $isLoginSuccessfully=(
            $input['email']==$user->email&&
            hash::check($input['password'], $user->password)
        );
        if ($isLoginSuccessfully) {
            # membuat token
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login successfully'
                'token' => $token->plaintextToken
            ];

            # mengembalikan respone JSON
            return respone()->json(data, 200);

        } else {
            $data = [
                'message' => 'Username or Password is wrong'
            ];
            return response()->json($data, 401);
        }
    }
}
