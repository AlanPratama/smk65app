<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\TipePengumuman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PengumumanAjaxController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();

        return response()->json([
            'statusCode' => 200,
            'data' => $pengumuman
        ]);
    }

    public function indexAjax(Request $req)
    {
        if ($req->search) {
            $pengumuman = Pengumuman::orderBy('created_at', 'desc')
                            ->where('judul', 'LIKE', '%' . $req->search . '%')
                            ->with('guru', 'tipe')
                            ->get();
        } else {
            $pengumuman = Pengumuman::orderBy('created_at', 'desc')->with('guru', 'tipe')->get();
        }

        return response()->json([
            'statusCode' => 200,
            'data' => $pengumuman
        ]);
    }

    public function show($id)
    {
        $pengumuman = Pengumuman::where('id', $id)->with('tipe', 'guru')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $pengumuman
        ]);
    }

    public function store(Request $req)
    {
        // return response()->json([
        //     'statusCode' => 200,
        //     'data' => $req->all()
        // ]);

        // dd($req)
        $validator = Validator::make($req->all(), [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tipe' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $gambar = null;

        if ($req->hasFile('gambar')) {
            $file = $req->file('gambar');
            $fileName = Str::slug($req->judul) . Carbon::now()->toDateString() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pengumuman', $fileName);
            $gambar = $path;
        }

        $pengumuman = Pengumuman::create([
            'guruId' => 1,
            'tipeId' => $req->tipe,
            'judul' => $req->judul,
            'deskripsi' => $req->deskripsi,
            'keterangan' => $req->keterangan,
            'gambar' => $gambar,
            'tanggal' => Carbon::now()->toDateString(),
            'status' => 'Aktif'
        ]);

        $data = Pengumuman::where('id', $pengumuman->id)->with('tipe', 'guru')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function update(Request $req, $id)
    {
        // return response()->json([
        //     'statusCode' => 200,
        //     'data' => $req->all()
        // ]);

        $pengumuman = Pengumuman::where('id', $id)->first();

        $validator = Validator::make($req->all(), [
            'judulEdit' => 'required',
            'deskripsiEdit' => 'required',
            'tipeEdit' => 'required',
            'gambarEdit' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $gambar = $pengumuman->gambar;

        if ($req->hasFile('gambarEdit')) {
            if ($gambar) {
                Storage::delete($pengumuman->gambar);
            }
            $file = $req->file('gambarEdit');
            $fileName = Str::slug($req->judul) . Carbon::now()->toDateString() . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pengumuman', $fileName);
            $gambar = $path;
        }

        $data = [
            'guruId' => 1,
            'tipeId' => $req->tipeEdit,
            'judul' => $req->judulEdit,
            'deskripsi' => $req->deskripsiEdit,
            'keterangan' => $req->keteranganEdit,
            'gambar' => $gambar,
        ];

        $pengumuman->update($data);

        $data = Pengumuman::where('id', $pengumuman->id)->with('tipe', 'guru')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::where('id', $id)->first();

        if ($pengumuman->gambar) {
            Storage::delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return response()->json('Pengumuman Terhapus');
    }




    // TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN
    // TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN || TIPE PENGUMUMAN
    public function indexTipeAjax(Request $req)
    {

        if ($req->search) {
            $data = TipePengumuman::where('tipe', 'LIKE', '%'. $req->search . '%')->with('pengumuman')->orderBy('id', 'desc')->get();
        } else {
            $data = TipePengumuman::with('pengumuman')->orderBy('id', 'desc')->get();
        }

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function showTipe($id)
    {
        $data = TipePengumuman::where('id', $id)->with('pengumuman')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function storeTipe(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'tipe' => 'required|unique:tipe_pengumumen,tipe',
        ], [
            'tipe.required' => 'Tipe harus diisi',
            'tipe.unique' => 'Tipe sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $tipeCreate = TipePengumuman::create([
            'tipe' => $req->tipe
        ]);

        $data = TipePengumuman::where('id', $tipeCreate->id)->with('pengumuman')->first();

        return response()->json([
            'statusCode' => 200,
            'data' => $data
        ]);
    }

    public function updateTipe(Request $req, $id)
    {
        // return response()->json($req->all());

        $validator = Validator::make($req->all(), [
            'tipe' => 'required|unique:tipe_pengumumen,tipe,'.$id,
        ],[
            'tipe.required' => 'Tipe harus diisi',
            'tipe.unique' => 'Tipe sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $tipePengumuman = TipePengumuman::where('id', $id)->with('pengumuman')->first();

        if (!$tipePengumuman) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Tipe Pengumuman Tidak Ditemukan'
            ]);
        }

        $tipePengumuman->tipe = $req->tipe;
        $tipePengumuman->save();

        return response()->json([
            'statusCode' => 200,
            'data' => $tipePengumuman
        ]);
    }

    public function destroyTipe($id)
    {
        $tipePengumuman = TipePengumuman::where('id', $id)->first();

        if (!$tipePengumuman) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Tipe Pengumuman Tidak Ditemukan'
            ], 404);
        }

        // SEMENTARA
        $tipePengumuman->pengumuman->each(function($pengumuman) {
            $pengumuman->tipeId = null;
            $pengumuman->save();
        });
        $tipePengumuman->delete();
        

        return response()->json('Tipe Pengumuman Terhapus');
    }
}
