@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Profile</h1>
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile/orders') ? 'active' : '' }}" href="{{ route('profile.orders') }}">Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile/data') ? 'active' : '' }}" href="{{ route('profile.data') }}">Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('profile/settings') ? 'active' : '' }}" href="{{ route('profile.settings') }}">Settings</a>
        </li>
    </ul>
    @yield('profile-content')
</div>
@endsection
