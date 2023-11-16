<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    public function index() {
        $posts = User::where('category', 'user')->get();
        $user = auth()->user();
        return view('admin.user', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    public function create() {
        $user = auth()->user();
        return view('admin.createUser', [            
            'user' => $user
        ]);
    }

    public function store(Request $request) {
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

            return redirect(route('datauser'))->with([
                'message' => 'Berhasil menambahkan user'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Something went wrong'
            ]);
        }        
    }

    public function edit($id) {
        $user = User::find($id);
        return view('admin.editUser', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->category = 'user';
        $user->password = $request->password;
        $user->save();

        return redirect(route('datauser'))->with([
            'message' => 'Data berhasil Diupdate'
        ]);
    } 

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect(route('datauser'))->with([
            'message' => 'Data berhasil dihapus!'
        ]);
    }
}