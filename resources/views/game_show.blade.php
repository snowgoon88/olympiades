@extends('layouts.app')

@section('content')
<div class="container transbox">
  @include('menu')
  
  <div class="row">
	<h3>Partie {{ $game->id }} : {{ $game->player1->team}} ({{$game->player1->faction}}) vs {{$game->player2->team}} ({{$game->player2->faction}})</h3>
  </div>
  <div class="row">
	<div class="col-md-12">
	  <strong>Status</strong> : {{$game->msg_status}} ({{$game->status}})
    </div>
  </div>

  @unless( $game->status == 'FIRST')
  <div class="row">
	<h4>Première mi-temp</h4>
	<div class="col-md-11 col-md-offset-1">
      <div>Choix de {{ $game->player1->name}}</div>
      @include('conf_show', ['conf' => $game->conf11])
      <div>Choix de {{ $game->player2->name}}</div>
      @include('conf_show', ['conf' => $game->conf21])
      <div><strong>Détails de la manche</strong>
		<div>{!! $game->msg_result1 !!}</div>
      </div>
	</div>
  </div>
  @endunless

  @if( $game->status == 'END' )
  <div class="row">
    <h4>Deuxième mi-temp</h4>
	<div class="col-md-11 col-md-offset-1">
      <div>Choix de {{ $game->player1->name}}</div>
      @include('conf_show', ['conf' => $game->conf12])
      <div>Choix de {{ $game->player2->name}}</div>
      @include('conf_show', ['conf' => $game->conf22])
      <div><strong>Détails de la manche</strong>
		<div>{!! $game->msg_result2 !!}</div>
      </div>
	</div>
  </div>
  @endif
@endsection	
