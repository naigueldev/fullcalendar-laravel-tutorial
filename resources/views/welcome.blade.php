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
  {!! Html::style('vendor/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css') !!}
  {!! Html::style('vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') !!}

  <!-- Styles -->
  <style>
  .input-group-addon{
    padding: .375rem 1.75rem !important;
  }
  .colorpicker-element .add-on i, .colorpicker-element .input-group-addon i{
    position: absolute;
    right: 14px;
  }
  #calendar{
    margin-top: 20px;
    margin-bottom: 30px;
  }
  .fc-event{
    font-size: 1.1em !important;
  }
  .fc-time, .fc-title{
    color: #000000 !important;
  }
  </style>


</head>
<body>
  <div class="container">

    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 1051 !important;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Deletar</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Tem certeza que deseja deletar ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button id="yes_delete" type="button" class="btn btn-danger">Deletar</button>
					</div>
				</div>
			</div>
		</div>



    <div id="responsive-model" class="modal fade" tabindex="-1" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>REGISTRAR NOVO EVENTO</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							{{ Form::label('title', 'TÍTULO') }}
							{{ Form::text('title', old('title') , ['class' => 'form-control']) }}

						</div>


						<div class="form-group">
							{{ Form::label('date_start', 'INÍCIO EVENTO') }}
							{{ Form::text('date_start', old('date_start') , ['class' => 'form-control' , 'readonly' => 'true']) }}

						</div>
						<div class="form-group">
							{{ Form::label('time_start', 'HORA INÍCIO') }}
							{{ Form::text('time_start', old('time_start') , ['class' => 'form-control']) }}

						</div>

						<div class="form-group">
							{{ Form::label('date_end', 'FIM DO EVENTO') }}
							{{ Form::text('date_end', old('date_end') , ['class' => 'form-control']) }}

						</div>

						<div class="form-group">
							{{ Form::label('color', 'COR') }}

							<div id="cp10" class="input-group colorpicker colorpicker-component colorpicker-element">
								{{ Form::text('color', old('color') , ['class' => 'form-control']) }}
								<span class="input-group-addon"><i style="background-color: rgb(75, 0, 110);"></i></span>
							</div>


						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>

						<a id="save" type="button" class="btn btn-success">SALVAR</a>

					</div>
				</div>
			</div>

		</div>


    <div id="calendar"></div>

    <div id="modal-event" class="modal fade" tabindex="-1" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4>DETALHES DO EVENTO</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							{{ Form::label('title_edit', 'TÍTULO') }}
							{{ Form::text('title_edit', old('title_edit') , ['class' => 'form-control']) }}

						</div>


						<div class="form-group">
							{{ Form::label('date_start_edit', 'INÍCIO EVENTO') }}
							{{ Form::text('date_start_edit', old('date_start_edit') , ['class' => 'form-control' , 'readonly' => 'true']) }}

						</div>
						<div class="form-group">
							{{ Form::label('time_start_edit', 'HORA INÍCIO') }}
							{{ Form::text('time_start_edit', old('time_start_edit') , ['class' => 'form-control']) }}

						</div>

						<div class="form-group">
							{{ Form::label('date_end_edit', 'FIM DO EVENTO') }}
							{{ Form::text('date_end_edit', old('date_end_edit') , ['class' => 'form-control']) }}

						</div>

						<div class="form-group">
							{{ Form::label('color_edit', 'COR') }}

							<div id="cp10" class="input-group colorpicker colorpicker-component colorpicker-element">
								{{ Form::text('color_edit', old('color_edit') , ['class' => 'form-control']) }}
								<span class="input-group-addon"><i style="background-color: rgb(75, 0, 110);"></i></span>
							</div>


						</div>
					</div>
					<div class="modal-footer">

						<meta name="csrf-token" content="{{ csrf_token() }}">
						<a id="delete" data-href="{{ url('events') }}" data-id="" class="btn btn-danger"> DELETAR </a>
						<button type="button" class="btn btn-default" data-dismiss="modal">CANCELAR</button>
						<button id="edit" type="button" class="btn btn-success" data-dismiss="modal">ATUALIZAR</button>
					</div>
				</div>
			</div>

		</div>


  </div>
</body>

