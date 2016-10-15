<div class="row">
  <div class="col-md-6">
	{{ link_to_action('TestController@all_game', $title = "Toutes les Parties", [], ['class' => 'btn btn-default']) }}
     -
    {{ link_to_action('TestController@rules', $title= "Règles",[], ['class' => 'btn btn-default']) }}
  </div>
</div>
