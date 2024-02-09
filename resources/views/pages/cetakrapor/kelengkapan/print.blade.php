<!DOCTYPE html>
<html>

@php
  use Carbon\Carbon;
@endphp

<head>
  <meta charset="utf-8" />
  <title>KELENGKAPAN RAPOR | {{$siswa->name}} ({{$siswa->nis}})</title>
  <link href="./cetakraport/invoice_raport.css" rel="stylesheet">
</head>

<body>
  <!-- Page 1 Sampul -->
  <div class="invoice-box">
    <div class="content">
      <div style="text-align: center; padding-bottom: 10px;">
        <img src="./img/{{ $sekolah->logo ?? 'logosekolah.png' }}" alt="Logo" height="160px">
      </div>
      <h1><strong>RAPOR</strong></h1>
      <h1><strong>{{ $sekolah->name }}</strong></h1>
    </div>
    <div style="text-align: center; padding-top: 150px;">
      <h3>NAMA PESERTA DIDIK</h3>
      <table>
        <tr>
          <td style="width: 15%;"></td>
          <td style="width: 70%; border: 1px solid #333; height: 35px; text-align: center; font-size: 16px; text-transform: uppercase;"><b>{{$siswa->name}}</b></td>
          <td style="width: 15%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 25px;">
      <h3>NISN / NIS</h3>
      <table>
        <tr>
          <td style="width: 20%;"></td>
          <td style="width: 60%; border: 1px solid #333; height: 35px; text-align: center; font-size: 16px;"><b>{{$siswa->nisn}} / {{$siswa->nis}}</b></td>
          <td style="width: 20%;"></td>
        </tr>
      </table>
    </div>
    <div style="text-align: center; padding-top: 140px;">
      <h2><strong>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN</strong></h2>
      <h2><strong>RISET, DAN TEKNOLOGI</strong></h2>
      <h2><strong>REPUBLIK INDONESIA</strong></h2>
    </div>
  </div>
  <div class="page-break"></div>

  <!-- Page 2 Identitas Sekolah -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>RAPOR</strong></h2>
      <h2><strong>{{ $sekolah->name }}</strong></h2>
    </div>
    <div style="padding-top: 15px; font-size: 16px;">
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
          <td style="width: 20%;">Alamat Sekolah</td>
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
  </div>
  <div class="page-break"></div>

  <!-- Page 3 Identitas Peserta Didik -->
  <div class="invoice-box">
    <div style="text-align: center;">
      <h2><strong>IDENTITAS PESERTA DIDIK</strong></h2>
    </div>
    <div style="padding-top: 15px; font-size: 16px;">
      <table>
        <tr>
          <td style="width: 4%;">1.</td>
          <td style="width: 35%;">Nama Lengkap Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->name}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">2.</td>
          <td style="width: 35%;">Nomor Induk/NISN</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->nis}} / {{$siswa->nisn}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">3.</td>
          <td style="width: 35%;">Tempat, Tanggal Lahir</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->tempatlahir}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->tanggallahir, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">4.</td>
          <td style="width: 35%;">Jenis Kelamin</td>
          <td style="width: 2%;">:</td>
          <td>
           {{ $siswa->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">5.</td>
          <td style="width: 35%;">Agama</td>
          <td style="width: 2%;">:</td>
          <td>{{ $siswa->agama }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">6.</td>
          <td style="width: 35%;">Status Dalam Keluarga</td>
          <td style="width: 2%;">:</td>
          <td>
            @if($siswa->statusdalamkeluarga == 'AK')
              Anak Kandung
            @elseif($siswa->statusdalamkeluarga == 'AA')
              Anak Angkat
            @elseif($siswa->statusdalamkeluarga == 'AT')
              Anak Tiri
            @endif
          </td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">7.</td>
          <td style="width: 35%;">Anak Ke</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->anak_ke}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">8.</td>
          <td style="width: 35%;">Alamat Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->alamat}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">9.</td>
          <td style="width: 35%;">Nomor Telepon</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->teleponortu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">10.</td>
          <td style="width: 35%;">Sekolah Asal</td>
          <td style="width: 2%;">:</td>
          <td>{{ $siswa->sekolahasal }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">11.</td>
          <td style="width: 35%;">Diterima di sekolah ini</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">Di Kelas</td>
          <td style="width: 2%;">:</td>
          <td>{{ $siswa->diterimadikelas }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">Pada Tanggal</td>
          <td style="width: 2%;">:</td>
          <td>{{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->diterimaditanggal, ' '))->locale('id')->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">12.</td>
          <td style="width: 35%;">Nama Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namaayah}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namaibu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">13.</td>
          <td style="width: 35%;">Alamat Orang Tua</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->alamatortu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">Nomor Telepon Rumah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->teleponortu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">14.</td>
          <td style="width: 35%;">Pekerjaan Orang Tua</td>
          <td style="width: 2%;"></td>
          <td></td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">a. Ayah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->pekerjaanayah}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">b. Ibu</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->pekerjaanibu}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">15.</td>
          <td style="width: 35%;">Nama Wali Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->namawali}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">16.</td>
          <td style="width: 35%;">Alamat Wali Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->alamatwali}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;"></td>
          <td style="width: 35%;">Nomor Telepon Rumah</td>
          <td style="width: 2%;">:</td>
          <td>{{$siswa->teleponwali}}</td>
        </tr>
        <tr style="line-height: 25px;">
          <td style="width: 4%;">17.</td>
          <td style="width: 35%;">Pekerjaan Wali Peserta Didik</td>
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
              Foto Peserta Didik <br>
              3x4
            </div>
          </td>
          <td style="width: 40%; font-size: 16px;">
            {{$siswa->kelas->tapel->tempat}}, {{ Carbon::createFromFormat('Y-m-d', Str::before($siswa->diterimaditanggal, ' '))->locale('id')->isoFormat('D MMMM YYYY') ?? 'Tanggal'}}, <br>
            Kepala {{ $sekolah->name }}, <br><br><br><br><br>
            <b><u>{{$sekolah->namakepsek}}</u></b><br>
            NIP. {{$sekolah->nipkepsek}}
          </td>
        </tr>
      </table>
    </div>
  </div>


  <div class="page-break"></div>

  {{-- KETERANGAN PINDAH SEKOLAH --}}
  <div class="invoice-box">

    <div class="" style="text-align: center">
      <h2><strong>KETERANGAN PINDAH SEKOLAH</strong></h2>
    </div>

    <div style="padding-top: 15px; font-size: 16px;">
      <table>
        <tr>
          <td style="width: 20%;">Nama Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">...................................................</td>
        </tr>
      </table>

      <br>

      <table cellspacing="0">
        <tr class="heading">
          <td colspan="4">KELUAR</td>
        </tr>
        <tr class="heading">
          <td>Tanggal</td>
          <td>Kelas yang ditinggalkan</td>
          <td>Sebab-sebab Keluar atau Atas Permintaan (Tertulis)</td>
          <td>Tanda Tangan Kepala Sekolah, Stempel Sekolah, dan Tanda Tangan Orang Tua/Wali</td>
        </tr>
        @foreach ([1,2,3,4] as $i)
          <tr class="sikap">
            <td style="width: 20%"></td>
            <td style="width: 25%"></td>
            <td style="width: 40%"></td>
            <td style="width: 35%; font-size: 16px;">
              ...................................,................. <br>
              Kepala Sekolah, <br><br><br><br><br>
              <b><u>.....................................................</u></b> <br>
              NIP.
            </td>
          </tr>
        @endforeach
      </table>
    </div>

  </div>

  <div class="page-break"></div>

  {{-- KETERANGAN PINDAH SEKOLAH --}}
  <div class="invoice-box">

    <div class="" style="text-align: center">
      <h2><strong>KETERANGAN PINDAH SEKOLAH</strong></h2>
    </div>

    <div style="padding-top: 15px; font-size: 16px;">
      <table>
        <tr>
          <td style="width: 20%;">Nama Peserta Didik</td>
          <td style="width: 2%;">:</td>
          <td style="width: 78%;">...................................................</td>
        </tr>
      </table>

      <br>

      <table cellspacing="0" style="padding: 6px; font-size: 16px;">
        <tr class="heading">
          <td style="width: 5%">NO</td>
          <td colspan="3">MASUK</td>
        </tr>
        @foreach ([1,2,3] as $item)
          <tr class="border-side">
            <td class="border-side">1.</td>
            <td class="border-side" style="width: 35%">Nama Siswa</td>
            <td class="border-side" style="width: 30%">______________________</td>
            <td style="font-size: 16px;" rowspan="7" class="border-side" style="width: 35%; padding-top: 0%">
              ...................................,............ <br>
              Kepala Sekolah, <br><br><br><br><br>
              <b><u>................................................</u></b> <br>
              NIP.
            </td>
          </tr>
          <tr class="border-side">
            <td>2.</td>
            <td>Nomor Induk</td>
            <td>______________________</td>
          </tr>
          <tr class="border-side">
            <td>3.</td>
            <td>Nama Sekolah</td>
            <td>______________________</td>
          </tr>
          <tr class="border-side">
            <td>4.</td>
            <td>Masuk di Sekolah ini:</td>
            <td></td>
          </tr>
          <tr class="border-side">
            <td></td>
            <td>a. Tanggal</td>
            <td>______________________</td>
          </tr>
          <tr class="border-side">
            <td></td>
            <td>b. Di Kelas</td>
            <td>______________________</td>
          </tr>
          <tr class="border-side" style="border-bottom: 1px solid; padding-bottom: 30px;!important">
            <td>5.</td>
            <td>Tahun Pelajaran</td>
            <td>______________________</td>
          </tr>
        @endforeach
      </table>
    </div>

  </div>

</body>

</html>
