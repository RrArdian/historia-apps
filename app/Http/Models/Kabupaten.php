<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';

    protected $hidden = ['created_at', 'updated_at'];

    public function kecamatan()
    {
    	return $this->hasMany('App\Http\Models\Kecamatan');
    }
}
