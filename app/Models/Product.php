<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];


    public static function CountCategory($id)
    {
      $categoryCount = Product::where('product_cat', $id)->count();
      return $categoryCount;
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }
    public function colors()
    {
      return $this->belogsTo('App\Models\Color','1d');
    }


    public function attributes()
    {
      return $this->hasMany('App\Models\ProductAttr','product_id');
    }

    
}
