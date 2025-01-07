<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function login(){
        return view('tenant.auth.login');
    }

    public function loginStore(Request $request){
       $credentials = $request->only('email', 'password');
$credentials['tenant_id'] = tenant('id');

if(Auth::attempt($credentials)){
    $request->session()->regenerate();
    return redirect()->route('tenant.dashboard');
}
       return back()->withErrors(['email'=> 'The provieded credietials do not match']);
    }

    public function register(){
        return view('tenant.auth.register');
    }

    public function registerStore(Request $request){
        $tenant_id = tenant('id');
         $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',
            Rule::unique('users')->where(function($query) use($tenant_id, $request){
                return $query->where('tenant_id', tenant('id'))
                ->where('email', $request->email);
    }),
],
'password' => 'required|string|min:6|confirmed',
]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
    return redirect()->route('tenant.login')->with('success','Registation successful, please login');
    }



    public function logout(Request $request){
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
     }
}
