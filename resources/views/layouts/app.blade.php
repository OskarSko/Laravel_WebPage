<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shop')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/accessibility.css') }}">
    <script src="{{ asset('js/accessibility.js') }}" defer></script>


</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="{{ route('home') }}">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">Cart</a></li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-warning" href="{{ route('register') }}">Register</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.orders') }}">Profile</a></li>
                                    @if (Auth::user()->role === 'admin')
        <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Manage Users</a></li>
    @endif
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <div class="d-flex justify-content-end mt-2">
    <button id="increaseFont" class="btn btn-outline-light btn-sm me-2">A+</button>
    <button id="decreaseFont" class="btn btn-outline-light btn-sm me-2">A-</button>
</div>
        </div>
    </header>
    <main class="container my-4">
        @yield('content')
    </main>
    <footer class="bg-dark text-white text-center py-3">
        &copy; {{ date('Y') }} Shop
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/accessibility.js') }}"></script>
</body>
</html>
