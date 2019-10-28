<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .p_umum{
        margin-left: 20px;
    }
    .p{
        font-weight: bold
    }
</style>
@if (auth::user()->jenis_pegawai =="PNS")
<center>
    <h5>RIWAYAT HIDUP</h4>
</center>
<table>
        <tr>
            <th>Data Pribadi</th>
            <td></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{$user->nama_pegawai}}</td>


        </tr>
        <tr>
          <td>Jenis_kelamin</td>
          <td>:</td>
            <td>@if ($user->jk =='P')
                Perempuan
                @elseif($user->jk =='L')
                Laki-lakir
                 @endif

            </td>
        </tr>
        <tr>
          <td>Tempat Tanggal Lahir</td>
          <td>:</td>
          <td>{{$user->tempat_lahir.','.$user->tanggal_lahir}}</td>
        </tr>
        <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>
                    @if (!empty($biodata))
                    {{$biodata->status_menikah}}
                    @endif</td>
        </tr>
        <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{$user->agama}}</td>
        </tr>
        <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{$user->alamat}}</td>
        </tr>
        <tr>
                <td>No Handphone</td>
                <td>:</td>
                <td>{{$user->no_hp}}</td>
        </tr>
        <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{$user->email}}</td>
        </tr>
      </table>
      {{--  --}}

