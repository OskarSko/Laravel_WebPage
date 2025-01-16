@extends('profile.layout')

@section('profile-content')
<h3>Settings</h3>


<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

<hr class="my-4">


<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary">Change Password</button>
</form>

<hr class="my-4">


<form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirmDeleteAccount();">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">Delete Account</button>
</form>
@endsection
