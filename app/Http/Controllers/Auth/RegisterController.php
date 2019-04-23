<?php

namespace App\Http\Controllers\Auth;

use App\Events\registerSMSEvent;
use App\profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      
           
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'nullable|mimes:jpeg,jpg,png',
            'phone' => 'required',
            'telephone' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'reagent' => 'nullable|integer|unique:users,id'
        ]);
    }


    protected function generateCode($codeLength)
    {
        $min = pow(10, $codeLength);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);
        return $code;
    }

    protected function user_id()
    {
        $code = $this->generateCode(3);
        if (User::find($code))
            return $this->user_id();
        else
            return $code;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $id = $this->user_id();
        $user = User::create([
            'id' => $id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'level' => 'customer',
            'avatar' => isset($data['avatar']) ? $this->uploadFile($data['avatar'], 'userAvatar', $data['avatar']->getClientOriginalName()) : "",
        ]);

        $profile = new profile();
        $profile->user_id = $id;
        $profile->telephone = $data['telephone'];
        $profile->phone = $data['phone'];
        $profile->address = $data['address'];
        $profile->gender = $data['gender'];
        $profile->reagent = $data['reagent'];
        $profile->save();

        return $user;
    }

    private function isRepresentation($id){
      if(!$id)
        return true;
      $user=User::find($id);
      if($user and $user->level="representation")
        return true;
      return false;
    }
  
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        if(!$this->isRepresentation($request->reagent))
          return redirect()->back()->withErrors(['خطا! کد معرف اشتباه است']);
        event(new Registered($user = $this->create($request->all())));
        event(new registerSMSEvent($user));
        $login = new LoginController();
        $login->manualLogin($request);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

    }
}
