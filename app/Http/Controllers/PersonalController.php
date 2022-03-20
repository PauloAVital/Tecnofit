<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalRecord;
use App\Models\Movement;
use App\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->personalRecord = new PersonalRecord();
        $this->movement = new Movement();
        $this->user = new User();

    }

    public function ranking() {
        $ranking = [];

        $movement = Movement::all();

        foreach ($movement as $valor) {
          //  array_push($ranking, ['movement' => $valor['name']]);
            $ret = $this->treatRanking(personalRecord::where('movement_id',$valor['id'])
                                                    ->orderBy('value', 'desc')
                                                    ->get());
            array_push($ranking, ['ranking' => $ret]);
        }
        return $ranking;
        /*$ranking = [];
        $personalRecord = [];

        $movement = Movement::all();

        foreach ($movement as $valor) {
            //var_dump($valor); die;
            $ret = personalRecord::where('movement_id',$valor['id'])
                                                    ->orderBy('value', 'desc')
                                                    ->get();
           /* array_push($ranking, ['name_moviment' => $valor['name']]);
            array_push($ranking, ['ranking' => $ret]);*/

            
            //array_push($ranking, ['ranking' => $ret]);
           // array_push($personalRecord, $ret);
          //  array_push($ranking, ['ranking' => $personalRecord]);
         /* $name = $valor['name'];
          array_push($ret, ['movement' => $name]);*/
       //   var_dump(json_encode($ret) ); die;
      /*  }
        return json_encode($ret);*/
        
    }

    private function treatRanking($data){
        $dataTreat = [];
        $dataRet = [];
        $position = 1;

        foreach ($data as $datas) {
            $name = $this->user->find($datas->user_id);
            $name = $name['name'];
            
            $movement = $this->movement->find($datas->movement_id);
            $movement = $movement['name'];

            $dataTreat = array(
                "user" => $name,
                "position" => $position,
                "value" => $datas->value,
                "date" => $datas->date,
                "movement_id" => $datas->movement_id,
                "movement" => $movement
            );

            array_push($dataRet, $dataTreat);
            $position++;
        }
        return $dataRet;
    }
}
