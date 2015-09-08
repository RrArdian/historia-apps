<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';

    protected $hidden = ['peta_id', 'nama_file', 'created_at', 'updated_at'];

    public function peta()
    {
    	return $this->belongsTo('App\Http\Models\Peta');
    }
}
