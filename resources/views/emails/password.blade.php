@extends('layouts.email')

@section('content')
Follow this link to reset your password: {{ url('password/reset/'.$token) }}
@endsection
