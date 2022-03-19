<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalRecord extends Model
{
    protected $table = 'personal_record';
    
    protected $fillable = [
        'id',
        'user_id',
        'movement_id',
        'value',
        'date'
    ];

    public function rules()
    {
        return [
            'user_id' => 'required',
            'movement_id' => 'required',
            'value' => 'required',
            'date' => 'required'
        ];
    }
}
