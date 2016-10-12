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
    <h2>Liste des parties</h2>
    <p>La liste de toutes les parties. Pour un joueur donné, je ferai aussi une liste avec seulement les parties où il est impliqué.</p>
    @foreach ($games as $game)
    <div>
      Partie n°:{{$game->id}}
      {{$game->player1->name}} [{{$game->player1->faction}}] vs {{$game->player2->name}} [{{$game->player2->faction}}]
      {{ link_to_action('GameController@show_game', 'Vue_P1', ['pid'=>$game->player1->id, 'gid'=>$game->id]) }} -
      {{ link_to_action('GameController@play_game', 'Jouer_P1', ['pid'=>$game->player1->id, 'gid'=>$game->id]) }} || 
      {{ link_to_action('GameController@show_game', 'Vue_P2', ['pid'=>$game->player2->id, 'gid'=>$game->id]) }} - 
      {{ link_to_action('GameController@play_game', 'Jouer_P2', ['pid'=>$game->player2->id, 'gid'=>$game->id]) }} -
      ({{ link_to_action('GameController@reset_game', 'RESET', ['pid'=>$game->player1->id, 'gid'=>$game->id]) }})
    </div>
    @endforeach
  </body>
</html>
