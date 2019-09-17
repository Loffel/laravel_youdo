<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard';

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
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', Rule::in(['1', '2'])]
        ],[
            'type.*' => 'Не выбран тип аккаунта.',
            'password.min' => 'Пароль должен быть не менее 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
            'email.unique' => 'Данная электронная почта уже используется.'
        ]);
        
        $validator->sometimes(['ogrn', 'legal_address', 'address', 'phone'], 'required', function($input){
            return $input->type == 2;
        });

        return $validator; 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $dataArray = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type']
        ];

        if($data['type'] == 1){
            $dataArray['is_verified'] = 1;
        }else if($data['type'] == 2){
            $dataArray['ogrn'] = $data['ogrn'];
            $dataArray['phone'] = $data['phone'];
            $dataArray['legal_address'] = $data['legal_address'];
            $dataArray['address'] = $data['address'];
        }

        return User::create($dataArray);
    }

    public function register(Request $request) {
        $validator = $this->validator($request->all());

        if($validator->fails()){
            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $validator->validate();
    
        $user = $this->create($request->all());
    
        event(new Registered($user));
    
        $this->guard()->login($user);
    
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
