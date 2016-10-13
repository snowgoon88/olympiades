@extends('layouts.app')

@section('content')
<div class="container">
  @include('menu')
  <div class="row">
	<div class="col-md-8 col-md-offset-2">
	  <div class="panel panel-default">
		<div class="panel-heading">Modifier l'Equipe</div>
		<div class="panel-body">
		  {!! Form::open( ['action' => ['TeamController@editTeam'], 'class' => 'form-horizontal'] ) !!}
		  <div class="form-group">
			<label for="team" class="col-md-4 control-label">Nom</label>
			<div class="col-md-6">
			  <input id="team" type="login" class="form-control" name="team" value="{{ Auth::user()->team}}" required autofocus>
			</div>
		  </div>
		  <div class="form-group">
			<label for="faction" class="col-md-4 control-label">Faction</label>
			<div class="col-md-6">
			  <input id="faction" type="login" class="form-control" name="faction" value="{{ Auth::user()->faction}}" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="race" class="col-md-4 control-label">Race</label>
			<div class="col-md-6">
			  {!! Form::select('race', ['MAN' => 'MAN', 'ELF' => 'ELF', 'ORC' => 'ORC'], Auth::user()->race ) !!}
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-md-8 col-md-offset-4">
			  <button type="submit" class="btn btn-primary">
                Modifier
              </button>
			  {{ link_to('home', $title = "Cancel", ['class' => 'btn btn-default']) }}
            </div>
          </div>
		  {!! Form::close() !!}
		</div>
	  </div>
	</div>
  </div>
</div>
@endsection
