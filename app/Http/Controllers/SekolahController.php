<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SekolahController extends Controller
{
    public function list() {
      return view('pages.sekolah.list',[
        'sekolah' => Sekolah::orderBy('name','asc')->get(),
      ]);
    }
    public function create() {
      return view('pages.sekolah.create');
    }
    public function index() {
    if (Auth::user()->sekolah_id == 0) {
      $sekolah = Sekolah::first();
    }else{
      $sekolah = Sekolah::find(Auth::user()->sekolah_id);
    }
      return view('pages.sekolah.index',[
        'sekolah' => $sekolah,
      ]);
    }
    public function editsekolah($id) {
      return view('pages.sekolah.index',[
        'sekolah' => Sekolah::find($id),
      ]);
    }
   


    public function store(Request $request){
      $validasi = Validator::make($request->all(),[
        'name' => 'required',
        'nss' => 'nullable',
        'npsn' => 'nullable',
        'alamat' => 'nullable',
        'kodepos' => 'nullable',
        'telepon' => 'nullable',
        'email' => 'nullable|email',
        'website' => 'nullable',
        'namakepsek' => 'nullable',
        'nipkepsek' => 'nullable',
        'logo' => 'nullable',
      ]);

      if ($validasi->fails()) {
        // return response()->json(['errors' => $validasi->errors()]);
        return redirect()->route('list-sekolah')->with('error', $validasi->errors());

      } else {
        $data = new Sekolah();
        $data->name = $request->name;
        $data->nss = $request->nss;
        $data->npsn = $request->npsn;
        $data->alamat = $request->alamat;
        $data->kodepos = $request->kodepos;
        $data->telepon = $request->telepon;
        $data->email = $request->email;
        $data->website = $request->website;
        $data->namakepsek = $request->namakepsek;
        $data->nipkepsek = $request->nipkepsek;
        $data->status = $request->status;

        if ($request->logo == null) {
          return redirect()->route('list-sekolah')->with('error', 'Data Sekolah gagal diperbarui!');
          // return response()->json(['errors' => $validasi->errors()]);
        } else {
          $fileName = 'logo' . time() . '.' . $request->file('logo')->getClientOriginalExtension();
  
          try {
            DB::beginTransaction();
              $request->file('logo')->move('img', $fileName);
            DB::commit();
          } catch (\Throwable $th) {
            return redirect()->route('list-sekolah')->with('error', 'Terjadi kesalahan!');
            // return response()->json(['failed' => 'Terjadi kesalahan!']);
            DB::rollBack();
          }
        }
        $data->logo = $fileName;

        $data->save();

        return redirect()->route('list-sekolah')->with('success', 'Data Sekolah berhasil disimpan!');
      }
    }

    public function updatestatus(Request $request,$id){
      $update = Sekolah::find($id);
      $update->status = $request->status;
      $update->save();
      return redirect()->route('list-sekolah')->with('success', 'Data Sekolah berhasil diperbarui!');
    }
    
    public function deleteSekolah($id){
      $update = Sekolah::find($id);
      $update->delete();
      return redirect()->route('list-sekolah')->with('success', 'Data Sekolah berhasil dihapus!');
    }

    public function updateData(Request $request){
      $validasi = Validator::make($request->all(),[
        'name' => 'required',
        'nss' => 'nullable',
        'npsn' => 'nullable',
        'alamat' => 'nullable',
        'kodepos' => 'nullable',
        'telepon' => 'nullable',
        'email' => 'nullable|email',
        'website' => 'nullable',
        'namakepsek' => 'nullable',
        'nipkepsek' => 'nullable',
        'logo' => 'nullable',
      ]);

      if ($validasi->fails()) {
        return response()->json(['errors' => $validasi->errors()]);
      } else {
        Sekolah::first()->update($request->all());
        return response()->json(['success' => 'Data Sekolah berhasil diperbarui']);
      }
    }

    public function updateLogo(Request $request){
      $validasi = Validator::make($request->all(),[
        'old_logo' => 'required',
        'logo' => 'required|image',
      ]);

      if ($validasi->fails()) {
        return response()->json(['errors' => $validasi->errors()]);
      } else {
        $fileName = 'logo' . time() . '.' . $request->file('logo')->getClientOriginalExtension();

        try {
          DB::beginTransaction();
            $request->file('logo')->move('img', $fileName);
            Sekolah::first()->update(['logo' => $fileName]);
            if ($request->old_logo != 'logosekolah.png') File::delete(public_path('/img/' . $request->old_logo));
          DB::commit();
        } catch (\Throwable $th) {
          return response()->json(['failed' => 'Terjadi kesalahan!']);
          DB::rollBack();
        }
      }
      return response()->json(['success' => 'Logo Sekolah berhasil diperbarui']);
    }
}
