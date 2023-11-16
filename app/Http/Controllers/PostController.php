<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    const PATH = 'uploaded';
    
    public function index() {        
        $user = auth()->user();
        return view('admin.dashboard', [            
            'user' => $user
        ]);
    } 
    
    public function create() {
        $user = auth()->user();
        return view('admin.create', [            
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

            return redirect(route('laporan'))->with([
                'message' => 'Pengaduan Berhasil Dibuat'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ])->withInput();
        }
    }

    public function laporan() {        
        $posts = Pengaduan::all();        
        $user = auth()->user();
        return view('admin.laporan', [  
            'posts' => $posts,          
            'user' => $user
        ]);
    } 

    
    public function edit(Pengaduan $post)
    {
        $posts = auth()->user()->posts;
        $user = auth()->user();        
        return view('admin.edit', compact('post'), [  
            'posts' => $posts,          
            'user' => $user
        ]);
    }

    public function update(Pengaduan $post, Request $request)
    {
        $validated = (object) $request->validate([
            'nama' => 'required|max:255',
            'kelas' => 'required|max:255',            
            'image' => 'nullable|image|mimes:jpg,jpeg,bmp,png|max:1024',
            'keluhan' => 'required|max:3000',
        ]);

        $oldImage = null;
        $imageFilename = null;
        $image = null;

        if ($request->image) {
            $oldImage = $post->image;
            $imageFilename = time() . '_' . Carbon::now()->format('Ymd') . '.' . $request->image->getClientOriginalExtension();
            $image = self::PATH . '/' . $imageFilename;
        }

        try {
            DB::beginTransaction();
            $post->nama = $validated->nama;
            $post->kelas = $validated->kelas;
            if ($request->image) {
                $post->image = $image;
            }
            $post->keluhan = $validated->keluhan;
            $post->status = "Belum ditanggapi";
            $post->user_id = Auth::user()->id;
            $post->update();
            DB::commit();

            if ($request->image) {
                $request->image->move(public_path(self::PATH), $imageFilename);
                unlink(public_path($oldImage));
            }

            return redirect(route('laporan'))->with([
                'message' => 'Laporan diupdate!'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi Kesalahan'
            ])->withInput();
        }
    }
    
    public function destroy(Pengaduan $post)
    {
        $imagePath = public_path($post->image);
        try {
            DB::beginTransaction();
            $post->delete();
            DB::commit();
            unlink($imagePath);

            return redirect(route('laporan'))->with([
                'message' => 'Laporan dihapus'
            ]);
        } catch (QueryException) {
            DB::rollback();
            return redirect()->back()->withErrors([
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }     
}