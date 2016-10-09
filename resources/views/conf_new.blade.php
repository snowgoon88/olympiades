<div>
  {!! Form::open( ['action' => ['GameController@add_configuration', $player, $game], 'class' => 'form_vertical'] ) !!}

  <div class="zone">
      <h3> Zone Gauche</h3>
      <div class="form-group">
	<span>DEF: {!! Form::number( 'nbdefG', 0, ['max' => 10, 'min' => 0, 'style' => 'width: 2em']) !!}</span><br/>
	<span>ATT:{!! Form::number( 'nbattG', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>3/4:{!! Form::number( 'nbquartG', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>PASS:{!! Form::number( 'nbpassG', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>Tactique: {!! Form::select('sfmG', ['S' => 'PIERRE', 'P' => 'PAPIER', 'C' => 'CISEAUX'], 'S') !!}</span><br/>
      </div>
  </div>
  <div class="zone">
    <h3> Zone Centre</h3>
    <div class="form-group">
      <span>DEF:{!! Form::number( 'nbdefC', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
      <span>ATT:{!! Form::number( 'nbattC', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>3/4:{!! Form::number( 'nbquartC', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>PASS:{!! Form::number( 'nbpassC', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
    </div>
  </div>
  <div class="zone">
    <h3> Zone Droite</h3>
    <div class="form-group">
      <span>DEF:{!! Form::number( 'nbdefD', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
      <span>ATT:{!! Form::number( 'nbattD', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>3/4:{!! Form::number( 'nbquartD', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
	<span>PASS:{!! Form::number( 'nbpassD', 0, ['max' => 10, 'min' => 0]) !!}</span><br/>
    </div>
  </div>
  {!! Form::submit('Envoyer') !!}
  {!! Form::close() !!}
</div>
