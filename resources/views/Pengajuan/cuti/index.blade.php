@extends('layouts.admin.app')
@section('body')
 <!-- konten mulai -->
 <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container ">
                <div class="kt-subheader__main">
                    <button class="kt-subheader__mobile-toggle" id="kt_subheader_mobile_toggle"><span></span></button>
                    <h3 class="kt-subheader__title">LAPORAN CUTI PEGAWAI</h3>
                    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                    <span class="kt-subheader__desc">POLRI DAN PNS</span>
                </div>
            </div>
        </div>
        <!-- end:: Content Head -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <!-- <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span> -->
                        <h3 class="kt-portlet__head-title">
                            DATA PEGAWAI CUTI
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                    <!-- &nbsp; -->
                                    <!-- <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                                        <i class="la la-plus"></i>
                                        New Record -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped table-bordered dt-responsive nowrap display" style="width:100%">
                                <thead>
                                        <tr>
                                                <th>No</th>
                                                <th>NIP / NRP</th>
                                                <th>Jenis Cuti</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>

                                        </tr>
                                    </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                    $sekarang=date("Y-m-d");
                                                @endphp
                                                @if (!empty($data))
                                                    @foreach ($data as $item)
                                                    @if (strtotime($item->tgl_selesai) !== strtotime($sekarang))
                                                        <tr>
                                                            <td>{{$no++}}</td>
                                                            <td>{{$item->nip_nrp}}</td>
                                                            <td>{{$item->jenis_cuti->nama_cuti}}</td>
                                                            <td>{{$item->tgl_mulai}}</td>
                                                            <td>{{$item->tgl_selesai}}</td>
                                                            <td>{{$item->keterangan}}</td>
                                                        </tr>
                                                    @endif

                                                    @endforeach
                                                @endif

                                            </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <!-- end:: Content -->
        <!-- begin:: Content dATA CUTI BARU-->
        <div class="kt-container  kt-grid__item kt-grid__item--fluid">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <!-- <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span> -->
                        <h3 class="kt-portlet__head-title">
                            DATA PEGAWAI MENGAJUKAN CUTI
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <!-- &nbsp; -->
                                <!-- <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    New Record -->
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#cutitmbh">(+)tambah</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped table-bordered dt-responsive nowrap display" style="width:100%">
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP / NRP</th>
                                            <th>Jenis Cuti</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                    @foreach ($P_cuti as $cuti)
                                                        <tr>
                                                                <td>{{$no++}}</td>
                                                                <td>{{$cuti->nip_nrp}}</td>
                                                                <td>{{$cuti->jenis_cuti->nama_cuti}}</td>
                                                                <td>{{$cuti->tgl_mulai}}</td>
                                                                <td>{{$cuti->tgl_selesai}}</td>
                                                                <td>{{$cuti->keterangan}}</td>

                                                                <td>
                                                                    @if ($cuti->status == 0)
                                                                        <p>Pending</p>
                                                                    @endif
                                                                </td>
                                                                <td>{{$cuti->jumlah}}</td>
                                                                <td class="text-center">
                                                                <form action="{{route('P_cuti.update',$cuti->nip_nrp)}}" method="post">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" value="{{$cuti->id}}" name="id">
                                                                    <input type="hidden" value="{{$cuti->id_jenis_cuti}}" name="jenis_cuti">
                                                                    <button class="badge badge-success">acc</button>
                                                                </form>
                                                                {{-- <a class="badge badge-success" href="{{route('P_cuti',$cuti->nip_nrp)}}"  title="ACC"><span class="fas fa-fw fa-edit"></span></a>
                                                                        <a class="badge badge-danger" href="#modal-hapus" data-toggle="modal" title="Hapus"><span class="fas fa-fw fa-trash"></span></a>
                                                                </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
                 <!-- modal cuti -->
<div class="modal fade" id="cutitmbh" tabindex="-1" role="dialog" aria-labelledby="jdlcuti" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlcuti">Tambah Data Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('P_cuti.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nip" class="form-control-label">NIP / NRP</label>
                        <select class="form-control" id="kt_select2_1" name="nip_nrp">
                                <option value="">select Pegawai</option>
                                @foreach ($pegawais as $pegawai)
                                    <option  value="{{$pegawai->nip_nrp}}" class="form-control">{{$pegawai->nama_pegawai}}</option>
                                @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert">
                                <strong>alert</strong></span>
                    </div>
                    <div class="form-group">
                            <label for="message-text" class="form-control-label">Jenis Cuti</label>
                            <select name="id_jenis_cuti" id="" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($jenis_cuti as $jenis)
                                    <option value="{{$jenis->id}}" class="form-control">{{$jenis->nama_cuti}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="message-text" class="form-control-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tgl_mulai" id="message-text">
                    </div>
                    <div class="form-group">
                            <label for="message-text" class="form-control-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tgl_selesai" id="message-text">
                    </div>
                    <div class="form-group">
                            <label for="message-text" class="form-control-label">Keterangn</label>
                            <input type="text" class="form-control" name="keterangan" id="message-text">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- selesai -->
            </div>
        </div>
        <!-- end:: Content -->
    </div>
</div>
<!-- selesai -->
@endsection
@section('asset-buttom')

<script>

    //     var table = $('table.display').DataTable({
    //         responsive: true,
    //         searching : false,
    //         paging:false,
    //         ordering: false,
    //         info: false
    //     });

    </script>
    <script src="{{ asset('template/assets/js/pages/crud/forms/widgets/select2.js')}}" type="text/javascript"></script>
@endsection
