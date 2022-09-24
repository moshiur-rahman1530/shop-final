<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;
    protected $guarded=[];
    // protected $fillable = [
    //     'product_id',
    //     'color_id',
    //     'size_id',
    //     'price',
    //     'qtn',
    // ];
    public $timestamps = true;


    public function products()
    {
      return $this->belogsTo('App\Models\Product','id');
    }

    public function attrRatings()
    {
      return $this->hasMany('App\Models\Rating','product_id');
    }


    public static function findProductAttr($id)
    {
     $productAttr = ProductAttr::where('product_id',$id)->first();
     return $productAttr;
    }


}
