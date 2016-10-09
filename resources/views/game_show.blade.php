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
    <h2>Partie {{ $game->id }} : {{ $game->player1->name}} vs {{$game->player2->name}}</h2>
    <div>{{ link_to_action('GameController@list_game', 'Retour à la liste des parties', ['pid'=>$player->id]) }}</div>
    <div>
      Status : {{$game->msg_status}} ({{$game->status}})
    </div>
    
    @unless( $game->status == 'FIRST')
    <h3>Première mi-temp</h3>
    <div>Choix de {{ $game->player1->name}}</div>
    @include('conf_show', ['conf' => $game->conf11])
    <div>Choix de {{ $game->player2->name}}</div>
    @include('conf_show', ['conf' => $game->conf21])
    <div><strong>Détails de la manche</strong>
      <div>{!! $game->msg_result1 !!}</div>
    </div>
    @endunless

    @if( $game->status == 'END' )
    <h3>Deuxième mi-temp</h3>
    <div>Choix de {{ $game->player1->name}}</div>
    @include('conf_show', ['conf' => $game->conf12])
    <div>Choix de {{ $game->player2->name}}</div>
    @include('conf_show', ['conf' => $game->conf22])
    <div><strong>Détails de la manche</strong>
      <div>{!! $game->msg_result2 !!}</div>
    </div>
    @endif
    
  </body>
</html>
