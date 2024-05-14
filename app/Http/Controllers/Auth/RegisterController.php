<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
        // Create a validator instance
    $validator = $this->validator($data);

    // Check if validation fails
    if ($validator->fails()) {
        // Dump the validation errors
        dd($validator->errors());
    }

    $userData = [
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ];

    if(isset($data['user_photo'])){
        $manager = new ImageManager(new Driver());
        $photoname = hexdec(uniqid()) . '.' . $data['user_photo']->getClientOriginalExtension();
        $img = $manager->read($data['user_photo']);
        $img = $img->resize(180,180);
        $img->save('files/user/' . $photoname);
        $userData['user_photo'] = 'files/user/' . $photoname;
    }

    // Use Eloquent's create method to insert the user data
    return User::create($userData);
    }

    
}