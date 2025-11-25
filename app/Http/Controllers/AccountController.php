<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\User;
use Symfony\Component\Console\Input\Input;

class AccountController extends Controller
{
    function login()
    {
        return view('accounts.login');
    }

    public function register(Request $request)
    {
        $cleaned_data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $cleaned_data['name'],
            'email' => $cleaned_data['email'],
            'password' => Hash::make($cleaned_data['password']),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    function authenticate(Request $request)  {
      $credentials=  $request->validate([
            'email'=>['bail','required','email'],
            'password'=>'required'
        ]);
       
        $user=User::where('email',$credentials['email'])->first();
        // Auth::login($user, $remember = true);
      if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.index')->with('message','Login Successfully!');
    }
  
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }


    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.index')->with('message','Logout Successfully!');
    }
}
