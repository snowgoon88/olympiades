<h2>Equipe {{ Auth::user()->team }} de {{ Auth::user()->faction }} [{{ Auth::user()->race}}]</h2>
  <div class="row">
	<div class="col-md-6">
	  {{ link_to('mygame', $title = "Mes parties", ['class' => 'btn btn-default']) }}
	  {{ link_to('allgame', $title = "Toutes les parties", ['class' => 'btn btn-default']) }}
	</div>
	<div class="col-md-2 col-md-offset-2">
	  {{ link_to('editteam', $title = "Editer l'Equipe", ['class' => 'btn btn-default']) }}
	</div>
  </div>
