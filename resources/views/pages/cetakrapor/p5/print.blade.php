<!DOCTYPE html>
<html>

@php
  use Carbon\Carbon;
@endphp

<head>
  <meta charset="utf-8" />
  <title>RAPOR PROJEK | {{$siswa->name}} ({{$siswa->nis}})</title>
  <link href="./cetakraport/invoice_raport.css" rel="stylesheet">
</head>

<body>

  <!-- Page 2 Nilai Akhir  -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td>Nama</td>
          <td>: {{$siswa->name}} </td>
          <td>Kelas</td>
          <td>: {{$siswa->kelas->name}}</td>
        </tr>
        <tr>
          <td>NIS/NISN</td>
          <td>: {{$siswa->nis}} / {{$siswa->nisn}} </td>
          <td>Fase</td>
          <td>: {{$siswa->kelas->tingkat->fase->name}}</td>
        </tr>
        <tr>
          <td>Nama Sekolah</td>
          <td>: {{$sekolah->name}}</td>
          <td>Semester</td>
          <td>:
            {{ $siswa->kelas->tapel->semester == 1 ? '1 (Ganjil)' : '2 (Genap)'}}
          </td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>: {{$siswa->kelas->tapel->tempat ?? 'Kota'}}</td>
          <td>Tahun Pelajaran</td>
          <td>: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
      </table>
    </div>

    <div class="content">

      <div class="" style="text-align: center">
        <h3><strong>RAPOR PROJEK PENGUATAN PROFIL PELAJAR PANCASILA</strong></h3>
      </div>

      @if ($projek->count() >= 1)
        @foreach ($projek as $i => $item)
          <table>
            <tr>
              <td><b> Projek {{ $i + 1 }} : {{ $item->name }}</b></td>
            </tr>
            <tr>
              <td>
                <i> Deskripsi Projek: </i>
              </td>
            </tr>
            <tr>
              <td>
                {{ $item->deskripsi }}
              </td>
            </tr>
          </table>
          <br>
        @endforeach
      @endif
    </div>

    <div class="footer" style="font-weight: bold;">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 1</i></b>
    </div>

  </div>

  <div class="page-break"></div>

  <!-- Page 4 (Other) -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td>Nama</td>
          <td>: {{$siswa->name}} </td>
          <td>Kelas</td>
          <td>: {{$siswa->kelas->name}}</td>
        </tr>
        <tr>
          <td>NIS/NISN</td>
          <td>: {{$siswa->nis}} / {{$siswa->nisn}} </td>
          <td>Fase</td>
          <td>: {{$siswa->kelas->tingkat->fase->name}}</td>
        </tr>
        <tr>
          <td>Nama Sekolah</td>
          <td>: {{$sekolah->name}}</td>
          <td>Semester</td>
          <td>:
            {{ $siswa->kelas->tapel->semester == 1 ? '1 (Ganjil)' : '2 (Genap)'}}
          </td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>: {{$siswa->kelas->tapel->tempat ?? 'Kota'}}</td>
          <td>Tahun Pelajaran</td>
          <td>: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
      </table>
    </div>

    <div class="content">
      @if ($projek->count() >= 1)
        @foreach ($projek as $i => $item)
          <table cellspacing="0">
            <tr class="nilai" style="font-weight: bold; font-style: italic;">
              <td style="width: ; text-align: left;">{{ $i + 1 }}. {{ $item->name }}</td>
              <td style="width: ; text-align: center;">Mulai Berkembang</td>
              <td style="width: ; text-align: center;">Sedang Berkembang</td>
              <td style="width: ; text-align: center;">Berkembang Sesuai Harapan</td>
              <td style="width: ; text-align: center;">Sangat Berkembang</td>
            </tr>

            @php
                $dimensis = \App\Models\Dimensi::select('dimensis.*')
                            ->join('elemens', 'dimensis.id', '=', 'elemens.dimensi_id')
                            ->join('sub_elemens', 'elemens.id', '=', 'sub_elemens.elemen_id')
                            ->join('capaian_akhirs', 'sub_elemens.id', '=', 'capaian_akhirs.sub_elemen_id')
                            ->join('capaian_projeks', 'capaian_akhirs.id', '=', 'capaian_projeks.capaian_akhir_id')
                            ->where('capaian_projeks.projek_id', $item->id)
                            ->distinct('dimensis.id')
                            ->get()
            @endphp

            @foreach ($dimensis as $dmns)
              <tr class="heading">
                <td colspan="5" style="text-align: left;"><b>{{ $dmns->name }}</b></td>
              </tr>

              @php
               $capaianProjeks = \App\Models\CapaianProjek::where('projek_id', $item->id)
                  ->whereHas('capaianAkhir.subElemen.elemen.dimensi', function ($query) use($dmns) {
                      $query->where('dimensis.id', $dmns->id);
                  })
                  ->get();
              @endphp

              @if ($capaianProjeks->count() >= 1)
                @foreach ($capaianProjeks as $capaian)

                  @php
                      $nilaiProjek = App\Models\NilaiProjek::where('siswa_id', $siswa->id)->where('capaian_projek_id', $capaian->id)->get();
                  @endphp

                  <tr class="nilai">
                    <td class="center" style="text-align: left; width: 50%">
                      <ul style="padding-left: 15px; margin-top: 0; margin-bottom: 0;">
                        <li style="text-indent: 0px; padding-top: 0; padding-bottom: 0; margin-top: 0; margin-bottom: 0;">{{ $capaian->capaianAkhir->name }}</li>
                      </ul>
                    </td>
                    @if ($nilaiProjek->count() >= 1)
                      <td style="text-align: center;">
                        @if ($nilaiProjek[0]->predikat == 'MB')
                          <img src="./img/ceklis.png" alt="Ceklis" width="20px">
                        @else

                        @endif
                      </td>
                      <td style="text-align: center;">
                        @if ($nilaiProjek[0]->predikat == 'SDGB')
                        <img src="./img/ceklis.png" alt="Ceklis" width="20px">
                        @else

                        @endif
                      </td>
                      <td style="text-align: center;">
                        @if ($nilaiProjek[0]->predikat == 'BSH')
                          <img src="./img/ceklis.png" alt="Ceklis" width="20px">
                        @else

                        @endif
                      </td>
                      <td style="text-align: center;">
                        @if ($nilaiProjek[0]->predikat == 'SGTB')
                          <img src="./img/ceklis.png" alt="Ceklis" width="20px">
                        @else

                        @endif
                      </td>
                    @else
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    @endif
                  </tr>
                @endforeach
              @endif
            @endforeach
            <tr class="nilai">
              <td colspan="5">
                @php
                    $catatan = \App\Models\CatatanProjek::where('siswa_id', $siswa->id)->where('projek_id', $item->id)->first()->keterangan ?? '-';
                @endphp
                <b><i>Catatan Proses</i></b> <br>
                <span> <i> {{ $catatan }} </i> </span>
              </td>
            </tr>
          </table>
          <br>
          <br>
        @endforeach
      @endif
    </div>

    <div style="padding-top:1rem;">
      <table>
        <tr>
          <td style="width: 30%;">
            Mengetahui <br>
            Orang Tua/Wali, <br><br><br><br>
            .............................
          </td>
          <td style="width: 35%;"></td>
          <td style="width: 35%;">
        {{$siswa->kelas->tapel->tempat ?? 'Tempat'}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->kelas->tapel->tanggal, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
            Wali Kelas, <br><br><br><br>
            <b><u>{{$siswa->kelas->guru->name}}</u></b><br>
            NIP. {{$siswa->kelas->guru->nip}}
          </td>
        </tr>
        <tr>
          <td style="width: 30%;"></td>
          <td style="width: 35%;">
            Mengetahui <br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>{{$sekolah->namakepsek}}</u></b><br>
            NIP. {{$sekolah->nipkepsek}}
          </td>
          <td style="width: 35%;"></td>
        </tr>
      </table>
    </div>
    <div class="footer" style="font-weight: bold;">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 2</i></b>
    </div>
  </div>

</body>

</html>
