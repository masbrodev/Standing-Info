<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspektorat Jenderal Kementerian Desa</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom/table.css') }}">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

</head>

<body>
    <!-- <div class="row">
        <div class="col-md-12">
            <iframe width="1055" height="315" src="https://www.youtube.com/embed/{{Str::of($vidio->link)->afterLast('?v=')}}?rel=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
    </div> -->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($gambar as $g)
            <li data-target="#carouselExampleCaptions" data-slide-to="{{$loop->iteration - 1 }}" class=" @if($loop->iteration == 0) active @endif"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach($gambar as $g)
            <div class="carousel-item @if($loop->iteration == 1) active @endif">
                <img src="{{ $g->lokasi }}" height="600" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $g->nama }}</h5>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="row">
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
                                    Ruang Rapat Badan Pengawas Keuangan (BPK) Inspektorat jenderal - Lantai 4
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
                                       <b> - {{ $d->nama }}</b>
                                    </span>
                                </td>
                                <td>
                                <div class="">
                                        <br>
                                        @if( Carbon\Carbon::now()->isoFormat('YMMDD') == Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span hidden>A</span> <span class="badge badge-danger">Hari Ini</span>
                                        @elseif (Carbon\Carbon::tomorrow()->isoFormat('YMMDD') == Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span hidden>B</span> <span class="badge badge-primary">Besok</span>
                                        @elseif (Carbon\Carbon::today()->isoFormat('YMMDD') > Carbon\Carbon::parse($d->waktu)->isoFormat('YMMDD'))
                                        <span hidden>D</span> <span class="badge badge-secondary">Selesai</span>
                                        @else
                                        <span hidden>C</span> <span class="badge badge-warning">Akan Datang</span>
                                        @endif
                                        <br>
                                        <span class="badge badge-success">{{ Carbon\Carbon::parse($d->waktu)->isoFormat('H:mm') }} WIB</span>
                                        <br>
                                        <span class="badge badge-info">{{ Carbon\Carbon::parse($d->waktu)->isoFormat('D MMMM Y') }}</span>
                                        <br>
                                        @if($d->status == 'diajukan')
                                        <span hidden>qq</span><span class="badge text-danger"><i class="fa fa-clock"></i> {{ $d->status }}</span>
                                        @elseif($d->status == 'disetujui')
                                        <span class="badge text-primary"><i class="fa fa-check text-primary"></i> {{ $d->status }}</span>
                                        @else
                                        <span class="badge text-danger"><i class="fa fa-ban"></i> {{ $d->status }}</span>
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
        <div class="col-md-12">
            <div class="card bg-gradient-danger">
                <div class="card-header border-0">

                    <h3 class="card-title">
                        <i class="far fa-calendar"></i>
                        Kalender Rapat
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!--The calendar -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    @foreach($agenda as $e)
<div class="modal fade" id="edit-agenda{{$e->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $e->nama }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('agenda.update',$e->id) }}" method="POST">
                    @csrf
                    <label>Nama Pemohon</label>
                    <input disabled type="hidden" class="form-control" value="PUT" name="_method">
                    <input disabled type="hidden" class="form-control" value="{{ csrf_token() }}" name="_token">
                    <input disabled type="text" class="form-control" value="{{ $e->dari }}" name="dari">
                    <br>
                    <!-- <label>Nama Agenda/Rapat</label>
                    <input disabled type="text" class="form-control" name="nama" value="{{ $e->nama }}">
                    <br> -->
                    <label>Tempat</label>
                    <!-- <select  class="form-control" name="tempat" id="tempat" onchange="othFunc()">
                        <option value="vip" {{ $e->tempat == 'vip' ? 'selected' : '' }} >Ruang Rapat VIP I Inspektorat Jenderal - LT3</option>
                        <option value="ses" {{ $e->tempat == 'ses' ? 'selected' : '' }} >Ruang Rapat Sekretaris Inspektorat jenderal - LT4</option>
                        <option value="bpk" {{ $e->tempat == 'bpk' ? 'selected' : '' }} >Ruang Rapat Badan Pengawas Keuangan (BPK) Inspektorat Jenderal - LT4</option>
                        <option value="on" {{ $e->tempat == 'on' ? 'selected' : '' }} >Tanpa Ruangan (Rapat Via Online)</option>
                        <option value="oth" {{ $e->tempat == 'oth' ? 'selected' : '' }} >Ruangan Lain (isi sendiri)</option>
                    </select>
                    <br> -->
                    <input disabled placeholder="Ruang Rapat . . . ." value="{{ $e->tempat }}" type="text" class="form-control" name="tempat2">
                    <br>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Tanggal</label>
                            <input disabled type="date" class="form-control" value="{{ Str::beforeLast($e->waktu, ' ') }}" name="tgl">
                        </div>
                        <div class="col-sm-4">
                            <label>Waktu</label>
                            <input disabled type="time" class="form-control" value="{{ Str::of($e->waktu)->afterLast(' ') }}" name="jam">
                        </div>
                        <div class="col-sm-4">
                            <label>Sampai</label>
                            <input disabled type="time" class="form-control" name="sampai" value="{{ Str::of($e->sampai)->afterLast(' ') }}">
                        </div>
                    </div>
                    <br>
                    <label>Kategori</label>
                    <br>
                    <select disabled class="form-control" name="keterangan">
                        <option value="off" {{ $e->keterangan == 'off' ? 'selected' : '' }} >Offline</option>
                        <option value="on" {{ $e->keterangan == 'on' ? 'selected' : '' }}>Online</option>
                        <option value="ofn" {{ $e->keterangan == 'ofn' ? 'selected' : '' }}>Online & Offline</option>
                    </select>
                    <br>
                    <label>Status</label>
                    <select disabled class="form-control" name="status">
                        <option value="diajukan" {{ $e->status == 'diajukan' ? 'selected' : '' }} >Diajukan</option>
                        <option value="disetujui" {{ $e->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $e->status == 'ofn' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <br>
                </div>
            <!-- <div class="modal-footer justify-content-between">
                <a href="{{ route('agenda.edit', $e->id) }}" class="btn btn-danger">Hapus</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </div> -->
            </form>
        </div>

    </div>
    <!-- /.modal-content -->
</div>
@endforeach

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/custom/calendar.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/moment/moment.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/pages/dashboard.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/sparklines/sparkline.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/adminlte.js"></script>
    <script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/demo.js"></script> -->

    <script>
        $(document).ready(function() {
            $("#agenda").dataTable({
                "order": [[3, 'asc']],
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false
            });

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            console.log(d);

            /*  className colors

            className: default(transparent), important(red), chill(pink), success(green), info(blue)

            */


            /* initialize the external events
            -----------------------------------------------------------------*/

            $('#external-events div.external-event').each(function() {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

            });


            /* initialize the calendar
            -----------------------------------------------------------------*/

            var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'prev,next'
            },
            editable: true,
            firstDay: 0, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',

            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd', // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d', // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,

            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },

            events: [
                @foreach ($agenda as $j)
                    {
                            title : `{{ Carbon\Carbon::parse($j->waktu)->isoFormat('HH:MM') .'-'. Carbon\Carbon::parse($j->sampai)->isoFormat('HH:MM') }}{{ $j->status == 'diajukan' ? '✗' : '✔' }}
                                @if ($j->tempat == 'vip')
                                vip1 LT 3
                                @elseif ($j->tempat == 'bpk')
                                BPK LT 3
                                @elseif ($j->tempat == 'ses')
                                SES LT 4
                                @elseif ($j->tempat == 'on')
                                Online
                                @endif
                                {{ '-'. Illuminate\Support\Str::limit($j->nama,15,'.') }}`,
                        start : new Date(`{{ Carbon\Carbon::parse($j->waktu)->isoFormat('Y,MM,DD') }}`),
                        allday: false,
                    },
                @endforeach
                //     {
                //         title: 'All Day Event',
                //         start: new Date(y, m, 1)
                //     },
                //     {
                //     title: 'Rapat Meet',
                //     start: new Date(y, m, 3)
                // },
                // {
                //     id: 999,
                //     title: 'Repeating Event',
                //     start: new Date(y, m, d + 4, 16, 0),
                //     allDay: false,
                //     className: 'info'
                // },
                // {
                //     title: 'Meeting',
                //     start: new Date(y, m, d, 10, 30),
                //     allDay: false,
                //     className: 'important'
                // },
                // {
                //     title: 'Lunch',
                //     start: new Date(y, m, d, 12, 9),
                //     end: new Date(y, m, d, 14, 0),
                //     allDay: false,
                //     className: 'important'
                // },
                // {
                //     title: 'Birthday Party',
                //     start: new Date(y, m, d + 1, 19, 0),
                //     end: new Date(y, m, d + 1, 22, 30),
                //     allDay: false,
                // },
                // {
                //     title: 'Click for Google',
                //     start: new Date(y, m, 28),
                //     end: new Date(y, m, 29),
                //     url: 'https://ccp.cloudaccess.net/aff.php?aff=5188',
                //     className: 'success'
                // }
            ],
            });


        });
    </script>
</body>

</html>
