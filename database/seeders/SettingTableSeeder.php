<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'title_first_letter'=>'E',
            'title_remain'=>'Shopper',
            'description'=>"Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis unde omnis iste natus error sit voluptatem Excepteu

                            sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspiciatis Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspi deserunt mollit anim id est laborum. sed ut perspi.",
            'short_des'=>"Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.",
            'photo'=>"img/background.jpg",
            'logo'=>'img/logo.jpg',
            'address1'=>"NO. 342 - Chargachh Bazar, 3460 Kasba Brahmanbaria",
            'address2'=>"Modern Plaza - Kuti, 3460 Kasba Brahmanbaria",
            'email'=>"eshopper@gmail.com",
            'phone'=>"+8801934622580",
            'footer1'=>"Your Site Name.",
            'footer2'=>"All Rights Reserved. Designed by",
            'footer3'=>"HTML Codex",
        );
        DB::table('settings')->insert($data);
    }
}
