<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="fr">
  <head>
    <title>Olympiades de Farenstol</title>
  <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
  </style>
  </head>

  <body class="container">
    <h2>Configuration {{ $conf->id }}</h2>
    {!! Form::open( ['route' => ['configuration.update', $conf->id, $zoneG->id, $zoneC->id], 'method' => 'put', 'class' => 'form_vertical'] ) !!}
    <div class="zone">
      <h3> Zone Gauche ({{$zoneG->id}})</h3>
      <div class="form-group">
	<span>DEF:{!! Form::number( 'nbdefG', $zoneG->nbdef, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>ATT:{!! Form::number( 'nbattG', $zoneG->nbatt, ['max' => 10, 'min' => 0]) !!}</span>
      </div>
    </div>
    <div class="zone">
      <h3> Zone Centre ({{$zoneC->id}})</h3>
      <div class="form-group">
	<span>DEF:{!! Form::number( 'nbdefC', $zoneC->nbdef, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>ATT:{!! Form::number( 'nbattC', $zoneC->nbatt, ['max' => 10, 'min' => 0]) !!}</span>
      </div>
    </div>
     {!! Form::submit('Envoyer') !!}
    {!! Form::close() !!}
  </body>
</html>
