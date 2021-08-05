@extends('layouts.app')

@section('content_header')
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Vidio</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{$vidio->link}}">{{ $vidio->link }}</a>
                        <button type="button" class="btn btn-sm btn-outline-danger float-right" data-toggle="modal" data-target="#ganti">Ganti</button>
                        <br>
                        <br>
                        <br>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ Str::of($vidio->link)->afterLast('watch?v=') }}" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="ganti">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ganti Vidio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vidio.update', 1) }}" method="POST">
                    @csrf
                    <label>Link Youtube</label>
                    <input type="hidden" class="form-control" value="PUT" name="_method">
                    <input type="hidden" class="form-control" value="{{ csrf_token() }}" name="_token">
                    <input type="text" class="form-control" placeholder="{{ $vidio->link }}" name="link">
                    <br>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
@endsection