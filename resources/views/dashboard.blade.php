@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<h1 class="h3">Bienvenido, {{ session('login_usuario') }}</h1>
@endsection