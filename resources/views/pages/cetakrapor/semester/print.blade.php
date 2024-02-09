@extends('pages.cetakraport.semester.main')

@php
  use Carbon\Carbon;
@endphp

@section('content')

    <div class="content">
      <table cellspacing="0">
        <tr style="padding-top: 15px;">
          <td colspan="4" style="height: 30px;"><strong>LAPORAN HASIL BELAJAR</strong></td>
        </tr>

        <tr class="heading">
          <td>No</td>
          <td>Mata Pelajaran</td>
          <td>Nilai Akhir</td>
          <td>Capaian Kompetensi</td>
        </tr>

        @foreach (['Mata Pelajaran Wajib', 'Muatan Lokal'] as $item)

        <tr class="nilai">
          <td colspan="4"><strong>{{ $item }}</strong></td>
        </tr>

          <?php $no = 0; ?>
          @foreach([1,2,3,4,5] as $i)
            <?php $no++; ?>
            <tr class="nilai">
              <td class="center">{{$no}}</td>
              <td>Pendidikan Agama Islam dan Budi Pekerti</td>
              <td class="center">90</td>
              <td >
                  Mencapai Kompetensi dengan sangat baik dalam hal menyimak teks
                  fiksi dan nonfiksi tentang berteman dan empat kata ajaib,
                  menjelaskan perbedaan uang koin dan uang kertas, mengeja,
                  membaca, dan menulis nama petugas berseragam, menjelaskan
                  cara melindungi diri apabila menghadapi orang tidak dikenal.
                  Perlu peningkatan dalam hal mengamati dan menandai letak serta
                  posisi benda, menyimak petunjuk teman tentang arah dan posisi.
              </td>
            </tr>
          @endforeach

        @endforeach

      </table>
    </div>

    <div class="page-break">

    </div>
    <div class="content">
      <table cellspacing="0">

        <!-- Ekskul -->
        <tr class="heading">
          <td style="width: 5%;">NO</td>
          <td style="width: 28%;">Kegiatan Ekstrakurikuler</td>
          <td >Predikat</td>
          <td >Keterangan</td>
        </tr>
        @foreach (['Pramuka', 'Futsal', 'Menari'] as $ekskul)
          <tr class="nilai">
            <td class="center">{{$loop->iteration}}</td>
            <td> {{$ekskul}} </td>
            <td>A</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, id</td>
          </tr>
        @endforeach
        <!-- End Ekskul -->

        <!-- Ketidakhadiran  -->
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Sakit</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->sakit ?? 0}} hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Izin</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->izin ?? 0}} hari</td>
          <td class="false"></td>
        </tr>
        <tr class="nilai">
          <td colspan="2" style="border-right:0 ;">Tanpa Keterangan</td>
          <td style="border-left:0 ;">: {{$kehadiran_siswa->tanpa_keterangan ?? 0}} hari</td>
          <td class="false"></td>
        </tr>
        <!-- End Ketidakhadiran  -->

        <!-- Catatan Wali Kelas -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>CATATAN WALI KELAS</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 50px;">
           Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi iure ipsam eius quidem laboriosam inventore. Reiciendis vero repudiandae inventore perspiciatis?
          </td>
        </tr>
        <!-- Catatan Wali Kelas -->



      </table>
    </div>

    <div style="padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
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

@endsection
