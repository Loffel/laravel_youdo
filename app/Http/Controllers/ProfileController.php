<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show($userID){
        $user = User::findOrFail($userID);

        return view('profile.show', array('user' => $user));
    }

    public function settingsShow(){
        return view('profile.settings');
    }

    public function settingsUpdate(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,'.$request->user()->id],
        ],[
            'avatar.*' => 'Неверное изображение',
            'currentPassword.min' => 'Пароль должен быть не менее 8 символов.',
            'currentPassword.confirmed' => 'Пароли не совпадают.',
            'newPassword.min' => 'Пароль должен быть не менее 8 символов.',
            'newPassword.confirmed' => 'Пароли не совпадают.',
            'newPassword.string' => 'Неверно указан новый пароль.',
            'currentPassword.string' => 'Неверно указан новый пароль.'
        ]);

        $validator->sometimes('avatar', ['file', 'image', 'max:6000'], function($input){
            return $input->avatar !== NULL;
        });

        $validator->sometimes(['ogrn', 'legal_address', 'address', 'phone'], 'required', function($input){
            return $input->type == 2;
        });

        $validator->sometimes('currentPassword', ['string', 'min:8'], function($input){
            return ($input->currentPassword != '' || $input->newPassword != '');
        });

        $validator->sometimes('newPassword', ['string', 'min:8', 'confirmed'], function($input){
            return ($input->currentPassword != '' || $input->newPassword != '');
        });

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::find($request->user()->id);
        $user->update($request->all());

        if(!empty($request->currentPassword)){
            if(Hash::check($request->currentPassword, $request->user()->password)){
                $user->password = Hash::make($request->newPassword);         
                $user->save();   
            }else{
                return redirect()
                        ->back()
                        ->withErrors('Текущий пароль введен неверно.');
            }
        }

        return redirect()->back()->with('updated', 'Данные были успешно обновлены!');
    }
}
