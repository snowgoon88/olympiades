@extends('layouts.app')

@section('content')
<div class="container">
  @include('menu')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
	  <div class="panel panel-default">
        <div class="panel-heading">Change le Password</div>
		<div class="panel-body">
		  {!! Form::open( ['action' => ['Auth\ChangePassword@updatePassword'], 'class' => 'form-horizontal'] ) !!}

		  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Ancien Password</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control" name="password" required>

              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>

		  <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
            <label for="new_password" class="col-md-4 control-label">Nouveau Password</label>

            <div class="col-md-6">
              <input id="new_password" type="password" class="form-control" name="new_password" required>

              @if ($errors->has('new_password'))
              <span class="help-block">
                <strong>{{ $errors->first('new_password') }}</strong>
              </span>
              @endif
            </div>
          </div>

		  <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
            <label for="new_password-confirm" class="col-md-4 control-label">Confirmer Password</label>
			
            <div class="col-md-6">
              <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" required>
			  
              @if ($errors->has('new_password_confirmation'))
              <span class="help-block">
                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
              </span>
              @endif
            </div>
          </div>

		  <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
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
