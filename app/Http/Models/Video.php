<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    protected $hidden = ['peta_id', 'created_at', 'updated_at'];

    public function peta()
    {
    	return $this->belongsTo('App\Http\Models\Peta');
    }
}
