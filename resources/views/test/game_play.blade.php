@extends('layouts.test')

@section('content')
<div class="container">
  @include('test.menu')
  
  <h3>{{ $player->team }} joue partie {{$game->id}} contre
      @if( $pos1 )
      {{ $game->player2->team }}
      @else
      {{ $game->player1->team }}
      @endif
  </h3>
  <div class="row">
	<div class="col-md-12">
	  <strong>Status</strong> : {{$game->msg_status}} ({{$game->status}})
    </div>
  </div>

  <div class="row">
	<div class="col-md-12">
  @if( $game->status == 'FIRST' )
    @if($pos1)
      @if($game->first1 == 0)
      <div>Il faut déterminer la configuration de la première mi-temps !</div>
        @include('test.conf_new')
      @else
      <div>Vous avez joué, on attend {{$game->player2->team}}</div>
        @include('conf_show', ['conf' => $game->conf11])
      @endif
    @else
    @if($game->first2 == 0)
      <div>Il faut déterminer la configuration de la première mi-temps !</div>
      @include('test.conf_new')
    @else
      <div>Vous avez joué, on attend {{$game->player1->team}}</div>
      @include('conf_show', ['conf' => $game->conf21])
    @endif
  @endif
  
  @elseif( $game->status == 'SECOND' )
    <div>Résultat de la première mi-temps : {{$game->msg_status}}</div>
    @if($pos1)
      @if($game->second1 == 0)
        <div>Il faut déterminer la configuration de la deuxième mi-temps !</div>
        @include('test.conf_new')
      @else
        <div>Vous avez joué, on attend {{$game->player2->team}}</div>
        @include('conf_show', ['conf' => $game->conf12])
      @endif
    @else
    @if($game->second2 == 0)
      <div>Il faut déterminer la configuration de la deuxième mi-temps !</div>
      @include('test.conf_new')
    @else
      <div>Vous avez joué, on attend {{$game->player1->team}}</div>
      @include('conf_show', ['conf' => $game->conf22])
    @endif
  @endif

  @elseif( $game->status == 'END' )
    <div>Match terminé</div>
    <div>{{$game->msg_status}}</div>
  @else
    <div>Match pas bien initialisé ou bizarre... En parler à Thansep !</div>
  @endif
@endsection