@else{
<body>
	<center>
		<h5>DAFTAR RIWAYAT HIDUP</h4>
	</center>
    <table>
            <tr>
                <th>Data Pribadi</th>
                <td></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{$user->nama_pegawai}}</td>


            </tr>
            <tr>
              <td>Jenis_kelamin</td>
              <td>:</td>
                <td>@if ($user->jk =='P')
                    Perempuan
                    @elseif($user->jk =='L')
                    Laki-lakir
                     @endif

                </td>
            </tr>
            <tr>
              <td>Tempat Tanggal Lahir</td>
              <td>:</td>
              <td>{{$user->tempat_lahir.','.$user->tanggal_lahir}}</td>
            </tr>
            <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td>
                        @if (!empty($biodata))
                        {{$biodata->status_menikah}}
                        @endif</td>
            </tr>
            <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td>{{$user->agama}}</td>
            </tr>
            <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$user->alamat}}</td>
            </tr>
            <tr>
                    <td>No Handphone</td>
                    <td>:</td>
                    <td>{{$user->no_hp}}</td>
            </tr>
            <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{$user->email}}</td>
            </tr>
          </table>
          {{--  --}}
          <p class="p" >DATA PENDIDIKAN</p>
          <table class="p_umum">
            <tr>
                    <th>1.Pendidikan Umum</th>
                    <td></td>
            </tr>
              @for ($x=0;$x<count($p_umum);$x++)
                @php
                        $alpha=['a','b','c'.'d','e','f','g'];
                @endphp
              <tr>
                    <td>{{$alpha[$x].'. tahun '.$p_umum[$x]['tahun_lulus']}}</td>
                    <td>:</td>
                    <td>{{$p_umum[$x]['nama_sekolah']}}</td>
              </tr>

              @endfor
          </table>
          {{--  --}}
          <table class="p_umum">
            <tr>
                    <th>2.Pendidikan Non Formal</th>
                    <td></td>
            </tr>
              @for ($x=0;$x<count($p_non_formal);$x++)
                @php
                        $alpha=['a','b','c'.'d','e','f','g'];
                @endphp
              <tr>
                    <td>{{$alpha[$x].'. tahun '.$p_non_formal[$x]['tahun_pendidikan']}}</td>
                    <td>:</td>
                    <td>{{$p_non_formal[$x]['nama_pendidikan']}}</td>
              </tr>

              @endfor
          </table>
          <p class="p" >Bahasa</p>
          <table class="p_umum">
            <tr>
                    <th>1.Daerah</th>
                    <td></td>
            </tr>
              @for ($x=0;$x<count($bahasa);$x++)
                @php
                        $alpha=['a','b','c'.'d','e','f','g'];
                @endphp
              <tr>
                    <td>{{$bahasa[$x]['jenis_bahasa']}}</td>
                    <td>:</td>
                    <td>{{$bahasa[$x]['nama_bahasa']}}</td>
              </tr>

              @endfor
          </table>

          {{--  --}}
          {{-- <table class="p_umum">
                <tr>
                        <th>3.Pendidikan Polri</th>
                        <td></td>
                </tr>
                  @for ($x=0;$x<count($p_polri);$x++)
                    @php
                            $alpha=['a','b','c'.'d','e','f','g'];
                    @endphp
                  <tr>
                        <td>{{$alpha[$x].'. tahun '.$p_polri[$x]['tahun']}}</td>
                        <td>:</td>
                        <td>{{$p_polri[$x]['nama_pendidikan']}}</td>
                  </tr>

                  @endfor
            </table> --}}
            {{--  --}}
            <p class="p" >Data Polri</p>
            <table class="p_umum">
              <tr>
                      <th>1.Riwayat Kepangkatan</th>
                      <td></td>
              </tr>
              @php

              @endphp
              @foreach($r_pangkat as $p)
                  @php
                          $alpha=['a','b','c'.'d','e','f','g'];
                          $i=0;
                  @endphp
                <tr>
                      <td>{{'* tahun '.$p->tmt}}</td>
                      <td>:</td>
                      <td>{{$p->Pangkat->nama_pangkat}}</td>
                </tr>
                @php
                    $i++;
                @endphp

                @endforeach
            </table>
            <table class="p_umum">
                    <tr>
                            <th>2.Riwayat Jabatan</th>
                            <td></td>
                    </tr>
                    @php
                    @endphp
                    @foreach($r_jabatan as $jabatan)
                        @php
                                $alpha=['a','b','c'.'d','e','f','g'];
                                $i=0;
                        @endphp
                      <tr>
                            <td>{{'* tahun '.$jabatan->tgl_mulai_terhitung}}</td>
                            <td>:</td>
                            <td>{{$jabatan->Jabatan->nama_jabatan}}</td>
                      </tr>
                      @php
                          $i++;
                      @endphp

                      @endforeach

                  </table>

	{{-- <table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($biodata as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->status_menikah}}</td>
				<td>{{$p->no_kk}}</td>
				<td>{{$p->hobi}}</td>
				<td>{{$p->no_tlp}}</td>
				<td>{{$p->tinggi_badan}}</td>
				<td>{{$p->warna_rambut}}</td>
				<td>{{$p->bentuk_muka}}</td>
				<td>{{$p->warna_kulit}}</td>
				<td>{{$p->ciri_khas}}</td>
				<td>{{$p->cacat_tubuh}}</td>
			</tr>
            @endforeach
            @foreach($user as $u)
			<tr>
                <td>{{ $i++ }}</td>
                <td>{{$u->nip_nrp}}</td>
				<td>{{$u->nama_pegawai}}</td>
				<td>{{$u->jenis_pegawai}}</td>
				<td>{{$u->nidn}}</td>
				<td>{{$u->no_kta_pegawai}}</td>
				<td>{{$u->no_kep_jabatan}}</td>
				<td>{{$u->Pangkat->nama_pangkat}}</td>
                <td>{{$u->Jabatan->nama_jabatan}}</td>
                <td>{{$u->email}}</td>
                <td>{{$u->alamat}}</td>
                <td>{{$u->tempat_lahir}}</td>
                <td>{{$u->tanggal_lahir}}</td>
                <td>{{$u->jk}}</td>
                <td>{{$u->agama}}</td>
                <td>{{$u->no_hp}}</td>
                <td>{{$u->nik}}</td>
                <td>{{$u->tgl_masuk}}</td>



			</tr>
			@endforeach
		</tbody>
	</table> --}}

</body>
}
@endif
</html>
