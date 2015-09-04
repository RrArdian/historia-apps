<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $hidden = ['slug_nama', 'created_at', 'updated_at'];

    public function peta()
    {
    	return $this->hasMany('App\Http\Models\Peta');
    }
}
