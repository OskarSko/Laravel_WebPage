@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h5>Categories</h5>
            <ul class="list-group">
                <li class="list-group-item {{ request('category') ? '' : 'active' }}">
                    <a href="{{ route('products.index') }}">All Products</a>
                </li>
                @foreach ($categories as $category)
                    <li class="list-group-item {{ request('category') == $category->id ? 'active' : '' }}">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="my-4">Products</h1>

                @if (Auth::check() && in_array(Auth::user()->role, ['employee', 'admin']))
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal">
                        Create Product
                    </button>
                @endif
            </div>

            <form method="GET" action="{{ route('products.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search products by name..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            @if ($products->isEmpty())
                <p>No products found for this category.</p>
            @else
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <p><strong>Price:</strong> ${{ $product->price }}</p>
                                        <p><strong>Stock:</strong> {{ $product->stock }}</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-info mb-2">Details</a>
                                        <form action="{{ route('products.buy.now', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mb-2">Buy</button>
                                        </form>
                                        <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Add to Cart</button>
                                        </form>
                                        @if (Auth::check() && in_array(Auth::user()->role, ['employee', 'admin']))
                                            <button type="button" class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}">
                                                Edit
                                            </button>
                                        @endif
                                        @if (Auth::check() && Auth::user()->role === 'admin')
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-2">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel-{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel-{{ $product->id }}">Edit Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name-{{ $product->id }}" class="form-label">Product Name</label>
                                                <input type="text" id="name-{{ $product->id }}" name="name" class="form-control" value="{{ $product->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description-{{ $product->id }}" class="form-label">Description</label>
                                                <textarea id="description-{{ $product->id }}" name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price-{{ $product->id }}" class="form-label">Price</label>
                                                <input type="number" id="price-{{ $product->id }}" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="stock-{{ $product->id }}" class="form-label">Stock</label>
                                                <input type="number" id="stock-{{ $product->id }}" name="stock" class="form-control" value="{{ $product->stock }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category_id-{{ $product->id }}" class="form-label">Category</label>
                                                <select id="category_id-{{ $product->id }}" name="category_id" class="form-select" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @if ($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
