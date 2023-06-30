<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Tüm todoları listele
     */
    public function index(Request $request)
    {
        if (!$request->query('user_id')) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'user_id  is required',
                'payload' => null
            ];
            return Response($response, 200);
        }
        $check_user = User::where("id", $request->query('user_id'))->first();

        if(!$check_user){
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'Database\'de kayıt olmayan bir kullanıcı id\'i ile istek atıldı.',
                'payload' => null
            ];
            return Response($response, 200);
        }

        $response = [
            'reason' => 'success',
            'reasonCode' => 1,
            'message' => 'İşlem başarıyla gerçekleştirildi.',
            'payload' => Todo::where("user_id", $request->query('user_id'))->get()
        ];
        return Response($response, 200);
    }

    /**
     * Todo oluştur
     */
    public function create(Request $request)
    {
        if (!$request->user_id || !$request->action) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'user_id & action is required',
                'payload' => null
            ];
            return Response($response, 200);
        }
        $data = [
            'user_id' => $request->user_id,
            'action' => $request->action,
            'created_at' => now()
        ];
        $insert = Todo::insertGetId($data);

        if ($insert) {
            $response = [
                'reason' => 'success',
                'reasonCode' => 1,
                'message' => 'İşlem başarıyla gerçekleştirildi.',
                'payload' => Todo::where("id", $insert)->first()
            ];
            return Response($response, 200);
        } else {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'Beklenmedik bir hata oluştu.Lütfen tekrar deneyiniz.',
                'payload' => null
            ];
            return Response($response, 200);
        }
    }


    /**
     * Todo güncelle
     */
    public function edit(Request $request, $id)
    {
        if (!$request->input("action") || !$request->input("status")) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'action & status requried',
                'payload' => null
            ];
            return Response($response, 200);
        }

        $find = Todo::where("id", $id)->first();

        if (!$find) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'Database\'de kayıt olmayan bir id değeri ile istek attınız.',
                'payload' => null
            ];
            return Response($response, 200);
        }

        $data = [
            'action' => $request->input("action"),
            'status' => $request->input("status"),
            'updated_at' => now()
        ];

        $update = Todo::where("id", $id)->update($data);

        if ($update) {
            $response = [
                'reason' => 'success',
                'reasonCode' => 1,
                'message' => 'İşlem başarıyla gerçekleştirildi.',
                'payload' => Todo::where("id", $id)->first()
            ];
            return Response($response, 200);
        } else {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'Beklenmedik bir hata oluştu.Lütfen tekrar deneyiniz.',
                'payload' => null
            ];
            return Response($response, 200);
        }


    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!$id) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'id is requried',
                'payload' => null
            ];
            return Response($response, 200);
        }
        $find = Todo::where("id", $id)->first();

        if (!$find) {
            $response = [
                'reason' => 'error',
                'reasonCode' => 0,
                'message' => 'Database\'de kayıt olmayan bir id değeri ile istek attınız.',
                'payload' => null
            ];
            return Response($response, 200);
        }

        $delete = Todo::where("id", $id)->delete();
        if ($delete) {
            $response = [
                'reason' => 'success',
                'reasonCode' => 1,
                'message' => 'İşlem başarıyla gerçekleştirildi.',
                'payload' => $id
            ];
            return Response($response, 200);
        } else {
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