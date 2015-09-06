<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    protected $table = 'api_key';

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
    	return $this->belongsTo('App\Http\Models\User');
    }
}
