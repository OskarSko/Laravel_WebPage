@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="text-center mt-5">
    <h1 class="display-4">Thank You for Your Purchase!</h1>
    <p>Your order has been successfully placed.</p>
    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-4">Back to Home</a>
</div>
@endsection
