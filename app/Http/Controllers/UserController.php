<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use DateTime;

class UserController extends Controller
{
    
    public function store(Request $request){
        // dd($request->all());
        $date = date("Y-m-d");
        $date1 = new DateTime($request->birthday);
        $date2 = new DateTime($date);
        $interval = $date1->diff($date2);
        if($interval->y < 16){
            return redirect()->back()->with('error','Возраст меньше 16 лет');
        }
        $request->validate([
            'first_name'=>['required'],
            'last_name'=>['required'],
            'rule'=>['required'],
            'phone'=>['required','unique:users'],
            'gender'=>['required','regex:/0|1/'],
            'email'=>['required','unique:users'],
            'birthday'=>['required'],
            'password'=>['required','confirmed'],
            'password_confirmation'=>['required'],
        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = md5($request->password);
        $user->save();
        return redirect()->route('login')->with('success','Вы успешно зарегистрированы! Теперь вы можете войти в свой аккаунт.');

    }

    public function auth(Request $request){
        $request->validate([
            'phone'=>['required'],
            'password'=>['required'],
        ]);
        $user = User::query()->where('phone',$request->phone)->where('password',md5($request->password))->first();
        if($user){
            Auth::login($user);
            return redirect()->route('welcome')->with('success','Успешная авторизация!');
        }
        else{
            return redirect()->back()->with('error','Пользователь не найден');
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function update(Request $request){
        $date = date("Y-m-d");
        $date1 = new DateTime($request->birthday);
        $date2 = new DateTime($date);
        $interval = $date1->diff($date2);
        if($interval->y < 16){
            return redirect()->back()->with('error','Возраст меньше 16 лет');
        }
        $user = User::query()->where('id',Auth::user()->id)->first();
        $request->validate([
            'first_name'=>['required'],
            'last_name'=>['required'],
            'phone'=>['required',Rule::unique('users')->ignore($user->id)],
            'email'=>['required',Rule::unique('users')->ignore($user->id)],
            'birthday'=>['required'],
        ]);
        if($request->img){
            $path = $request->file('img')->store('public/img');
            $user->photo = '/storage/'.$path;
        }
        if($request->password){
            $request->validate([
                'password'=>['confirmed']
            ]);
            $user->password = md5($request->password);
        }
        $user->last_name = $request->last_name;
        $user->first_name = $request->first_name;
        $user->birthday = $request->birthday;
        if($request->gender){
            $user->gender = $request->gender;
        }
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->update();
        return redirect()->back()->with('success','Успешно изменено');
    }
}
