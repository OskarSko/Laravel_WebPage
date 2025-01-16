@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <!-- Action Buttons -->
    <div class="mb-4">
        <form action="{{ route('products.buy', ['product' => $product->id]) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary">Buy Now</button>
        </form>
        <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-secondary">Add to Cart</button>
        </form>
        <a href="{{ route('products.index') }}" class="btn btn-info">Back to Products</a>
    </div>

    <!-- Reviews Section -->
    <h3 class="mt-4">Customer Reviews</h3>
    @if ($product->reviews->isEmpty())
        <p>No reviews yet. Be the first to leave a review!</p>
    @else
        <ul class="list-group mb-4">
            @foreach ($product->reviews as $review)
                <li class="list-group-item">
                    <strong>{{ $review->user->name }}</strong> 
                    <span class="text-muted">- {{ $review->created_at->format('M d, Y') }}</span>
                    <p>Rating: 
                        <span class="text-warning">
                            {{ str_repeat('★', $review->rating) }}
                            {{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </p>
                    <p>{{ $review->comment }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Add Review Section -->
    @auth
        <h3>Add a Review</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select id="rating" name="rating" class="form-select" required>
                    <option value="5">★★★★★ - Excellent</option>
                    <option value="4">★★★★☆ - Good</option>
                    <option value="3">★★★☆☆ - Average</option>
                    <option value="2">★★☆☆☆ - Poor</option>
                    <option value="1">★☆☆☆☆ - Terrible</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Write your review..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> to leave a review.</p>
    @endauth
</div>
@endsection
