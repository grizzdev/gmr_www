<?php
$title = (empty($title)) ? 'CMS' : $title.' | CMS';
?>
@extends('layouts.basic')

@section('head')
<link rel="stylesheet" type="text/css" href="{{ elixir('css/cms.css') }}" />
@endsection

@section('page')
<div id="wrapper">
	<header>
		@include('cms.includes.nav')
	</header>
	<div id="page-wrapper">
		@yield('content')
	</div>
</div>
@endsection

@section('foot')
<script src="{{ elixir('js/cms.js') }}"></script>
@endsection
