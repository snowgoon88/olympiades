@if( $errors->any() )
<div style="color:red">
  <h3>Error</h3>
  @foreach ($errors->all() as $message)
  <p>{{ $message }}<p/>
    @endforeach
</div>
@endif

{!! Form::open( ['action' => ['TestController@add_configuration', $player, $game], 'class' => 'form-horizontal'] ) !!}
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<table class="table">
	  <tr>
		<th></th>
		<th>Zone Gauche</th>
		<th>Zone Centre</th>
		<th>Zone Droite</th>
	  </tr>
	  <tr>
		<th>DEF</th>
		<td>{!! Form::number( 'nbdefG', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbdefC', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbdefD', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
	  </tr>
	  <tr>
		<th>ATT</th>
		<td>{!! Form::number( 'nbattG', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbattC', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbattD', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
	  </tr>
	  <tr>
		<th>3/4</th>
		<td>{!! Form::number( 'nbquartG', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbquartC', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
		<td>{!! Form::number( 'nbquartD', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 4em']) !!}</td>
	  </tr>
	  <tr>
		<th>PASS</th>
		<td>{!! Form::number( 'nbpassG', 0, ['max' => 1, 'min' => 0, 'style' => 'width: 3em']) !!}</td>
		<td>{!! Form::number( 'nbpassC', 0, ['max' => 1, 'min' => 0, 'style' => 'width: 3em']) !!}</td>
		<td>{!! Form::number( 'nbpassD', 0, ['max' => 1, 'min' => 0, 'style' => 'width: 3em']) !!}</td>
	  </tr>
	  <tr>
		<th>Tactique</th>
		<td>{!! Form::select('sfmG', ['PIERRE' => 'PIERRE', 'PAPIER' => 'PAPIER', 'CISEAUX' => 'CISEAUX'], 'PIERRE') !!}</td>
		<td>{!! Form::select('sfmC', ['PIERRE' => 'PIERRE', 'PAPIER' => 'PAPIER', 'CISEAUX' => 'CISEAUX'], 'PIERRE') !!}</td>
		<td>{!! Form::select('sfmD', ['PIERRE' => 'PIERRE', 'PAPIER' => 'PAPIER', 'CISEAUX' => 'CISEAUX'], 'PIERRE') !!}</td>
	  </tr>
	</table>
  </div>
</div>
<div class="row">
  <div class="col-md-2">
	<strong>Phases d'attaques</strong>
  </div>
  <div class="col-md-2">
	phase 2 : {!! Form::select('phase2', ['GAUCHE' => 'GAUCHE', 'CENTRE' => 'CENTRE', 'DROITE' => 'DROITE'], 'CENTRE') !!}
  </div>
  <div class="col-md-2">
	phase 3 : {!! Form::select('phase3', ['GAUCHE' => 'GAUCHE', 'CENTRE' => 'CENTRE', 'DROITE' => 'DROITE'], 'CENTRE') !!}
  </div>
  <div class="col-md-2">
	phase 4 : {!! Form::select('phase4', ['GAUCHE' => 'GAUCHE', 'CENTRE' => 'CENTRE', 'DROITE' => 'DROITE'], 'CENTRE') !!}
  </div>
</div>
<div class="row">
  &nbsp;
</div>
<div class="row">
  <div class="col-md-8 col-md-offset-4">
	{!! Form::submit('Envoyer',['class' => 'btn btn-primary']) !!}
	{{ link_to('/test/allgame', $title = "Cancel", ['class' => 'btn btn-default']) }}
  </div>
</div>
{!! Form::close() !!}
