<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

    public function handleAdmin()
    {   
        return view('admin.home');
    }

    public function index()
    {
        $socialShare = \Share::page(
            'https://www.w3techpoint.com/laravel/how-to-add-social-share-button-in-laravel-app',
            'How to Add Social Media Share Button in Laravel App?'
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp();

        // $view_data['share_buttons'] = $share_buttons;
        return view('home',['socialShare'=>$socialShare]);
    }
    
    
}
