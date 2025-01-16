@extends('layouts.app')

@section('title', 'Edit Address')

@section('content')
<h3>Edit Address</h3>
<form method="POST" action="{{ route('addresses.update', $address->id) }}">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" name="city" class="form-control" value="{{ $address->city }}" required>
    </div>
    <div class="mb-3">
    <label for="address_line" class="form-label">Address Line</label>
    <input type="text" name="address_line" class="form-control" value="{{ $address->address_line }}" required>
</div>
    <div class="mb-3">
        <label for="postal_code" class="form-label">Postal Code</label>
        <input type="text" name="postal_code" class="form-control" value="{{ $address->postal_code }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Address</button>
</form>
@endsection
