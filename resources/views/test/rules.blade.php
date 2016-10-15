@extends('layouts.test')

@section('content')
<div class="container">
  @include('test.menu')

  <h2>Les règles</h2>
  <div class="row">
	<h3>Déroulement de la partie</h3>
	<div class="col-md-12">
	  <ul>
		<li>2 équipes, 2 mi-temps</li>
		<li>Il y a 3 ZONES sur le terrain : GAUCHE, CENTRE, DROIT. (Gauche de joueur 1 est la zone DROIT de Joueur 2, et vice-versa).</li>
		<li>chaque mi-temps est composée de 4 phases</li>
		<li><strong>Première phase</strong>
		  <ul>
			<li>On tire aléatoirement la ZONE où atterrit le ballon</li>
			<li>ShiFuMi (+aléa si égalité) pour savoir qui attaque</li>
		  </ul>
		</li>
		<li><strong>Autres phases</strong>. La possession du ballon est déterminée par la phase précédente.</li>
	  </ul>
	</div>
  </div>

  <div class="row">
	<h3>Une attaque</h3>
	<div class="col-md-12">
	  <ul>
		<li>On compare les forces d'attaque (FATT) du possesseur de la balle à celle du défenseur (FDEF) dans la ZONE où se situe le ballon.</li>
		<li>On ajoute un dé allant de +2 à -2 (ROLL)</li>
		<li>En fonction du ShiFuMi, on ajoute +1,0,-1 (SFM)</li>
		<li>Ce qui fait un résultats RES=FATT- FDEF + ROLL + SFM</li>
		<ul>
		  <li> Si le possesseur du ballon gagne, il MARQUE et on donne la balle a l'adversaire qui choisi où il va attaquer à la prochaine phase.</li>
		  <li> Si le défenseur gagne, il récupère le ballon et choisi où il va attaquer à la prochaine phase</li>
		  <li> En cas d'égalité, le possesseur de la balle la garde et choisi où il va attaquer à la prochaine phase.</li>
		</ul>
	  </ul>
	</div>
  </div>

  <div class="row">
	<h3>Composition d'une Equipe</h3>
	<div class="col-md-12">
	  <ul>
		<li>10 joueurs, répartis sur les 3 ZONES</li>
		<li>1 passeur MAXIMUM</li>
		<li>Types de joueurs</li>
		<ul>
		  <li>Defenseur:   +1 att / +3 def</li>
		  <li>Attaquant:   +3 att / +1 def</li>
		  <li>trois/quart: +2 att / +2 def</li>
		  <li>Passeur: +4 att / +0 def</li>
		</ul>
		<li><strong>NOTE 1:</strong> Il avait été suggéré de limiter à 2 changements de joueurs à la mi-temps. ==> Pour l'instant, cette limitation n'est pas mise en place. Pour l'instant, on peut entièrement changer son équipe.</li>
		<li><strong>NOTE 2:</strong> Il sera aussi possible de choisir une RACE pour l'équipe entière. On avait dit Humain, Orc (+1 DEF) et Elfe (+1 ATT). C'est pas fait non plus.</li>
	  </ul>
	</div>
  </div>

  <div class="row">
	<h3>Suggestions</h3>
	<div class="col-md-12">
	  <p>Après quelques parties d'essai contre moi-mêm, j'ai trouvé que cela manquait un peu de variabilité et que, souvent, l'attaquant marquait un point quand il avait la balle. Quelques suggestions de modification de règle suivent. Mais pas encore testés.</p>
	  <p><strong>On pourrait faire des parties de test et ouvrir un fil de discussion sur le forum pour proposer et discuter des améliorations ou changements.</strong></p>
	  <ul>
		<li>Actuellement, c'est (trop) facile de marquer quand on SAIT où on va attquer. => Faire un ShiFuMi par phase (et non plus par ZONE) pour décider quel joueur choisi la ZONE d'action. Si égalité, on tire au hasard.</li>
		<li>Probabilité qu'un passeur se fasse blesser et ne puisse plus jouer (équipe réduite à 9 joueurs ??)</li>
	  </ul>
	</div>
  </div>
</div>
@endsection	
