<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $hidden = ['slug_nama', 'created_at', 'updated_at'];

    public function kabupaten()
    {
    	return $this->belongsTo('App\Http\Models\Kabupaten');
    }

    public function peta()
    {
    	return $this->hasMany('App\Http\Models\Peta');
    }
}
