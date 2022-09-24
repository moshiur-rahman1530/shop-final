<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Shipping;
use DB;
use Cache;
use Exception;
use Twilio\Rest\Client;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function VisitorIndex(){
        return view('admin.visitor.Visitors');
     }

    public function getVisitor()
    {
      $result=json_encode(Visitor::orderBy('id','desc')->take(500)->get());
	     return $result;
    }


    function DeleteVisitor(Request $req){
     $id= $req->input('id');
     $result= Visitor::where('id','=',$id)->delete();

     if($result==true){
       return 1;
     }
     else{
     	return 0;
     }
    }

    // details visitorModal
    function DetailsVisitor(Request $req){
     // $result= Visitor::where('id','=',$id)->get();
     // return $result;
   }

   // details visitorModal
   function singleVisitorPage(Request $req){
       $id= $req->id;
     $result= Visitor::where('id','=',$id)->first();
    return view('admin.visitor.DetailsVisitor',['result'=>$result]);
    // return $result;
  }






//   user details area 


    function UserIndex(){
        return view('admin.users.Users');
     }


    public function getUser()
    {
      // $result=json_encode(User::orderBy('id','desc')->take(500)->get());
      $users = DB::table('users')->get();

      foreach ($users as $key => $user) {
            if (Cache::has('is_online' . $user->id)){
                $users[$key]->status = 'Online';
            }else{
                $users[$key]->status = 'Offline';
            }
// dd($user);
            $aid = $user->shippingArea;

            if($aid==!null){
              $shipId = Shipping::where('id', $aid)->first();
            
              $users[$key]->area = $shipId->type;
            }

           
        }

	     return $users;
    }


    function DeleteUser(Request $req){
     $id= $req->input('id');
     $result= User::where('id','=',$id)->delete();

     if($result==true){
       return 1;
     }
     else{
     	return 0;
     }
    }


   // details visitorModal
   function singleUserPage(Request $req){
       $id= $req->id;
     $result= User::where('id','=',$id)->first();
    return view('admin.users.DetailsUser',['result'=>$result]);
    // return $result;
  }


  public function active_user()
  {
    $result= User::where('is_admin','=',0)->get();
    return view('admin.users.ActiveUser',['results'=>$result]);
  }



  public function sendCustomMessage(Request $request)
    {
        $validatedData = $request->validate([
            'msgText' => 'required',
        ]);


        // iterate over the array of recipients and send a twilio request for each
   
            $this->sendSms($validatedData["msgText"]);
        

        return back()->with(['success' => "Messages on their way!"]);
    }



  public function sendSms(Request $req)
    {
      $receiverNumber = "+880 1628 018234";
      // $message = "Welcome to the Massage";
      $message = $req->msgText;
      // Request $req

      // dd(gettype($req->msgText));

      try {

          $account_sid = getenv("TWILIO_SID");
          $auth_token = getenv("TWILIO_TOKEN");
          $twilio_number = getenv("TWILIO_FROM");

          $client = new Client($account_sid, $auth_token);
          $client->messages->create($receiverNumber, [
              'from' => $twilio_number, 
              'body' => $message]);

          // dd('SMS Sent Successfully.');

          // dd($client);

          if($client){
            return 1;
          }else{
            return 0;
          }

      } catch (Exception $e) {
          dd("Error: ". $e->getMessage());
      }
    }


    public function sendSms2()
    {
      $receiverNumber = "+880 1628 018234";
        $message = "This is testing from CodeSolutionStuff.com";
  
        try {
  
          $account_sid = getenv("TWILIO_SID");
          $auth_token = getenv("TWILIO_TOKEN");
          $twilio_number = getenv("TWILIO_FROM");

          $client = new Client($account_sid, $auth_token);
          $client->messages->create($receiverNumber, [
              'from' => $twilio_number, 
              'body' => $message]);

          dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
 
}
