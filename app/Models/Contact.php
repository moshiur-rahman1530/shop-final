<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use HasFactory, Notifiable;
    public $fillable = ['name', 'email', 'phone', 'subject', 'message'];


    // public static function boot() {
  
    //     parent::boot();
  
    //     static::created(function ($item) {
                
    //         $adminEmail = "your_admin_email@gmail.com";
    //         Mail::to($adminEmail)->send(new ContactMail($item));
    //     });
    // }

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }
}
