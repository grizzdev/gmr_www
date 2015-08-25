<?php
$title = 'Login';
?>
@extends('layouts.master')

@section('content')
<div class="row login-content">
	<div class="col-sm-12 col-md-4 col-md-offset-4">
		@include('includes.login-form')
	</div>
</div>
@endsection
