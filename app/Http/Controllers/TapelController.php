<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TapelController extends Controller
{
    public function index() {
      if (Auth::user()->sekolah_id == 0) {
        $tapel = Tapel::get();
      }else{
        $tapel = Tapel::where('sekolah_id',Auth::user()->sekolah_id)->get();
      }
      return view('pages.tapel.index',[
        'tapel' => $tapel,
      ]);
    }

    public function create(Request $request) {
      return view('pages.tapel.create',[
        'sekolah' => Sekolah::where('status',1)->get(),
      ]);
    }
    public function edit(Tapel $tapel) {
      return view('pages.tapel.edit',[
        'sekolah' => Sekolah::where('status',1)->get(),
        'tapel' => $tapel,
        'tahun1' => Str::before($tapel->tahun_pelajaran, '/'),
        'tahun2' => Str::after($tapel->tahun_pelajaran, '/')
      ]);
    }

    public function update(Request $request, Tapel $tapel) {
      $request->validate([
        'tahun1' => 'required|numeric|digits:4',
        'tahun2' => 'required|numeric|digits:4',
        'semester' => 'required',
        'status' => 'required',
        'sekolah_id' => 'required',
        'tempat' => 'nullable',
        'tanggal' => 'nullable|date',
      ]);

      if ((intval($request->tahun1) + 1) !== intval($request->tahun2)){
        return back()->withInput()->withFailed('Pengisian Tahun pelajaran harus sesuai ketentuan!');
      }

      if ($request->status == 1) {
        $cek = Tapel::where('sekolah_id',$tapel->sekolah_id)->where('status',1)->get();
        if (count($cek) > 0) {
          foreach ($cek as $key => $value) {
            $update = Tapel::find($value->id);
            $update->status = 0;
            $update->save();
          }
        }
      }

      $tapel->update([
        'tahun_pelajaran' => $request->tahun1 . '/' . $request->tahun2,
        'semester' => $request->semester,
        'tempat' => $request->tempat,
        'tanggal' => $request->tanggal,
        'sekolah_id' => $request->sekolah_id,
        'status' => $request->status,
      ]);

      return redirect(route('tapel.index'))->withSuccess('Data berhasil diperbarui!');
    }
    public function store(Request $request) {
      $request->validate([
        'tahun1' => 'required|numeric|digits:4',
        'tahun2' => 'required|numeric|digits:4',
        'semester' => 'required',
        'status' => 'required',
        'sekolah_id' => 'required',
        'tempat' => 'nullable',
        'tanggal' => 'nullable|date',
      ]);

      if ((intval($request->tahun1) + 1) !== intval($request->tahun2)){
        return back()->withInput()->withFailed('Pengisian Tahun pelajaran harus sesuai ketentuan!');
      }

      if ($request->status == 1) {
        $cek = Tapel::where('sekolah_id',$request->sekolah_id)->where('status',1)->get();
        if (count($cek) > 0) {
          foreach ($cek as $key => $value) {
            $update = Tapel::find($value->id);
            $update->status = 0;
            $update->save();
          }
        }
      }

      Tapel::create([
        'tahun_pelajaran' => $request->tahun1 . '/' . $request->tahun2,
        'semester' => $request->semester,
        'tempat' => $request->tempat,
        'tanggal' => $request->tanggal,
        'sekolah_id' => $request->sekolah_id,
        'status' => $request->status,
      ]);

      return redirect(route('tapel.index'))->withSuccess('Data berhasil ditambahkan!');
    }
  
}
