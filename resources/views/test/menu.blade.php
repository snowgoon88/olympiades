<div class="row">
  <div class="col-md-6">
	{{ link_to_action('TestController@all_game', $title = "Toutes les Parties", ['gid'=>$game->id], ['class' => 'btn btn-default']) }}
  </div>
</div>
