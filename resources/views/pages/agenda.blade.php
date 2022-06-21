@extends('layouts.app')

@section('content_header')
@stop

@section('content')
@section('plugins.Datatables', true)
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Tabel Rapat</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover display table-sm agenda products-list product-list-in-card pl-2 pr-2" id="agenda">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agenda as $d)
                            <tr data-toggle="modal" data-target="#edit-agenda{{$d->id}}">
                                <td>@if ($d->tempat == 'vip')
                                    <img src="logo/vip.jpg" width="80" alt="vip">
                                    @elseif ($d->tempat == 'bpk')
                                    <img src="logo/bpk.jpg" width="80" alt="vip">
                                    @elseif ($d->tempat == 'ses')
                                    <img src="logo/ses.png" width="80" alt="vip">
                                    @elseif ($d->tempat == 'on')
                                    <img src="logo/zoom.png" width="80" alt="vip">
                                    @else
                                    <img src="logo.png" width="80" alt="vip">
                                    @endif
                                </td>
                                <td>
                                    <p href="#" class="product-title">
                                    @if ($d->tempat == 'vip')
                                    Ruang Rapat VIP I Inspektorat Jenderal -  Lantai 3
                                    <hr>
                                    Gedung Utama Kementerian Desa PDTT
                                    @elseif ($d->tempat == 'bpk')
                                    Ruang Rapat Badan Pemeriksa Keuangan (BPK) Inspektorat jenderal - Lantai 4
                                    <hr>
                                    Gedung Utama Kementerian Desa PDTT
                                    @elseif ($d->tempat == 'ses')
                                    Ruang Rapat Sekretaris Inspektorat jenderal - Lantai 4
                                    <hr>
                                    Gedung Utama Kementerian Desa PDTT
                                    @elseif ($d->tempat == 'on')
                                    Rapat Via Online Tanpa Ruangan
                                    <hr>
                                    Via Aplikasi Zoom / Google Meet
                                    @else
                                    {{ $d->tempat }}
                                    @endif
                                    </p>

                                </td>
                                <td>
                                    <span class="">
                                       <b> {{ $d->nama }}</b>
                                    </span>
                                </td>
                                <td>
                                    <div class="">
                                        @if( Carbon\Carbon::now()->isoFormat('YMMDD') == Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span class="badge badge-danger float-right">Hari Ini</span></a>
                                        @elseif (Carbon\Carbon::tomorrow()->isoFormat('YMMDD') == Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span class="badge badge-primary float-right">Besok</span></a>
                                        @elseif (Carbon\Carbon::today()->isoFormat('YMMDD') > Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span class="badge badge-secondary float-right">Selesai</span></a>
                                        @else
                                        <span class="badge badge-warning float-right">Akan Datang</span></a>
                                        @endif
                                        <br>
                                        <span class="badge badge-success float-right">{{ Carbon\Carbon::parse($d->waktu)->isoFormat('H:mm') }} WIB</span>
                                        <br>
                                        <span class="badge badge-info float-right">{{ Carbon\Carbon::parse($d->waktu)->isoFormat('D MMMM Y') }}</span></a>
                                        <br>
                                        @if($d->status == 'diajukan')
                                        <span class="badge text-danger float-right"><i class="fa fa-clock"></i> {{ $d->status }}</span></a>
                                        @elseif($d->status == 'disetujui')
                                        <span class="badge float-right text-primary"><i class="fa fa-check text-primary"></i> {{ $d->status }}</span></a>
                                        @else
                                        <span class="badge text-danger float-right"><i class="fa fa-ban"></i> {{ $d->status }}</span></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<div class="modal fade" id="tambah-agenda">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Agenda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agenda.store')}}" method="post">
                    @csrf
                    <label>Nama Pemohon (Beserta Posisi Jabatan)</label>
                    <input required type="text" class="form-control" name="dari" placeholder="Adam Lewis (Staff Inspektur I)">
                    <br>
                    <label>Nama Agenda/Rapat</label>
                    <input required type="text" class="form-control" name="nama">
                    <input required type="hidden" class="form-control" name="status" value="diajukan">
                    <br>
                    <label>Kategori</label>
                    <br>
                    <select class="form-control" name="keterangan">
                        <option value="off" selected>Offline</option>
                        <option value="on">Online</option>
                        <option value="ofn">Online & Offline</option>
                    </select>
                    <br>
                    <label>Tempat</label>
                    <select class="form-control" name="tempat" id="tempat" onchange="othFunc()">
                        <option value="vip" selected>Ruang Rapat VIP I Inspektorat Jenderal - LT3</option>
                        <option value="ses">Ruang Rapat Sekretaris Inspektorat jenderal - LT4</option>
                        <option value="bpk">Ruang Rapat Badan Pemeriksa Keuangan (BPK) Inspektorat Jenderal - LT4</option>
                        <option value="on">Tanpa Ruangan (Rapat Via Online)</option>
                        <option value="oth">Ruangan Lain (isi sendiri)</option>
                    </select>
                    <br>
                    <input style="display:none" placeholder="Ruang Rapat . . . ." id="oth-text" type="text" class="form-control" name="tempat2">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Tanggal</label>
                            <input required type="date" class="form-control" name="tgl">
                        </div>
                        <div class="col-sm-4">
                            <label>Jam Rapat</label>
                            <input required type="time" class="form-control" name="jam">
                        </div>
                        <div class="col-sm-4">
                            <label>Sampai</label>
                            <input type="time" class="form-control" name="sampai">
                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Simpan</button>
            </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>

@foreach($agenda as $e)
<div class="modal fade" id="edit-agenda{{$e->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Agenda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agenda.update',$e->id) }}" method="POST">
                    @csrf
                    <label>Nama Pemohon (Beserta Posisi Jabatan)</label>
                    <input type="hidden" class="form-control" value="PUT" name="_method">
                    <input type="hidden" class="form-control" value="{{ csrf_token() }}" name="_token">
                    <input type="text" class="form-control" value="{{ $e->dari }}" name="dari">
                    <br>
                    <label>Nama Agenda/Rapat</label>
                    <input type="text" class="form-control" name="nama" value="{{ $e->nama }}">
                    <br>
                    <label>Tempat</label>
                    <select class="form-control" name="tempat" id="tempat" onchange="othFunc()">
                        <option value="vip" {{ $e->tempat == 'vip' ? 'selected' : '' }} >Ruang Rapat VIP I Inspektorat Jenderal - LT3</option>
                        <option value="ses" {{ $e->tempat == 'ses' ? 'selected' : '' }} >Ruang Rapat Sekretaris Inspektorat jenderal - LT4</option>
                        <option value="bpk" {{ $e->tempat == 'bpk' ? 'selected' : '' }} >Ruang Rapat Badan Pemeriksa Keuangan (BPK) Inspektorat Jenderal - LT4</option>
                        <option value="on" {{ $e->tempat == 'on' ? 'selected' : '' }} >Tanpa Ruangan (Rapat Via Online)</option>
                        <option value="oth" {{ $e->tempat == 'oth' ? 'selected' : '' }} >Ruangan Lain (isi sendiri)</option>
                    </select>
                    <br>
                    <input placeholder="Ruang Rapat . . . ." value="{{ $e->tempat }}" type="text" class="form-control" name="tempat2">
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{ Str::beforeLast($e->waktu, ' ') }}" name="tgl">
                        </div>
                        <div class="col-sm-4">
                            <label>Waktu</label>
                            <input type="time" class="form-control" value="{{ Str::of($e->waktu)->afterLast(' ') }}" name="jam">
                        </div>
                        <div class="col-sm-4">
                            <label>Sampai</label>
                            <input type="time" class="form-control" name="sampai" value="{{ Str::of($e->sampai)->afterLast(' ') }}">
                        </div>
                    </div>
                    <br>
                    <label>Kategori {{$e->keterangan}}</label>
                    <br>
                    <select class="form-control" name="keterangan">
                        <option value="off" {{ $e->keterangan == 'off' ? 'selected' : '' }} >Offline</option>
                        <option value="on" {{ $e->keterangan == 'on' ? 'selected' : '' }}>Online</option>
                        <option value="ofn" {{ $e->keterangan == 'ofn' ? 'selected' : '' }}>Online & Offline</option>
                    </select>
                    <br>
                    <select class="form-control" name="status">
                        <option value="diajukan" {{ $e->status == 'diajukan' ? 'selected' : '' }} >Diajukan</option>
                        <option value="disetujui" {{ $e->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $e->status == 'ofn' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <br>
                </div>
            <div class="modal-footer justify-content-between">
                <a href="{{ route('agenda.edit', $e->id) }}" class="btn btn-danger">Hapus</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
@endforeach

@endsection
@section('adminlte_js')
<script>
    $("#agenda").dataTable();
</script>
@endsection
