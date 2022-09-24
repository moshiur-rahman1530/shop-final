<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $table='ratings';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;



    protected $fillable = [
       'product_id',
       'name',
       'email',
       'comments',
       'star_rating',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function ratingsAttr()
    {
        return $this->belongsTo('App\Models\ProductAttr','product_id');
    }

    public static function ratAvg($id)
    {
        $average = Rating::where('product_id', $id)->avg('star_rating');
        $makeRound = round($average,2);
        return ($makeRound);
    }


}
