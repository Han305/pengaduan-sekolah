<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('admin.akun', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $validated = (object) $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user->name = $validated->name;
        $user->username = $validated->username;
        $user->email = $validated->email;
                
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect(route('akun'))->with([
            'message' => 'Data berhasil Diupdate'
        ]);
    } 

}