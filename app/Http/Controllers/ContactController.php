<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\Subscribe;
use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContalMail;
use App\Mail\SubscribeMail;
use Illuminate\Http\JsonResponse;
use App\Notifications\WelcomeSmsNotification;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function getContactPage()
    {
        $socialShare = \Share::page(
            'https://kshopper.herokuapp.com/',
            'How to Add Social Media Share Button in Laravel App?'
            )
            ->facebook()
            ->twitter()
            ->linkedin();
  

        $category = Category::with('subcategories')->get();
        $subcat = SubCategory::all();
        return view('contact',['category'=>$category,'subcat'=>$subcat, 'socialShare'=>$socialShare]);
    }

    public function storeContact(Request $request)
      {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ]);


        $email = $request->email;
        $name = $request->name;
        $phone = $request->phone;
        $subject = $request->subject;
  
        $subscriber = Contact::create(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'subject'=>$request->subject,'message'=>$request->message]);

        $body = [
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'subject'=>$request->get('subject'),
            'messages'=>$request->get('message'),
        ];

        if($subscriber){
            Mail::to('moshiurmanderpur@gmail.com')->send(new ContalMail($body));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ], 200
            );
        }
  
    }


    public function SubscribeStore(Request $request)
    {
            $request->validate([
                'email' => 'required|email',
            ]);
   
    
            $email = $request->email;
            $name = $request->name;

            $checkEmail = Subscribe::where('email','=',$email)->first();
           
         
            if(!$checkEmail){
                $result = Subscribe::create(['name'=>$request->name,'email'=>$request->email]);
                $body = [
                    'name'=>$request->get('name'),
                    'email'=>$request->get('email')
                ];
        
                if($result==true){
                    Mail::to('moshiurmanderpur@gmail.com')->send(new SubscribeMail($body));
                    Mail::to($email)->send(new SubscribeMail($body));
 
                }
                return 1;
            }else{
               
                return 0;
               
            }  
    
    }
      
}
