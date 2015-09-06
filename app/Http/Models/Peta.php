<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    protected $table = 'peta';

    protected $hidden = ['slug_nama', 'created_at', 'updated_at'];

    public function kategori()
    {
    	return $this->belongsTo('App\Http\Models\Kategori');
    }

    public function kecamatan()
    {
    	return $this->belongsTo('App\Http\Models\Kecamatan');
    }

    public function foto()
    {
    	return $this->hasMany('App\Http\Models\Foto');
    }

    public static function getByDistance($lat, $lng, $distance, $lim)
    {
      $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM peta HAVING distance < ' . $distance . ' ORDER BY distance LIMIT ' . $lim));
      
      return $results;
    }
}
