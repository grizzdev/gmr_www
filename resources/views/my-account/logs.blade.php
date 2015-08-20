@extends('layouts.master')

@section('content')
<div class="account-content pt-100 pb-40">
	@include('includes.account-logs', [
		'user' => $user,
		'logs' => $logs,
		'paginate' => true
	])
</div>
@endsection
