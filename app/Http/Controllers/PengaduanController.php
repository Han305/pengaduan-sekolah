<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengaduanController extends Controller
{

    const PATH = 'upload';
    
    public function pengaduan() {
        $user = Auth::user();
        return view('user.pengaduan', [
            'user' => $user
        ]);
    } 

    public function store(Request $request) {
        $validated = (object) $request->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required|max:255',            
            'image' => 'required|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'keluhan' => 'required|max:3000',
        ]);

        $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
        $image = self::PATH . '/' . $imageFilename;

        try {
            DB::beginTransaction();
            $post = new Pengaduan();
            $post->nama = $validated->nama;
            $post->kelas = $validated->kelas;
            $post->image = $image;
            $post->keluhan = $validated->keluhan;
            $post->status = 'Belum Ditanggapi';
            $post->user_id = Auth::user()->id;
            $post->save();
            DB::commit();

            $request->image->move(public_path(self::PATH), $imageFilename);

            return redirect(route('pengaduan'))->with([
                'message' => 'Pengaduan Berhasil Dikirim!'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ])->withInput();
        }
    }

    public function akun() {        
        $user = Auth::user();
        return view('user.akun', [
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

        return redirect(route('pengaduan.akun'))->with([
            'message' => 'Data berhasil Diupdate'
        ]);
    } 
}