<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Image;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'image' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();

        $profileImage = $request->file('image');
        $profileImageSaveAsName = time() . Auth::id() . "-profile." . $profileImage->getClientOriginalExtension();

        $upload_path = 'profile_images/';
        $profile_image_url = $upload_path . $profileImageSaveAsName;
        // $success = $profileImage->move($upload_path, $profileImageSaveAsName);


        Storage::disk('backup_google')->putFileAs("",$request->file('image'), $profileImageSaveAsName);
        Storage::disk('google')->putFileAs("",$request->file('image'), $profileImageSaveAsName);

        $backupDisk = Storage::disk('backup_google')->url($profileImageSaveAsName);
        $url = Storage::disk('google')->url($profileImageSaveAsName);

        $filename = Storage::disk('google')->getMetadata($profileImageSaveAsName);
        $path = $filename['path'];

        $folderPath = Storage::disk('backup_google')->getMetadata($profileImageSaveAsName);
        $pathimage = $folderPath['path'];



        $allImagesUpload = Image::create(['name'=>$profileImageSaveAsName, 'img_name'=>$pathimage, 'path'=>$backupDisk]);



        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'img_name' => $path,
            'image' => $url,
            'password' => Hash::make($data['password']),
        ]);
    }
}
