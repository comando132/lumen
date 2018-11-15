<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Tabla;
use App\User;
use App\Http\Controllers\Controller;

class PrincipalController extends Controller {

    var $messages = [
        'required' => 'El atributo :attribute debe existir.',
        'numeric' => 'El atributo :attribute debe ser numero.'
    ];

    public function index() {
        $status = 200;
        try {
            $this->respuesta['data'] = Tabla::orderBy('id', 'asc')->get();
        } catch (Exception $e) {
            $this->respuesta['status'] = "1";
            $this->respuesta['msj'] = $e->getMessage();
        } finally {
            return response()->json($this->respuesta, 200);
        }
    }

    public function suma(Request $request) {
        $data = $request->all();
        // solo json
        //$data = $request->json()->all();
        $validator = Validator::make($request->all(), [
                    'user' => 'required',
                    'password' => 'required',
                    'a' => 'required|numeric',
                    'b' => 'required|numeric',
                        ], $this->messages);
        try {
            if (!$validator->fails()) {
                $user = User::where('login', 'LIKE', $data['user'])
                        ->where('password', 'LIKE', $data['password'])
                        ->firstOrFail();
                if ($user->id) {
                    $tabla = new Tabla();
                    $tabla->fill($data);
                    $attr = $tabla->getAttributes();
                    $res = 0;
                    if (count($attr) > 0) {
                        foreach ($attr as $at) {
                            $res += $at;
                        }
                        $tabla->fill(['res' => $res]);
                        if ($tabla->save()) {
                            $this->respuesta['data'] = $res;
                        }
                    }
                }
            } else {
                $this->respuesta['status'] = "2";
                $this->respuesta['msj'] = $validator->errors()->all();
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $m) {
            $this->respuesta['status'] = "3";
            $this->respuesta['msj'] = "Usuario o password incorrecto";
        } catch (\Exception $e) {
            $this->respuesta['status'] = "1";
            $this->respuesta['msj'] = $e->getMessage();
        } finally {
            return response()->json($this->respuesta, 200);
        }
    }

}