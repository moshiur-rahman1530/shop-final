<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable=['title_first_letter','title_remain','short_des','description','photo','address1','address2','phone','email','logo','footer1','footer2','footer3','icon1','feature1','icon2','feature2','icon3','feature3','icon4','feature4','vendor1','vendor2','vendor3','vendor4','vendor5','vendor6','vendor7','vendor8',];
}
