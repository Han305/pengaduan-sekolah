<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginprocess(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $password = bcrypt($request->password);
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = User::where('username', $request->username)->first();
            if ($user->category === 'admin') {
                return redirect(route('dashboard'));
            }
            return redirect(route('pengaduan'));
        }
        return redirect()->back()->withErrors([
             'message' => 'Username atau Password salah!',
         ]);
    }

    public function register() {
        return view('register');
    }

    public function registerprocess(Request $request) {
        $validated = (object) $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $validated->name;
            $user->username = $validated->username;
            $user->email = $validated->email;
            $user->password = $validated->password;
            $user->category = 'user';
            $user->save();
            DB::commit();

            return redirect(route('login'))->with([
                'message' => 'An account has been created for you, ' . $validated->name . '.'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ]);
        }
        
    }
    
    public function logout() {
        Auth::logout();
        return redirect(route('login'));
    }
}