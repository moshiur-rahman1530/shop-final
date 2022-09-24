<?php

namespace App\Models;

use App\Models\order_details;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
    // protected $fillable=['type','price','status'];
    public $table='orders';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;


    public function OrderItems()
    {
        // return $this->hasMany(order_details::class);
        return $this->hasMany('App\Models\order_details','order_number');
 
    }
}
