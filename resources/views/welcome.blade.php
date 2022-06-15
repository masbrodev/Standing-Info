<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/custom/table.css') }}">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <iframe width="1055" height="315" src="https://www.youtube.com/embed/{{Str::of($vidio->link)->afterLast('?v=')}}?rel=0&amp;autoplay=1&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
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
                    <h3 class="card-title">Agenda / Rapat</h3>

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
                            <tr>
                                <td>
                                    <img src="https://e7.pngegg.com/pngimages/779/654/png-clipart-computer-icons-meeting-convention-meeting-black-conference.png " width="80" alt="Product Image">
                                </td>
                                <td>
                                    <a href="#" class="product-title">{{ $d->tempat }}</a>

                                </td>
                                <td>
                                    <span class="">
                                        {{ $d->nama }}
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
            <div class="card bg-gradient-success">
                <div class="card-header border-0">

                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">

                    </div>
                    <!-- /. tools -->
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
                    center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
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
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.fullCalendar('renderEvent', {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true // make the event "stick"
                        );
                    }
                    calendar.fullCalendar('unselect');
                },
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
                            title : `{{ Carbon\Carbon::parse($j->waktu)->isoFormat('HH:MM') }} - {{ $j->nama }}`,
                            start : new Date(`{{ Carbon\Carbon::parse($j->waktu)->isoFormat('Y,MM,DD') }}`),
                            allday: false
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
