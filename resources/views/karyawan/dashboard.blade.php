@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Dashboard Karyawan</h1>
    <p>Selamat datang, {{ Auth::user()->username }}!</p>
</div>
@endsection
