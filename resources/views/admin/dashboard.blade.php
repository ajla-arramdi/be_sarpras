@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-4">Welcome, Admin!</h2>
    <p class="text-gray-700">You are logged in as <strong>{{ Auth::user()->name }}</strong></p>
</div>
@endsection
