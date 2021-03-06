<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    public function __construct(User $user,
                                Request $Request)
    {
        $this->user = $user;
        $this->request = $Request;
    }

    public function index()
    {
        $data = User::all();
        return response()->json($data);
    }

   
    public function store(Request $request)
    {
        try {
            $dataForm =  $request->all();
            $dataForm = array_unique($dataForm);
    
            $retornoKeys = $this->validateKeys($dataForm);
            if ($retornoKeys != '') {
                echo $retornoKeys;
                return; 
            }
            
            $retornoValidate = $this->validarApi($dataForm);
            if ($retornoValidate != '') {
                echo $retornoValidate;
                return;
            }
            if (($retornoKeys == '') and
                ($retornoValidate == '')) {
                    $dataForm = array(
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => bcrypt($request->password)
                    );
            
                    $data = $this->user->create($dataForm);
                    
                    return response()->json($data, 200);
            }
        } catch (Exception $e) {
            return response()->json([
                "erros" => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        try {
            if (!$data = $this->user->find($id)) {
                return response()->json([
                    'description'=> 'Nada Encontrado',
                     'error' => 404
                    ]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json([
                "erros" => $e->getMessage()
            ]);
        }
    }
   
    public function update(Request $request, $id)
    {
        try {
            if (!$data = $this->user->find($id)){
                return response()->json([
                    'error'=> 'Nada Encontrado',
                     404
                    ]);
            } else {
                $dataForm =  $request->all();
                $dataForm = array_unique($dataForm);
        
                $retornoKeys = $this->validateKeys($dataForm);
                if ($retornoKeys != '') {
                    echo $retornoKeys;
                    return; 
                }
                
                $retornoValidate = $this->validarApi($dataForm);
                if ($retornoValidate != '') {
                    echo $retornoValidate;
                    return;
                }
                if (($retornoKeys == '') and
                    ($retornoValidate == '')) {
                        $this->validate($request, $this->user->rules());
            
                        $dataForm = array(
                            "name" => $request->name,
                            "email" => $request->email,
                            "password" => bcrypt($request->password)
                        );
            
                        $data->update($dataForm);
                        
                        return response()->json($data);
                    }
            }
        } catch (Exception $e) {
            return response()->json([
                "erros" => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            if (!$data = $this->user->find($id)){
                return response()->json([
                    'error'=> 'Nada Encontrado', 
                    404
                ]);
            } else {
                $data->delete();
    
                return response()->json([
                    'success'=> 'Deletado com Sucesso'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                "erros" => $e->getMessage()
            ]);
        }
    }

    /**
     * Fun????o que valida dados para cadastro de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    private function validarApi($dataForm, $id = null) {        

        try {
            $messages = [
                'name.required' => 'informe o nome',
                'password.required' => 'informe o password',
                'email.required' => 'informe o email',
                'email.unique' => 'email duplicado',
            ];
    
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ];
    
            $regras = ($id != null) ? $rules : $this->user->rules();
            
            $validator = Validator::make($dataForm, $regras, $messages);

            if ($validator->fails()) {
                return  response()->json([
                            "erros" => $validator->errors()
                        ]);
            }
            return; 
        } catch (Exception $e) {
            return response()->json([
                "erros" => $e->getMessage()
            ]);
        }
    }


    /**
     * Fun????o que valida chaves para cadastro de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    private function validateKeys($dataForm, $id = null) {

        if(count(array_keys($dataForm)) == 3) {
            if (!array_key_exists('name', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [name]',
                     'error' => 404
                    ]);
            }
    
            if (!array_key_exists('email', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [email]',
                    'error' => 404
                ]);
            }
    
            if (!array_key_exists('password', $dataForm)){
                return response()->json(['description'=> 'Falta a chave [password]',
                'error' => 404
            ]);
            }
        } else {
            return response()->json([
                'description'=> 'Quantidade de chaves Incorreta',
                'error' => 404
            ]);
        }
    }
}
