@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Dashboard Karyawan</h1>
    <p>Selamat datang, {{ Auth::user()->username }}!</p>
</div>
@endsection
