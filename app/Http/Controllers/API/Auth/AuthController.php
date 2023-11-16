<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(Request $request){

        $request->validate([
            "phone" => ['required'],
            "password" => ["required"],
            "device_name" => ['required']
        ]);

        $user = User::where("phone", $request->phone)->where("active", 1)->where("admin", 0)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(
                [
                    'status' => 'fail',
                    'message' => 'Numéro de téléphone ou mot de passe incorrect.',
                ], 404
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'token' => $user->createToken($request->device_name)->plainTextToken,
            ], 200
        );

    }

    public function destroy(Request $request){
        $user = $request->user();

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vous êtes déconnecté',
        ], 200);
    }

    public function user(){

        return response()->json([
            "status" => "success",
            "message" => "",
            "id" => "".Auth::user()->id,
            "name" => Auth::user()->name
        ], 200);
    }

}
