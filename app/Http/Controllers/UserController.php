<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        if(!$request->username){
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'username is required',
                'payload' => null
            ];
            return Response($response, 200);
        }

        $check_username = User::where("username", $request->username)->first();
        if($check_username){
            $response = [
                'reason' => 'success',
                'reasonCode' => 1,
                'message' => 'İşlem başarıyla gerçekleştirildi.',
                'payload' => $check_username
            ];
            return Response($response, 200);
        }else{
            $data = [
                'username' => $request->username,
                'created_at' => now()
            ];
            $insert = User::insertGetId($data);
            if($insert){
                $response = [
                    'reason' => 'success',
                    'reasonCode' => 1,
                    'message' => 'İşlem başarıyla gerçekleştirildi.',
                    'payload' => User::where("id", $insert)->first()
                ];
                return Response($response, 200); 
            }else{
                $response = [
                    'reason' => 'error',
                    'reasonCode' => 0,
                    'message' => 'Beklenmedik bir hata oluştu.Lütfen tekrar deneyiniz.',
                    'payload' => null
                ];
                return Response($response, 200);
            }
        }
    }
}
