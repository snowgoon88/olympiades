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
    <h2>Configuration {{ $conf->id }}</h2>
    <div class="zone">
      <h3> Zone Gauche ({{$zoneG->id}})</h3>
      <table>
	<tr>
	  <th>DEF</th><td>{!! $zoneG->nbdef !!}</td>
	</tr>
	<tr>
	  <th>ATT</th><td>{!! $zoneG->nbatt !!}</td>
	</tr>
      </table>
    </div>
    <div class="zone">
      <h3> Zone Centre ({{$zoneC->id}})</h3>
      <table>
	<tr>
	  <th>DEF</th><td>{!! $zoneC->nbdef !!}</td>
	</tr>
	<tr>
	  <th>ATT</th><td>{!! $zoneC->nbatt !!}</td>
	</tr>
      </table>
    </div>
  </body>
</html>
