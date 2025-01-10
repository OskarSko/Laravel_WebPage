@extends('layouts.app')

@section('title', 'Welcome to Shop')

@section('content')
<div class="text-center">
    <h1 class="display-4">Welcome to Our Shop</h1>
    <p class="lead">Discover the best products for your home and life!</p>
    <a href="/products" class="btn btn-primary btn-lg">Browse Products</a>
</div>

<div class="row mt-5">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">High-Quality Products</h5>
                <p class="card-text">We offer a wide range of high-quality electronics and appliances.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Affordable Prices</h5>
                <p class="card-text">Find the best deals and competitive prices for all our products.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Excellent Support</h5>
                <p class="card-text">Our team is here to assist you with any questions or issues.</p>
            </div>
        </div>
    </div>
</div>
@endsection
