<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


  {!! Html::style('css/app.css') !!}
	{!! Html::style('vendor/fullcalendar/fullcalendar.min.css') !!}
	{!! Html::style('vendor/bootstrap/dist/css/bootstrap.min.css') !!}
	{{-- {!! Html::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!} --}}
	{!! Html::style('vendor/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}
	{!! Html::style('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}
	{{-- {!! Html::style('vendor/fullcalendar/fullcalendar.print.min.css') !!} --}}


	{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> --}}
	{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/octicons/3.5.0/octicons.min.css" rel="stylesheet"> --}}
	{{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> --}}
	{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}



  <!-- Styles -->
  <style>

  </style>


</head>
<body>

  <div id="calendar"></div>

</body>

<script type="text/javascript">
var BASEURL = "{{ url('/')}}";
$(document).ready(function() {
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,basicWeek,basicDay'
    },
    navLinks: true, //para ativar a navegacao nos links para listar dias/semanas
    editable: true,
    selectable: true, // para permitir selecionar cada evento
    selectHelper: true, // permite adicionar novo evento no calendario
    select: function(start){
      start = moment(start.format());
      $('#date_start').val(start.format('DD-MM-YYYY'));
      $('#responsive-model').modal('show');
    },
    events: BASEURL + '/events'
  });

});
</script>


</html>
