@extends('profile.layout')

@section('profile-content')
<div class="container">
    <h3 class="mb-4">Personal Data</h3>

    <!-- Dane użytkownika -->
    <div class="mb-4">
        <h5>User Information</h5>
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <!-- Adresy użytkownika -->
    <div class="mb-4">
        <h5>Addresses</h5>
        @if ($addresses->isEmpty())
            <p>No addresses found.</p>
        @else
            <ul class="list-group">
                @foreach ($addresses as $address)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $address->type }}</strong>: {{ $address->address_line }}, {{ $address->city }}, {{ $address->postal_code }}
                        </div>
                        <div>
                            <!-- Przycisk edycji -->
                            <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this address?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Przycisk dodania adresu -->
    <div class="mb-4">
        <a href="{{ route('addresses.create') }}" class="btn btn-primary">Add Address</a>
    </div>
</div>
@endsection
