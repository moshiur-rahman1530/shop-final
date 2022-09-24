<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public $table='colors';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;

    public static function findColor($id)
    {
      $color = Color::where('id',$id)->first();
      return $color;
    }

    public function products()
    {
      return $this->hasMany('App\Models\Product','color_id');
    }
}
