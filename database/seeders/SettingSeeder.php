<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'title_first_letter'=>'B',
            'title_remain'=>'Shopper',
            'description'=>"Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis iste natus error sit voluptatem Excepteu

                            sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspi deserunt mollit anim id est laborum. sed ut perspi.",
            'short_des'=>"Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.",
            'photo'=>"img/background.jpg",
            'logo'=>'img/logo.jpg',
            'address1'=>"NO. 342 - Chargachh Bazar, 3460 Kasba Brahmanbaria",
            'address2'=>"Modern Plaza - Kuti, 3460 Kasba Brahmanbaria",
            'email'=>"bshopper@gmail.com",
            'phone'=>"+8801934622580",
            'icon1'=>"fa fa-check",
            'feature1'=>"Quality Product",
            'icon2'=>"fa fa-shipping-fast",
            'feature2'=>"Free Shipping",
            'icon3'=>"fas fa-exchange-alt",
            'feature3'=>"14-Day Return",
            'icon4'=>"fa fa-phone-volume",
            'feature4'=>"24/7 Support",
            'footer1'=>"Your Site Name.",
            'footer2'=>"All Rights Reserved. Designed by",
            'footer3'=>"HTML Codex",
            'vendor1'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-1.jpg",
            'vendor2'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-2.jpg",
            'vendor3'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-3.jpg",
            'vendor4'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-4.jpg",
            'vendor5'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-5.jpg",
            'vendor6'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-6.jpg",
            'vendor7'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-7.jpg",
            'vendor8'=>"http://127.0.0.1:8000/filemanager/uploads/vendor-8.jpg",
        );
        DB::table('settings')->insert($data);
    }
}
