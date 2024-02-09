<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>CETAK RAPORT | {{$siswa->name}} ({{$siswa->nis}})</title>
  <link href="./cetakraport/invoice_raport.css" rel="stylesheet">
</head>

<body>

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
          <
          td>Nama Sekolah</>
          <td>: {{$sekolah->name}}</td>
          <td>Semester</td>
          <td>:
            {{ $siswa->kelas->tapel->semester == 1 ? '1 (Ganjil)' : '2 (Genap)'}}
          </td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>: {{$sekolah->kota ?? 'Kota'}}</td>
          <td>Tahun Pelajaran</td>
          <td>: {{$siswa->kelas->tapel->tahun_pelajaran}}</td>
        </tr>
      </table>
    </div>

    @yield('content')

    <div class="footer">
      <i>{{$siswa->kelas->name}} | {{$siswa->name}} | {{$siswa->nis}}</i> <b style="float: right;"><i>Halaman 2</i></b>
    </div>
  </div>

</body>
