@extends('layouts.app')

@section('title', 'Add Address')

@section('content')
<h3>Add Address</h3>
<form method="POST" action="{{ route('addresses.store') }}">
    @csrf
    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" name="city" class="form-control" required>
    </div>
    <div class="mb-3">
    <label for="address_line" class="form-label">Address Line</label>
    <input type="text" name="address_line" class="form-control" required>
</div>
    <div class="mb-3">
        <label for="postal_code" class="form-label">Postal Code</label>
        <input type="text" name="postal_code" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Address</button>
</form>
@endsection
