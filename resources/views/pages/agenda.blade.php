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
                <!-- general form elements -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Agenda</h3>
                        <button type="button" class="btn btn-sm btn-outline-danger float-right" data-toggle="modal" data-target="#tambah-agenda">Tambah</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display table-sm" id="tiket">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nama Agenda</th>
                                        <th>Lokasi</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agenda as $a)
                                    <tr data-toggle="modal" data-target="#edit-agenda{{$a->id}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $a->nama }}</td>
                                        <td>{{ $a->tempat }}</td>
                                        <td>{{ $a->waktu }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    <label>Nama Agenda</label>
                    <input type="text" class="form-control" name="nama">
                    <br>
                    <label>Tempat</label>
                    <input type="text" class="form-control" name="tempat">
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tgl">
                        </div>
                        <div class="col-sm-6">
                            <label>Waktu</label>
                            <input type="time" class="form-control" name="jam">
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
                <h4 class="modal-title">Tambah Agenda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agenda.update',$e->id) }}" method="POST">
                    @csrf
                    <label>Nama Agenda</label>
                    <input type="hidden" class="form-control" value="PUT" name="_method">
                    <input type="hidden" class="form-control" value="{{ csrf_token() }}" name="_token">
                    <input type="text" class="form-control" value="{{ $e->nama }}" name="nama">
                    <br>
                    <label>Tempat</label>
                    <input type="text" class="form-control" value="{{ $e->tempat }}" name="tempat">
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{ Str::beforeLast($e->waktu, ' ') }}" name="tgl">
                        </div>
                        <div class="col-sm-6">
                            <label>Waktu</label>
                            <input type="time" class="form-control" value="{{ Str::of($e->waktu)->afterLast(' ') }}" name="jam">
                        </div>
                    </div>
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
    $("#tiket").dataTable();
</script>
@endsection
