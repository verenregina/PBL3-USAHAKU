@extends('layouts.app')

@section('content')
<h1>Dashboard Admin</h1>
<p>Selamat datang Admin, {{ auth()->user()->name }}</p>
@endsection