@extends('layout')

@section('content')
	<h1>{{ $genre }}</h1>

@foreach ($dvds as $dvd)
	<h5>{{$dvd->title}}</h5>
	<p>Genre: {{$dvd->genre->genre_name}}</p>
	@if($dvd->rating)
		<p>Rating: {{$dvd->rating->rating_name}}</p>
	@else
		<p>No Rating Found</p>
	@endif
	<p>Label: {{$dvd->label->label_name}}</p>
	<br>

@endforeach
<!--
@foreach ($dvds as $d)
	<h5>{{ $d->title }}</h5>
		<p>{{ 'Genre: ' . $d->genre->genre_name  }}</p>
		<p>{{ 'Label: ' . $d->label->label_name  }}</p>
		<br>

@endforeach
-->

	
@endsection
