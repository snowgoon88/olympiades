@extends('layouts.home')

@section('content')
<div style="margin:auto; width:800px">
  <img src="Images/BloodBowl2_title.jpg" style="width:800px">
  
  <div style="position:relative; bottom:60px; margin:auto; width:100px">
	{{ link_to('/login', $title='Entrez', ['class' => 'btn btn-lg btn-danger']) }}
  </div>
</div>
@endsection
