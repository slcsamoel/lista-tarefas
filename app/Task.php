<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'user_id', 'descricao'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id' , 'user_id');
    }

}