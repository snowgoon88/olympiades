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
    <h2>{{ $player->name }} joue {{$game->id}} contre
      @if( $pos1 )
      {{ $game->player2->name }}
      @else
      {{ $game->player1->name }}
      @endif
    </h2>
    <div>
      Status : {{$game->msg_status}} ({{$game->status}})
    </div>
    @if( $game->status == 'FIRST' )
    @if($pos1)
    @if($game->first1 == 0)
    <div>Il faut déterminer la configuration de la première mi-temps !</div>
    @include('conf_new')
    @else
    <div>Vous avez joué, on attend {{$game->player2->name}}</div>
    <div>FAIT configuration choisie de 1</div>
    @include('conf_show', ['conf' => $game->conf11])
    @endif
    @else
    @if($game->first2 == 0)
    <div>Il faut déterminer la configuration de la première mi-temps !</div>
    @include('conf_new')
    @else
    <div>Vous avez joué, on attend {{$game->player1->name}}</div>
    <div>TODO configuration choisie de 2</div>
    @include('conf_show', ['conf' => $game->conf21])
    @endif
    @endif
    @elseif( $game->status == 'SECOND' )
    <div>Résultat de la première mi-temps : {{$game->msg_status}}</div>
    @if($pos1)
    @if($game->second1 == 0)
    <div>Il faut déterminer la configuration de la deuxième mi-temps !</div>
    @include('conf_new')
    @else
    <div>Vous avez joué, on attend {{$game->player2->name}}</div>
    <div>FAIT configuration choisie de 1</div>
    @include('conf_show', ['conf' => $game->conf12])
    @endif
    @else
    @if($game->second2 == 0)
    <div>Il faut déterminer la configuration de la deuxième mi-temps !</div>
    @include('conf_new')
    @else
    <div>Vous avez joué, on attend {{$game->player1->name}}</div>
    <div>FAIT configuration choisie de 2</div>
    @include('conf_show', ['conf' => $game->conf22])
    @endif
    @endif
    @elseif( $game->status == 'END' )
    <div>Match terminé</div>
    <div>{{$game->msg_status}}</div>
    @else
    <div>Match pas bien initialisé ou bizarre... En parler à Thansep !</div>
    @endif
  </body>
</html>
