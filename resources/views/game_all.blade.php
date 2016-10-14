@extends('layouts.app')

@section('content')
<div class="container">
  @include('menu')
  
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
			{{ link_to_action('GameController@show_game', $title = "Voir", ['gid'=>$game->id], ['class' => 'btn btn-default']) }}
			@if (Auth::user()->id == $game->player1->id )
			@if ($game->first1 == 0 or ($game->first2 > 0 and $game->second1 == 0))
			{{ link_to_action('GameController@play_game', $title = "Jouer", ['gid'=>$game->id], ['class' => 'btn btn-primary']) }}
			@else
			{{ link_to_action('GameController@play_game', $title = "Jouer", ['gid'=>$game->id], ['class' => 'btn btn-info']) }}
			@endif
			@endif
			@if (Auth::user()->id == $game->player2->id )
			@if ($game->first2 == 0 or ($game->first1 > 0 and $game->second2 == 0))
			{{ link_to_action('GameController@play_game', $title = "Jouer", ['gid'=>$game->id], ['class' => 'btn btn-primary']) }}
			@else
			{{ link_to_action('GameController@play_game', $title = "Jouer", ['gid'=>$game->id], ['class' => 'btn btn-info']) }}
			@endif
			@endif
		  </td>
		</tr>
		@endforeach
	  </table>
	</div>
  </div>
</div>
@endsection			

		

