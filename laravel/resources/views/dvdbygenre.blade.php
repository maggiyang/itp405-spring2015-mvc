@extends('layout')

@section('content')
	{{{ $genre }}}
<!--	<?php dd($dvds) ?>-->
	@foreach ($dvds as $dvd)
{{{ $dvd->title }}}}
		<br>
	@endforeach
@endsection
