<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonalRecord;
use App\Models\Movement;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use PHPUnit\Util\Json;

class PersonalRecordController extends Controller
{
    public function __construct(PersonalRecord $personalRecord,
                                User $user,
                                Request $Request)
    {
        $this->personalRecord = $personalRecord;
        $this->user = $user;
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
            $data = $this->personalRecord->all();

            if(!$data->isEmpty()) {
                return response()->json($data);
            } else {
                return response()->json([
                    'error'=> 'Nada Encontrado',
                     404
                    ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'error'=> $e->getMessage(), 
                400
            ]);
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
            
            $retornoValidate = $this->validateApi($dataForm);
            if ($retornoValidate != '') {
                echo $retornoValidate;
                return;
            }
            if (($retornoKeys == '') and
                ($retornoValidate == '')) {
                    $data = $this->personalRecord->create($dataForm);        
                    return response()->json($data, 200); 
            }
        } catch (Exception $e) {
            return response()->json([
                'error'=> $e->getMessage(), 
                400
            ]);
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
            if (!$data = $this->personalRecord->find($id)) {
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
            if (!$data = $this->personalRecord->find($id)){
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
                
                $retornoValidate = $this->validateApi($dataForm);
                if ($retornoValidate != '') {
                    echo $retornoValidate;
                    return;
                }
                if (($retornoKeys == '') and
                    ($retornoValidate == '')) {

                        $dataForm = array(
                            "user_id" => $request->user_id,
                            "movement_id" => $request->movement_id,
                            "value" => $request->value,
                            "date" => $request->date
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
            if (!$data = $this->personalRecord->find($id)){
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
    private function validateApi($dataForm, $id = null) {        

        try {
            $messages = [
                'user_id.required' => 'informe o id do usuario',
                'movement_id.required' => 'informe o id do movimento',
                'value.required' => 'informe o valor',
                'date.required' => 'informe a data'
            ];
    
            $rules = [
                'user_id' => 'required',
                'movement_id' => 'required',
                'value' => 'required',
                'date' => 'required',
            ];
    
            $regras = ($id != null) ? $rules : $this->personalRecord->rules();
            
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

        if(count(array_keys($dataForm)) == 4) {
            if (!array_key_exists('user_id', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [user_id]', 
                    'error' => 404
                ]);
            }

            if (!array_key_exists('movement_id', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [movement_id]', 
                    'error' => 404
                ]);
            }

            if (!array_key_exists('value', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [value]', 
                    'error' => 404
                ]);
            }

            if (!array_key_exists('date', $dataForm)){
                return response()->json([
                    'description'=> 'Falta a chave [date]', 
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

    public function ranking() {
        $ranking = [];

        $movement = Movement::all();

        foreach ($movement as $valor) {
            array_push($ranking, $valor['name']);
            $ret = $this->treatRanking(personalRecord::where('movement_id',$valor['id'])
                                                    ->orderBy('value', 'desc')
                                                    ->get());
            array_push($ranking, $ret);
        }
        return $ranking;
    }

    private function treatRanking($data){
        $dataTreat = [];
        $dataRet = [];
        $position = 1;

        foreach ($data as $datas) {
            $name = $this->user->find($datas->user_id);
            $name = $name['name'];

            $dataTreat = array(
                "user" => $name,
                "position" => $position,
                "value" => $datas->value,
                "date" => $datas->date
            );

            array_push($dataRet, $dataTreat);
            $position++;
        }
        return $dataRet;
    }
}
