@extends('layouts.app')

@section('content_header')
<h1>Gambar</h1>
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
                        <h3 class="card-title">Gambar</h3>
                        <a class="btn btn-sm btn-outline-danger float-right" href="{{URL::route('agenda.create')}}">Tambah</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display table-sm" id="tiket">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>No. Tiket</th>
                                        <th>KD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr onClick="window.location.href='{{URL::to('tiket/')}}'">
                                        <td>aa</td>
                                        <td>aa</td>
                                        <td>aa</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection