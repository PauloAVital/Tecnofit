<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movement';
    
    protected $fillable = [
        'id',
        'name'
    ];

    public function rules()
    {
        return [
            'name' => 'required|unique:movement'
        ];
    }
}
