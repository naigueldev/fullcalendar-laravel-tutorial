<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // retornar todos os eventos

    $data = Event::get(['id','title','start','end','color']);
    // Pretty print json output
    // function json($data = array(), $status = 200, array $headers = array(), $options = 0)
    return Response()->json($data, 200, array(), JSON_PRETTY_PRINT);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //Valores recibidos via ajax

    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];

    $evento= new Event();

    $evento->title = $title;
    $evento->start = $start;
    $evento->end = $end;
    $evento->color = $color;

    $evento->save();
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $event = new Event();
    $event->title = $request->title;
    $event->start = $request->date_start . ' ' . $request->time_start;
    $event->end = $request->date_end;
    $event->color = $request->color;
    $event->save();

    return redirect('/');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update()
  {
    //Valores recibidos via ajax
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $color = $_POST['color'];
    $evento=Event::find($id);
    $evento->title = $title;
    $evento->start = $start;
    $evento->end = $end;
    $evento->color = $color;
    $evento->save();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $event = Event::find($id);
    if ($event == null) {
      return Response()->json([
        'message' => 'error delete.'
      ]);
    }
    $event->delete();
    return Response()->json([
      'message' => 'success delete.'
    ]);
  }
}
