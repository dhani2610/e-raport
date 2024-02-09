<?php

namespace App\Http\Controllers;

use App\Models\AnggotaEkskul;
use App\Models\Ekskul;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class AnggotaEkskulController extends Controller
{
    public function show(Request $request, Ekskul $ekskul){
      $user = Auth::user();
      if (!($user->isPembinaEkskul() && ($user->guru->id == $ekskul->guru_id ))) {
        abort(403);
      }

      $data = AnggotaEkskul::where('ekskul_id', $ekskul->id);

      if ($request->ajax()) {
        return DataTables::of($data->with('siswa.kelas', 'ekskul'))->addIndexColumn()
          ->editColumn('siswa.name', function($data){
            return $data->siswa->name;
          })
          ->editColumn('siswa.nis', function($data){
            return $data->siswa->nis;
          })
          ->editColumn('siswa.kelas.name', function($data){
            return ($data->siswa->kelas) ? $data->siswa->kelas->name : '-';
          })
          ->editColumn('predikat', function($data){
            return view('pages.ekskul._predikat')->with(['id' => $data->id,'predikat' => $data->predikat]);
          })
          ->editColumn('deskripsi', function($data){
            return view('pages.ekskul._deskripsi')->with(['id' => $data->id, 'deskripsi' => $data->deskripsi]);
          })
          ->make(true);
      }

      return view('pages.ekskul.show',[
        'anggotaekskul' => $data,
        'ekskul' => $ekskul,
      ]);
    }

    public function update( Request $request){
      try {
        DB::beginTransaction();
          foreach ($request->id as $i => $id) {
            AnggotaEkskul::find($id)->update([
              'predikat' => $request->predikat[$i],
              'deskripsi' => $request->deskripsi[$i],
            ]);
          }
        DB::commit();
        return response()->json(['success' => 'Berhasil diperbarui!']);
      } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['failed' => 'Terjadi kesalahan!']);
      }
    }

    public function create(Request $request, Ekskul $ekskul){
      $anggotaDiEkskulIni = $ekskul->anggotaEkskul->pluck('siswa_id');

      $data = Siswa::whereHas('user', fn($q) => $q->where('is_aktif', true))
                    ->whereNotIn('id', $anggotaDiEkskulIni);

      if ($request->kelas_id) $data->where('kelas_id', $request->kelas_id);

      return DataTables::of($data->with('kelas','anggotaEkskul'))->addIndexColumn()
            ->editColumn('kelas.name', function($data){
              return ($data->kelas) ? $data->kelas->name : '-';
            })
            ->addColumn('aksi', function($data) use($ekskul){
                return view('pages.ekskul.anggotaekskul._tambahkan')->with('data', $data);
            })
            ->make(true);
    }

    public function store(Request $request){
      try {
        DB::beginTransaction();
          if (AnggotaEkskul::where('ekskul_id', $request->ekskul_id)->where('siswa_id', $request->siswa_id)->exists()) {
            return response()->json(['failed' => 'Siswa yang dipilih sudah menjadi anggota!']);
          } else {
            $anggotaEkskul = AnggotaEkskul::create([
              'ekskul_id' => $request->ekskul_id,
              'siswa_id' => $request->siswa_id,
            ]);
          }
          DB::commit();
          return response()->json(['success' => $anggotaEkskul->siswa->name . ' berhasil ditambahkan!']);
      } catch (\Throwable $th) {
        return response()->json(['failed' => 'Terjadi kesalahan!']);
        DB::rollBack();
      }
    }

    public function delete(Request $request, Ekskul $ekskul){
      $data = Siswa::WhereHas('anggotaEkskul', fn ($q) => $q->where('ekskul_id', $ekskul->id) );

      if ($request->kelas_id) $data->where('kelas_id', $request->kelas_id);

      return DataTables::of($data->with('anggotaEkskul', 'kelas'))->addIndexColumn()
            ->editColumn('kelas.name', function($data){
              return ($data->kelas) ? $data->kelas->name : '-';
            })
            ->addColumn('aksi', function($data) use($ekskul){
              $anggotaEkskulId = AnggotaEkskul::where('siswa_id', $data->id)->where('ekskul_id', $ekskul->id)->first()->id;
              return view('pages.ekskul.anggotaekskul._hapus')->with(['data' => $data, 'id' => $anggotaEkskulId]);
            })
            ->make(true);
    }

    public function hapus(AnggotaEkskul $anggotaekskul) {
      $anggotaekskul->delete();
      return response()->json(['success' => $anggotaekskul->siswa->name . ' berhasil dihapus!']);
    }
}
