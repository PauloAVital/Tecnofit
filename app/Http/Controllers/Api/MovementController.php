<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movement;
use Illuminate\Support\Facades\Validator;
use Exception;

class MovementController extends Controller
{
    public function __construct(Movement $movement,
                                Request $Request)
    {
        $this->movement = $movement;
        $this->request = $Request;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->movement->all();

            if(!$data->isEmpty()) {
                return response()->json($data);
            } else {
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            }

        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
                    $data = $this->movement->create($dataForm);        
                    return response()->json($data, 200); 
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (!$data = $this->movement->find($id)) {
                return response()->json([
                    'error'=> 'Nada Encontrado', 
                    404
                ]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json([
                'error'=> $e->getMessage(),
                 400
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (!$data = $this->movement->find($id)){
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
                        $dataForm = array(
                            "name" => $request->name
                        );
            
                        $data->update($dataForm);
                        
                        return response()->json($data); 
                }
            }
            
        } catch (Exception $e) {
            return response()->json([
                'error'=> $e->getMessage(), 
                400
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!$data = $this->movement->find($id)){
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
     * Função que valida dados para cadastro de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    private function validarApi($dataForm, $id = null) {        

        try {
            $messages = [
                'name.required' => 'informe o nome'
            ];
    
            $rules = [
                'name' => 'required'
            ];
    
            $regras = ($id != null) ? $rules : $this->movement->rules();
            
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
     * Função que valida chaves para cadastro de usuario.
     *
     * @return \Illuminate\Http\Response
     */
    private function validateKeys($dataForm, $id = null) {

        if(count(array_keys($dataForm)) == 1) {
            if (!array_key_exists('name', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [name]', 
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
