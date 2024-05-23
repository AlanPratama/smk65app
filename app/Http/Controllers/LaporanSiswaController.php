<?php

namespace App\Http\Controllers;

use App\Models\LaporanSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LaporanSiswaController extends Controller
{
    public function index(Request $req)
    {
        if ($req->search) {
            $laporan = LaporanSiswa::where('siswaId', Auth::user()->id)
                                    ->with('siswa', 'tipe')
                                    ->where('judul', 'LIKE', '%' . $req->search . '%')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        } else {
            $laporan = LaporanSiswa::where('siswaId', Auth::user()->id)->orderBy('created_at', 'desc')->with('siswa', 'tipe')->get();
        }
        
        return response()->json([
            'statusCode' => 200,
            'data' => $laporan
        ]);
    }
    
    public function show($id)
    {
        $laporan = LaporanSiswa::where('id', $id)->where('siswaId', Auth::user()->id)->with('siswa', 'tipe')->first();
        
        return response()->json([
            'statusCode' => 200,
            'data' => $laporan
        ]);
    }
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'tipeId' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], [
            'tipeId.required' => 'Tipe ID harus diisi',
            'judul.required' => 'Judul harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,gif,svg',
            'gambar.max' => 'Ukuran gambar maksimal 3 MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'errors' => $validator->errors() 
            ], 422);
        }

        $laporan = new LaporanSiswa();
        $laporan->tipeId = $req->tipeId;
        $laporan->siswaId = Auth::user()->id;
        $laporan->judul = $req->judul;
        $laporan->deskripsi = $req->deskripsi;
        $laporan->keterangan = $req->keterangan;
        $laporan->tanggal = Carbon::now()->toDateString();
        $laporan->status = $req->status;
        if ($req->hasFile('gambar')) {
            $file = $req->file('gambar');
            $fileName =  Str::slug($req->judul) . '-' . time() . '-' . Str::random(4) . '.' . $file->getClientOriginalExtension();

            
            // $destinationPath = public_path('/storage/laporanSiswa');

            // // Ensure the destination directory exists
            // if (!file_exists($destinationPath)) {
            //     mkdir($destinationPath, 0755, true);
            // }

            $file->move('storage/laporanSiswa', $fileName);
            $path = 'laporanSiswa/' . $fileName;
            $laporan->gambar = $path;
        }

        if ($req->status) {
            $laporan->status = 'Privat';
        } else {
            $laporan->status = 'Publik';
        }

        $laporan->save();

        $data = LaporanSiswa::where('id', $laporan->id)->with('siswa', 'tipe')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $data,
            $req->all()
        ]);
    }
    public function update(Request $req, $id)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'tipeId' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], [
            'tipeId.required' => 'Tipe ID harus diisi',
            'judul.required' => 'Judul harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,gif,svg',
            'gambar.max' => 'Ukuran gambar maksimal 3 MB',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'errors' => $validator->errors() 
            ], 422);
        }

        $laporan = LaporanSiswa::where('id', $id)->with('siswa', 'tipe')->where('siswaId', Auth::user()->id)->first();
        $laporan->tipeId = $req->tipeId;
        
        $laporan->judul = $req->judul;
        
        $laporan->deskripsi = $req->deskripsi;
        $laporan->keterangan = $req->keterangan;
        $laporan->status = $req->status;

        if ($req->deleteImage == 'true') {
            Storage::delete($laporan->gambar);
            $laporan->gambar = null;
        }

        if ($req->hasFile('gambar')) {
            if ($laporan->gambar) {
                Storage::delete($laporan->gambar);
            }
            $file = $req->file('gambar');
            $fileName =  Str::slug($req->judul) . '-' . time() . '-' . Str::random(4) . '.' . $file->getClientOriginalExtension();

            $file->move('storage/laporanSiswa', $fileName);
            $path = 'laporanSiswa/' . $fileName;

            $laporan->gambar = $path;
        }

        if ($req->status) {
            $laporan->status = 'Privat';
        } else {
            $laporan->status = 'Publik';
        }

        $laporan->update();

        $data = LaporanSiswa::where('id', $laporan->id)->with('siswa', 'tipe')->first();

        // dd($req->all(), $laporan->judul);


        return response()->json([
            'statusCode' => 200,
            'data' => $data,
        ]);
    }
    public function destroy($id)
    {
        $laporan = LaporanSiswa::where('id', $id)->where('siswaId', Auth::user()->id)->first();

        if ($laporan->gambar) {
            Storage::delete($laporan->gambar);
        }

        $laporan->delete();

        return response()->json([
            'statusCode' => 200,
            'message' => 'Laporan Dihapus!'
        ]);
    }





    // FOR GURU FOR RURU
    public function indexGuru(Request $req)
    {
        if ($req->search || $req->tipeId) {
            if ($req->search && !$req->tipeId) {
                $laporan = LaporanSiswa::with('siswa', 'tipe')
                                        ->where('judul', 'LIKE', '%' . $req->search . '%')
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            } elseif (!$req->search && $req->tipeId) {
                $laporan = LaporanSiswa::with('siswa', 'tipe')
                                        ->where('tipeId', $req->tipeId)
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            } elseif($req->search && $req->tipeId) {
                $laporan = LaporanSiswa::with('siswa', 'tipe')
                                        ->where('tipeId', $req->tipeId)
                                        ->where('judul', 'LIKE', '%' . $req->search . '%')
                                        ->orderBy('created_at', 'desc')
                                        ->get();
            }
        } else {
            $laporan = LaporanSiswa::orderBy('created_at', 'desc')->with('siswa', 'tipe')->get();
        }
        
        return response()->json([
            'statusCode' => 200,
            'data' => $laporan
        ]);
    }

}