{!! Html::script('vendor/jquery.min.js') !!}
{!! Html::script('vendor/fullcalendar/lib/moment.min.js') !!}
{!! Html::script('vendor/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('vendor/fullcalendar/locale/pt-br.js') !!}
{!! Html::script('vendor/bootstrap/assets/js/vendor/popper.min.js') !!}
{!! Html::script('vendor/bootstrap/dist/js/bootstrap.min.js') !!}
{!! Html::script('vendor/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') !!}
{!! Html::script('vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') !!}

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
    events: BASEURL + '/events',
    eventClick: function(event, jsEvent, view){
      $('#modal-event #delete').attr('data-id', event.id);
      $('#modal-event #edit').attr('data-id', event.id);
      var date_start = moment(event.start).format('DD-MM-YYYY');
      var time_start = moment(event.start).format('hh:mm:ss');
      var date_end = moment(event.end).format('DD-MM-YYYY hh:mm:ss');
      $('#modal-event #title_edit').val(event.title);
      $('#modal-event #date_start_edit').val(date_start);
      $('#modal-event #time_start_edit').val(time_start);
      $('#modal-event #date_end_edit').val(date_end);
      $('#modal-event #color_edit').val(event.color);
      $('#modal-event').modal('show');
    },
    eventDrop: function(event, delta) {
				var id_event = event.id;
				var title_edit = event.title;
				var date_start_edit = moment(event.start).format('YYYY-MM-DD');
				var time_start_edit = moment(event.start).format('hh:mm:ss');
				var date_end_edit = moment(event.end).format('YYYY-MM-DD hh:mm:ss');
				var color_edit = event.color;
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url: 'atualizaEvento',
					data: '&id='+ id_event+'&title='+ title_edit+'&start='+ date_start_edit + ' ' + time_start_edit +
					'&end='+ date_end_edit +'&color='+color_edit,
					type: "POST",
					success: function(json) {
						$('#modal-event').modal('hide');
						console.log("Atualizado com sucesso");
						$('#calendar').fullCalendar( 'refetchEvents' );
					},
					error: function(json){
						console.log("Erro ao atualizar");
					}
				});
			}
  });
  $('.colorpicker').colorpicker();
  $('#time_start , #time_start_edit').bootstrapMaterialDatePicker({
    date: false,
    shortTIme: false,
    format: 'HH:mm:ss'
  });
  $('#date_end , #date_end_edit').bootstrapMaterialDatePicker({
    date: true,
    shortTIme: false,
    format: 'DD-MM-YYYY HH:mm'
  });

});

$('#delete').on('click', function(){
  var x = $(this);
  var id_event = x.attr('data-id');
  var delete_url = x.attr('data-href')+'/'+x.attr('data-id');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#modalDelete').modal('show');
  $('#yes_delete').on('click',function(e){
    $('#modalDelete').modal('hide');
    e.preventDefault();
    $.ajax({
      url: delete_url,
      type: 'DELETE',
      success: function(result){
        $('#modal-event').modal('hide');
        $('#calendar').fullCalendar('removeEvents',id_event);
      },
      error: function(result){
        $('#modal-event').modal('hide');
      }
    });
  });
});

$("#save").on('click', function(e){
  e.preventDefault();

  var title = $('#title').val();
  var date_start = $('#date_start').val();
  var date_start = dateToUsFormat(date_start);
  var time_start = $('#time_start').val();
  var date_end = $('#date_end').val();
  var date_end = onlyDateToUsFormat(date_end) +' '+onlyTime(date_end);

  var color = $('#color').val();


  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: 'criarEvento',
    data: 'title='+ title+'&start='+ date_start + ' ' + time_start + '&end='+ date_end +'&color='+color,
    type: "POST",
    success: function(json) {
      $('#responsive-model').modal('hide');
      console.log("Criado com sucesso");
      $('#calendar').fullCalendar( 'refetchEvents' );
      clearInputModalSave();
    },
    error: function(json){
      console.log("Erro ao criar");
    }
  });

  $("#edit").on('click', function(){
		var x = $(this);
		var id_event = x.attr('data-id');
		var title_edit = $('#title_edit').val();
		var date_start_edit = $('#date_start_edit').val();
		var date_start_edit = dateToUsFormat(date_start_edit);
		var time_start_edit = $('#time_start_edit').val();
		var date_end_edit = $('#date_end_edit').val();
		var date_end_edit = onlyDateToUsFormat(date_end_edit) +' '+onlyTime(date_end_edit);
		var color_edit = $('#color_edit').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: 'atualizaEvento',
			data: '&id='+ id_event+'&title='+ title_edit+'&start='+ date_start_edit + ' ' + time_start_edit +
			'&end='+ date_end_edit +'&color='+color_edit,
			type: "POST",
			success: function(json) {
				$('#modal-event').modal('hide');
				console.log("Atualizado com sucesso");
				$('#calendar').fullCalendar( 'refetchEvents' );
			},
			error: function(json){
				console.log("Erro ao atualizar");
			}
		});
	});



  function clearInputModalSave(){
		$('#title').val("");
		$('#date_start').val("");
		$('#time_start').val("");
		$('#date_end').val("");
		$('#color').val("");
	}

	function dateToUsFormat(dateStr) {
		var parts = dateStr.split("-");
		var new_date = new Date(parts[2], parts[1] - 1, parts[0]);
		var us_format = moment(new_date).format('YYYY-MM-DD');
		return us_format;
	}
	function onlyDateToUsFormat(dateStr) {
		var only_date = dateStr.split(' ')[0];
		var parts = only_date.split("-");
		var new_date = new Date(parts[2], parts[1] - 1, parts[0]);
		var us_format = moment(new_date).format('YYYY-MM-DD');
		return us_format;
	}
	function onlyTime(dateStr) {
		var only_time = dateStr.split(' ')[1];
		return only_time;
	}


});


</script>


</html>
