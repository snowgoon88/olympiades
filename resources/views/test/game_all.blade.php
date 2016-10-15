@extends('layouts.test')

@section('content')
<div class="container">
    @include('test.menu')
  <div class="row">
	<h3>Liste de toutes les  parties</h3>
	<div class="col-md-12">
	  <table class="table">
		<tr>
		  <th>#</th>
		  <th>Joueur 1</th>
		  <th>Joueur 2</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
		@foreach ($games as $game)
	  <tr>
		<td>{{$game->id}}</td>
		<td>{{$game->player1->team}}</td>
		<td>{{$game->player2->team}}</td>
		<td>{{$game->msg_status}}</td>
		<td>
		  {{ link_to_action('TestController@show_game', $title = "Voir", ['gid'=>$game->id], ['class' => 'btn btn-default']) }}
		  {{ link_to_action('TestController@play_game_admin', $title = "JouerP1", ['pid'=>$game->player1->id, 'gid'=>$game->id ],  ['class' => 'btn btn-default']) }}
		  {{ link_to_action('TestController@play_game_admin', $title = "JouerP2", ['pid'=>$game->player2->id, 'gid'=>$game->id ],  ['class' => 'btn btn-default']) }}
		  -
		  {{ link_to_action('TestController@reset_game', $title = "(RESET)", ['gid'=>$game->id ],  ['class' => 'btn btn-default']) }}
		</td>
	  </tr>
	  @endforeach
	  </table>
	</div>
  </div>
</div>
@endsection			

		

