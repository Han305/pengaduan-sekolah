<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Pengaduan;
use App\Models\Riwayat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function riwayat() {
        $posts = Riwayat::all();
        $user = auth()->user();
        return view('admin.riwayat', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    public function store(Request $request, $id) {
        try {
            DB::beginTransaction();

            $pengaduan = Pengaduan::findOrFail($id);

            $riwayat = new Riwayat();
            $riwayat->nama = $pengaduan->nama;
            $riwayat->kelas = $pengaduan->kelas;
            $riwayat->image = $pengaduan->image;
            $riwayat->keluhan = $pengaduan->keluhan;
            $riwayat->status = "Ditanggapi";
            $riwayat->user_id = Auth::user()->id;
            $riwayat->save();

            $pengaduan->delete();

            DB::commit();

            return redirect(route('laporan'))->with([
            'message' => 'Pengaduan Ditanggapi dan Tersimpan di Riwayat Pengaduan'
            ]);
            
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ]);
        }
    }

    public function destroy(Riwayat $post)
    {
        $imagePath = public_path($post->image);
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();
            unlink($imagePath);

            return redirect(route('riwayat'))->with([
                'message' => 'Riwayat dihapus'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ]);
        }
    } 
}