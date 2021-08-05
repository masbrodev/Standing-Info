@extends('layouts.app')

@section('content_header')
<h1>Gambar</h1>
@stop
<!-- Upload Image Belum -->
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
                        <h3 class="card-title">Gambar</h3>
                        <button type="button" class="btn btn-sm btn-outline-danger float-right" data-toggle="modal" data-target="#tambah-gambar">Tambah</button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display table-sm" id="tiket">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($gambar as $g)
                                    <tr data-toggle="modal" data-target="#hapus-gambar{{$g->id}}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{ $g->lokasi }}" width="100" height="auto"></td>
                                        <td>{{ $g->nama }}</td>
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

<div class="modal fade" id="tambah-gambar">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Agenda</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gambar.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                        </div>
                    </div>
                    <label>Nama Agenda</label>
                    <input type="text" class="form-control" name="nama">
                    <br>
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

@foreach($gambar as $e)
<div class="modal fade" id="hapus-gambar{{$e->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Gambar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>{{ $e->nama }}</label>
                <br>
                <img src="{{ $e->lokasi }}" alt="" width="600" height="auto">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="{{ route('gambar.edit', $e->id) }}" class="btn btn-danger">Hapus</a>
            </div>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
@endforeach
@endsection
@section('adminlte_js')
<script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection