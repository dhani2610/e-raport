<!DOCTYPE html>
<html>

@php
  use Carbon\Carbon;
@endphp

<head>
  <meta charset="utf-8" />
  <title>CETAK RAPORT | {{$siswa->name}} ({{$siswa->nis}})</title>
  <link href="./my-css/invoice_raport.css" rel="stylesheet">
</head>

<body>
  <!-- Page 1 Sampul -->
  <div class="invoice-box">
    <div class="content">
      <div style="text-align: center; padding-bottom: 10px;">
        <img src="./img/{{ $sekolah->logo ?? 'logo.png' }}" alt="Logo" height="160px">
      </div>
      <h1><strong>LAPORAN</strong></h1>
      <h1><strong>HASIL BELAJAR SISWA</strong></h1>
    </div>
    <div style="text-align: center; padding-top: 150px;">
      <h3>NAMA PESERTA DIDIK</h3>
      <table>
        <tr>
          <td style="width: 15%;"></td>
          <td style="width: 70%; border: 1px solid #333; height: 35px; text-align: center; font-size: 18px; text-transform: uppercase;"><b>{{$siswa->name}}</b></td>
          <td style="width: 15%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 25px;">
      <h3>NISN / NIS</h3>
      <table>
        <tr>
          <td style="width: 20%;"></td>
          <td style="width: 60%; border: 1px solid #333; height: 35px; text-align: center; font-size: 18px;"><b>{{$siswa->nisn}} / {{$siswa->nis}}</b></td>
          <td style="width: 20%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 140px;">
      <h1><strong>{{$sekolah->name}}</strong></h1>
      <p style="font-size: 16px; line-height: 20px;">NPSN : {{$sekolah->npsn}} | NSS : {{$sekolah->nss}} <br>
        Alamat : {{$sekolah->alamat}} <br>
        Telepon : {{$sekolah->Telepon}} | Kode Pos : {{$sekolah->kodepos}} <br>
        Email : {{$sekolah->email}}
      </p>
    </div>
    <div class="footer">
      <i>{{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>i</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 2 Identitas Sekolah -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>IDENTITAS SEKOLAH</strong></h2>
    </div>
    <div style="padding-top: 15px;   font-size: 15px;">
      <table>
        <tr>
          <td style="width: 20%;">Nama Sekolah</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->name}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">NPSN</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->npsn}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">NIS/NSS/NDS</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->nss}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Alamat</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->alamat}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Kode Pos</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->kodepos}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Website</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">http://{{$sekolah->website}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Email</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->email}}</td>
        </tr>
        <tr style="line-height: 30px;">
          <td style="width: 20%;">Telepon</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">{{$sekolah->telepon}}</td>
        </tr>
      </table>
    </div>
    <div class="footer">
      <i>{{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>ii</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 3 Identitas Peserta Didik -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>KETERANGAN TENTANG DIRI PESERTA DIDIK</strong></h2>
    </div>
    <div style="padding-top: 15px; font-size: 15px;">
      <table>
        <tr>
          <td style="width: 4%;">1</td>
          <td style="width: 25%;">Nama Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->name}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">2</td>
          <td style="width: 25%;">Nomor Induk / NISN</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->nis}} / {{$siswa->nisn}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">3</td>
          <td style="width: 25%;">Tempat, Tanggal Lahir</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->tempatlahir}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->tanggallahir, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">4</td>
          <td style="width: 25%;">Jenis Kelamin</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($siswa->jk == 'L')
            Laki-Laki
            @else
            Perempuan
            @endif
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">5</td>
          <td style="width: 25%;">Agama</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($siswa->agama == 1)
            Islam
            @elseif($siswa->agama == 2)
            Protestan
            @elseif($siswa->agama == 3)
            Katolik
            @elseif($siswa->agama == 4)
            Hindu
            @elseif($siswa->agama == 5)
            Budha
            @elseif($siswa->agama == 6)
            Khonghucu
            @elseif($siswa->agama == 7)
            Kepercayaan
            @endif
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">6</td>
          <td style="width: 25%;">Status Dalam Keluarga</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($siswa->statusdalamkeluarga == 1)
            Anak Kandung
            @elseif($siswa->statusdalamkeluarga == 2)
            Anak Angkat
            @elseif($siswa->statusdalamkeluarga == 3)
            Anak Tiri
            @endif
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">7</td>
          <td style="width: 25%;">Anak Ke</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->anak_ke}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">8</td>
          <td style="width: 25%;">Alamat Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->alamat}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">9</td>
          <td style="width: 25%;">Nomor HP</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->telepon}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">10</td>
          <td style="width: 25%;">Diterima di sekolah ini</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">Di Kelas</td>
          <td style="width: 2%;">:</td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">Pada Tanggal</td>
          <td style="width: 2%;">:</td>
          <td>{{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->diterimapada, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">Sebagai</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($siswa->jenispendaftaran == 1)
            Siswa Baru
            @elseif($siswa->jenispendaftaran == 2)
            Pindahan
            @endif
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">11</td>
          <td style="width: 25%;">Nama Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namaayah}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namaibu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">12</td>
          <td style="width: 25%;">Pekerjaan Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->pekerjaanayah}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 25%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->pekerjaanibu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">13</td>
          <td style="width: 25%;">Nama Wali Siswa</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namawali}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">14</td>
          <td style="width: 25%;">Pekerjaan Wali Siswa</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->pekerjaanwali}}</td>
        </tr>
      </table>
      <table style="padding-top: 30px;">
        <tr>
          <td style="width: 38%;"></td>
          <td style="width: 22%;">
            <div style="border: 1px solid #333; width: 25mm; height: 35mm; text-align: center; font-size: 12px;">
              <br><br><br>
              Foto Siswa <br>
              3x4
            </div>
          </td>
          <td style="width: 40%; font-size: 15px;">
            {{-- @if(!is_null($siswa->kelas->tapel->k13_tgl_raport))
            {{$siswa->kelas->tapel->tempat_penerbitan}},
            @endif --}}
            {{$bagiraport->tempatbagiraport ?? 'Tempat'}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($bagiraport->tanggalbagiraport, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>{{$sekolah->kepsek}}</u></b><br>
            NIP. {{$sekolah->nipkepsek}}
          </td>
        </tr>
      </table>
    </div>
    <div class="footer">
      <i>{{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>iii</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  {{-- Page 4 Sikap --}}
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->name}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$siswa->kelas->name}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($siswa->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$siswa->name}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$siswa->nis}} / {{$siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <h3><strong>PENCAPAIAN KOMPETENSI PESERTA DIDIK</strong></h3>
      <table cellspacing="0">
        <tr>
          <td colspan="2"><strong>A. SIKAP</strong></td>
        </tr>

        <tr>
          <td colspan="2" style="height: 30px;"><strong>1. Sikap Spiritual</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 20%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <tr class="sikap">
          @if($nilai_spiritual)
          <td class="predikat">
            @if($nilai_spiritual->predikat == 'A')
            <b>Sangat Baik</b>
            @elseif($nilai_spiritual->predikat == 'B')
            <b>Baik</b>
            @elseif($nilai_spiritual->predikat == 'C')
            <b>Cukup</b>
            @elseif($nilai_spiritual->predikat == 'D')
            <b>Kurang</b>
            @endif
          </td>
          <td class="description">
            <span>{!! nl2br($nilai_spiritual->deskripsi) !!}</span>
          </td>
          @else
          <td></td>
          <td></td>
          @endif
        </tr>

        <tr>
          <td colspan="2" style="height: 30px;"><strong>2. Sikap Sosial</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 20%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>
        <tr class="sikap">
          @if(!is_null($nilai_sosial))
          <td class="predikat">
            @if($nilai_sosial->predikat == 'A')
            <b>Sangat Baik</b>
            @elseif($nilai_sosial->predikat == 'B')
            <b>Baik</b>
            @elseif($nilai_sosial->predikat == 'C')
            <b>Cukup</b>
            @elseif($nilai_sosial->predikat == 'D')
            <b>Kurang</b>
            @endif
          </td>
          <td class="description">
            <span>{{ $nilai_sosial->deskripsi }}</span>
          </td>
          @else
          <td></td>
          <td></td>
          @endif
        </tr>
      </table>
    </div>

    <div style="padding-left:60%; padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      {{$bagiraport->tempatbagiraport ?? 'Tempat'}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($bagiraport->tanggalbagiraport, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
      Wali Kelas, <br><br><br><br>
      <b><u>{{$siswa->kelas->guru->name}}, {{$siswa->kelas->guru->gelar}}</u></b><br>
      NIP. {{$siswa->kelas->guru->nip}}
    </div>
    <div class="footer">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 1</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 2 Nilai Akhir  -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->name}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$siswa->kelas->name}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($siswa->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$siswa->name}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$siswa->nis}} / {{$siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table cellspacing="0">
        <tr>
          <td colspan="6" style="height: 30px;"><strong>B. NILAI PEMBELAJARAN</strong></td>
        </tr>
        <tr class="heading">
          <td rowspan="2" style="width: 5%;">NO</td>
          <td rowspan="2" style="width: 23%;">Mata Pelajaran</td>
          <td rowspan="2" style="width: 7%;">KKM</td>
          <td colspan="3">Nilai Akhir</td>
        </tr>
        <tr class="heading">
          <td style="width: 6%;">Nilai</td>
          <td style="width: 7%;">Predikat</td>
          <td>Deskripsi</td>
        </tr>

        <!-- Nilai A  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok A</strong></td>
        </tr>

        <?php $no = 0; ?>
        @foreach($nilaiakhirs as $nilaiakhir)
        @if($nilaiakhir->pembelajaran->mapel->kelompok == 'A')
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilaiakhir->pembelajaran->mapel->name}}</td>
          <td class="center">{{$nilaiakhir->pembelajaran->kkm}}</td>
          <td class="center">{{$nilaiakhir->rata_rata}}</td>
          <td class="center">
          @if ($nilaiakhir->rata_rata >= 90)
            A
          @elseif ($nilaiakhir->rata_rata >= 80)
            B
          @elseif ($nilaiakhir->rata_rata >= 70)
            C
          @elseif ($nilaiakhir->rata_rata <= 69 )
            A
          @endif
        </td>
          <td class="description">
            <span>{!! nl2br($nilaiakhir->deskripsi) !!}</span>
          </td>
        </tr>
        @endif
        @endforeach

        <!-- Nilai B  -->
        <tr class="nilai">
          <td colspan="6"><strong>Kelompok B</strong></td>
        </tr>

        <?php $no = 0; ?>
        @foreach($nilaiakhirs as $nilaiakhir)
        @if($nilaiakhir->pembelajaran->mapel->kelompok == 'B')
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>{{$nilaiakhir->pembelajaran->mapel->name}}</td>
          <td class="center">{{$nilaiakhir->pembelajaran->kkm}}</td>
          <td class="center">{{$nilaiakhir->rata_rata}}</td>
          <td class="center">
            @if ($nilaiakhir->rata_rata >= 90)
            A
          @elseif ($nilaiakhir->rata_rata >= 80)
            B
          @elseif ($nilaiakhir->rata_rata >= 70)
            C
          @elseif ($nilaiakhir->rata_rata <= 69 )
            A
          @endif
          </td>
          <td class="description">
            <span>{!! nl2br($nilaiakhir->deskripsi) !!}</span>
          </td>
        </tr>
        @endif
        @endforeach



      </table>
    </div>

    <div style="padding-left:60%; padding-top:1rem; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;">
      {{$bagiraport->tempatbagiraport ?? 'Tempat'}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($bagiraport->tanggalbagiraport, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
      Wali Kelas, <br><br><br><br>
      <b><u>{{$siswa->kelas->guru->name}}, {{$siswa->kelas->guru->gelar}}</u></b><br>
      NIP. {{$siswa->kelas->guru->nip}}
    </div>
    <div class="footer">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 2</i></b>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 4 (Other) -->
  <div class="invoice-box">
    <div class="header">
      <table>
        <tr>
          <td style="width: 19%;">Nama Sekolah</td>
          <td style="width: 52%;">: {{$sekolah->name}}</td>
          <td style="width: 16%;">Kelas</td>
          <td style="width: 13%;">: {{$siswa->kelas->name}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Alamat</td>
          <td style="width: 52%;">: {{$sekolah->alamat}}</td>
          <td style="width: 16%;">Semester</td>
          <td style="width: 13%;">:
            @if($siswa->kelas->tapel->semester == 1)
            1 (Ganjil)
            @else
            2 (Genap)
            @endif
          </td>
        </tr>
        <tr>
          <td style="width: 19%;">Nama Peserta Didik</td>
          <td style="width: 52%;">: {{$siswa->name}} </td>
          <td style="width: 16%;">Tahun Pelajaran</td>
          <td style="width: 13%;">: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
        <tr>
          <td style="width: 19%;">Nomor Induk/NISN</td>
          <td style="width: 52%;">: {{$siswa->nis}} / {{$siswa->nisn}} </td>
        </tr>
      </table>
    </div>

    <div class="content">
      <table cellspacing="0">

        <!-- Ekskul -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>C. EKSTRAKURIKULER</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 5%;">NO</td>
          <td style="width: 28%;">Kegiatan Ekstrakurikuler</td>
          <td colspan="2">Predikat</td>
        </tr>
        @if(count($anggotaekskul) == 0)
        <tr class="nilai">
          <td class="center">1</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @elseif(count($anggotaekskul) == 1)
        <?php $no = 0; ?>
        @foreach($anggotaekskul as $item)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            {{$item->ekstrakurikuler->name}}
          </td>
          <td colspan="2" class="description">
            <span>
              @if($item->predikat == 'A')
              Sangat Baik
              @elseif($item->predikat == 'B')
              Baik
              @elseif($item->predikat == 'C')
              Cukup
              @elseif($item->predikat == 'D')
              Kurang
              @endif
            </span>
          </td>
        </tr>
        @endforeach
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @else
        <?php $no = 0; ?>
        @foreach($anggotaekskul as $item)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            {{$item->ekstrakurikuler->name}}
          </td>
          <td colspan="2" class="description">
            <span>
              @if($item->predikat == 'A')
              Sangat Baik
              @elseif($item->predikat == 'B')
              Baik
              @elseif($item->predikat == 'C')
              Cukup
              @elseif($item->predikat == 'D')
              Kurang
              @endif
            </span>
          </td>
        </tr>
        @endforeach
        @endif
        <!-- End Ekskul -->

        <!-- Prestasi -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>D. PRESTASI</strong></td>
        </tr>
        <tr class="heading">
          <td style="width: 5%;">NO</td>
          <td style="width: 28%;">Jenis Prestasi</td>
          <td colspan="2">Keterangan</td>
        </tr>
        @if(count($prestasisiswa) == 0)
        <tr class="nilai">
          <td class="center">1</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @elseif(count($prestasisiswa) == 1)
        <?php $no = 0; ?>
        @foreach($prestasisiswa as $prestasi)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            @if($prestasi->jenis == 1)
            Akademik
            @elseif($prestasi->jenis == 2)
            Non Akademik
            @endif
          </td>
          <td colspan="2" class="description">
            <span>{!! nl2br($prestasi->keterangan) !!}</span>
          </td>
        </tr>
        @endforeach
        <tr class="nilai">
          <td class="center">2</td>
          <td></td>
          <td colspan="2" class="description">
            <span></span>
          </td>
        </tr>
        @else
        <?php $no = 0; ?>
        @foreach($prestasisiswa as $prestasi)
        <?php $no++; ?>
        <tr class="nilai">
          <td class="center">{{$no}}</td>
          <td>
            @if($prestasi->jenis == 1)
            Akademik
            @elseif($prestasi->jenis == 2)
            Non Akademik
            @endif
          </td>
          <td colspan="2" class="description">
            <span>{!! nl2br($prestasi->keterangan) !!}</span>
          </td>
        </tr>
        @endforeach
        @endif
        <!-- End Prestasi -->

        <!-- Ketidakhadiran  -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>E. KETIDAKHADIRAN</strong></td>
        </tr>
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
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>F. CATATAN WALI KELAS</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 50px;">
            @if(!is_null($catatan_wali_kelas))
            <i><b>{{$catatan_wali_kelas->catatan}}</b></i>
            @endif
          </td>
        </tr>
        <!-- End Catatan Wali Kelas -->

        <!-- Tanggapan ORANG TUA/WALI -->
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>G. TANGGAPAN ORANG TUA/WALI</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 45px;">
          </td>
        </tr>
        <!-- End Tanggapan ORANG TUA/WALI -->

        <!-- Keputusan -->
        @if($siswa->kelas->tapel->semester == 2)
        <tr>
          <td colspan="4" style="height: 25px; padding-top: 5px"><strong>H. KEPUTUSAN</strong></td>
        </tr>
        <tr class="sikap">
          <td colspan="4" class="description" style="height: 45px;">
            @if ($siswa->kelas->tingkat != 9)
            Berdasarkan hasil yang dicapai pada semester 1 dan 2, Peserta didik ditetapkan : <br>
            <b>
              @if($siswa->kelas->tingkat == 7)
              TINGGAL DI KELAS 7 (TUJUH) / NAIK KE KELAS 8 (DELAPAN)
              @elseif ($siswa->kelas->tingkat == 8)
              TINGGAL DI KELAS 8 (DELAPAN) / NAIK KE KELAS 9 (SEMBILAN)
              @else
              LULUS / TIDAK LULUS
              @endif
            </b>
            @elseif($siswa->kelas->tingkat == 9)
            Berdasarkan hasil yang dicapai pada semester 1 sampai 6, Peserta didik ditetapkan : <br>
            <b>
              LULUS / TIDAK LULUS
            </b>
            @endif

          </td>
        </tr>
        @endif
        <!-- End Keputusan -->

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
        {{$bagiraport->tempatbagiraport ?? 'Tempat'}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($bagiraport->tanggalbagiraport, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
            Wali Kelas, <br><br><br><br>
            <b><u>{{$siswa->kelas->guru->name}}, {{$siswa->kelas->guru->gelar}}</u></b><br>
            NIP. {{$siswa->kelas->guru->nip}}
          </td>
        </tr>
        <tr>
          <td style="width: 30%;"></td>
          <td style="width: 35%;">
            Mengetahui <br>
            Kepala Sekolah, <br><br><br><br>
            <b><u>{{$sekolah->kepsek}}</u></b><br>
            NIP. {{$sekolah->nipkepsek}}
          </td>
          <td style="width: 35%;"></td>
        </tr>
      </table>
    </div>
    <div class="footer">
      <i>{{$siswa->kelas->nama_kelas}} | {{$siswa->nama_lengkap}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 3</i></b>
    </div>
  </div>

</body>

</html>
