<!DOCTYPE html>
<html>

@php
  use Carbon\Carbon;
@endphp

<head>
  <meta charset="utf-8" />
  <title>LAPORAN HASIL BELAJAR | {{$siswa->name}} ({{$siswa->nis}})</title>
  <link href="./cetakraport/invoice_raport.css" rel="stylesheet">
</head>

<body>

  <div class="invoice-box">

    {{-- HEADER --}}
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
    {{-- END HEADER --}}

    {{-- CONTENT --}}
    <div class="content">

      <div class="" style="text-align: center">
        <h3><strong>LAPORAN HASIL BELAJAR</strong></h3>
      </div>

      <table cellspacing="0">

        <tr class="heading">
          <td style="width: 8%">No</td>
          <td style="width: 30%">Mata Pelajaran</td>
          <td style="width: 10%">Nilai Akhir</td>
          <td>Capaian Kompetensi</td>
        </tr>

        @if ($kelompokmapel->count() >= 1)
          @foreach ($kelompokmapel as $item)

          <tr class="nilai">
            <td colspan="4"><strong>{{ $item->name }}</strong></td>
          </tr>

            @php
                $mapelId = \App\Models\Mapel::where('kelompok_mapel_id',$item->id)->pluck('id');
            @endphp
            <?php $no = 0; ?>
            @foreach($pembelajaran->whereIn('mapel_id', $mapelId) as $i => $pemb)
              <?php $no++; ?>
              <tr class="nilai">
                <td class="center">{{$no}}</td>
                <td>{{ $pemb->mapel->name }}</td>
                <td class="center">{{ $siswa->nilaiAkhir->where('pembelajaran_id', $pemb->id)->first()->nilai ?? '-'; }}</td>
                <td>
                  <span>{{ $siswa->nilaiAkhir->where('pembelajaran_id', $pemb->id)->first()->deskripsi_capaian_tinggi ?? null; }} </span>
                  <span style="display: flex;">{{ $siswa->nilaiAkhir->where('pembelajaran_id', $pemb->id)->first()->deskripsi_capaian_rendah ?? null; }} </span>
                </td>
              </tr>
            @endforeach

          @endforeach
        @endif

      </table>
    </div>
    {{-- END CONTENT --}}

    {{-- FOOTER --}}
    <div class="footer" style="font-family: 'Times New Roman'; font-weight: bold;">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 1</i></b>
    </div>
    {{-- END FOOTER --}}

  </div>

  <div class="page-break"></div>

  <!-- Page 4 (Other) -->
  <div class="invoice-box">

    {{-- HEADER --}}
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

    {{-- CONTENT --}}
    <div class="content">
      <table cellspacing="0">
        <!-- Ekskul -->
        <tr class="heading">
          <td style="width: 8%;">NO</td>
          <td style="width: 30%;">Kegiatan Ekstrakurikuler</td>
          <td style="width: 20%">Predikat</td>
          <td >Keterangan</td>
        </tr>
        @if ($anggotaEkskul->count() >= 1)
          @foreach ($anggotaEkskul as $a => $angg)
            <tr class="nilai">
              <td class="center">{{$loop->iteration}}</td>
              <td> {{$angg->ekskul->name }} </td>
              <td style="text-align: center;">
                @if ($angg->predikat == 'A')
                  Sangat Baik
                @elseif ($angg->predikat == 'B')
                  Baik
                @elseif ($angg->predikat == 'C')
                  Cukup
                @elseif ($angg->predikat == 'D')
                  Kurang
                @endif
              </td>
              <td>{{ $angg->deskripsi }}</td>
            </tr>
          @endforeach
        @else
          @foreach ([1,2] as $x)
            <tr class="nilai">
              <td class="center" style="padding: 15px;"></td>
              <td></td>
              <td style="text-align: center;"></td>
              <td></td>
            </tr>
          @endforeach
        @endif
        <!-- End Ekskul -->
      </table>

      <br><br>

      <table cellspacing="0" style="width: 50%">
        <!-- Ketidakhadiran  -->
          <tr class="nilai">
            <td style="border-right:0 ;">Sakit</td>
            <td style="border-left:0 ;">: {{$ketidakhadiran[0]->sakit ?? 0}} hari</td>
            <td class="false"></td>
          </tr>
          <tr class="nilai">
            <td style="border-right:0 ;">Izin</td>
            <td style="border-left:0 ;">: {{$ketidakhadiran[0]->izin ?? 0}} hari</td>
            <td class="false"></td>
          </tr>
          <tr class="nilai">
            <td style="border-right:0 ;">Tanpa Keterangan</td>
            <td style="border-left:0 ;">: {{$ketidakhadiran[0]->tk ?? 0}} hari</td>
            <td class="false"></td>
          </tr>
        <!-- End Ketidakhadiran  -->
      </table>

      <br>

      <table cellspacing="0">
        <!-- Catatan Wali Kelas -->
      <tr>
        <td colspan="4" style="height: 25px; padding-top: 5px"><strong>CATATAN WALI KELAS</strong></td>
      </tr>
      <tr class="sikap">
        <td colspan="4" class="description" style="height: 50px;">
          {{ $catatanwalas[0]->catatan ?? '-'  }}
        </td>
      </tr>
      <!-- End Catatan Wali Kelas -->

      @if ($siswa->kelas->tapel->semester == 2)
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 15px"><strong>KEPUTUSAN</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 50px;">
            Berdasarkan hasil pembelajaran yang dicapai, Peserta Didik ditetapkan:

            @if ($catatanwalas->count() >= 1)
              @if ($catatanwalas[0]->naik_tingkat == false)
                @if ($siswa->kelas->tingkat->angka == 6 || $siswa->kelas->tingkat->angka == 9 || $siswa->kelas->tingkat->angka == 12)
                  <b>TIDAK LULUS</b>
                @else
                  <b>TINGGAL DI KELAS {{ $siswa->kelas->tingkat->angka}}</b>
                @endif
              @else
                @if ($siswa->kelas->tingkat->angka == 6 || $siswa->kelas->tingkat->angka == 9 || $siswa->kelas->tingkat->angka == 12)
                  <b>LULUS</b>
                @else
                  <b>NAIK KE KELAS {{ intval($siswa->kelas->tingkat->angka) + 1 }}</b>
                @endif
              @endif
            @else
              @if ($siswa->kelas->tingkat->angka == 6 || $siswa->kelas->tingkat->angka == 9 || $siswa->kelas->tingkat->angka == 12)
                <b>LULUS</b>
              @else
                <b>NAIK KE KELAS {{ intval($siswa->kelas->tingkat->angka) + 1 }}</b>
              @endif
            @endif

          </td>
        </tr>
      @endif

      </table>

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

    {{-- FOOTER --}}
    <div class="footer" style="font-family: 'Times New Roman'; font-weight: bold;">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 2</i></b>
    </div>

  </div>

</body>

</html>
