<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_line' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
        ]);
    
        $validated['user_id'] = Auth::id();
        Address::create($validated);
    
        return redirect()->route('profile.data')->with('success', 'Address added successfully.');
    }

    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'address_line' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
        ]);

        $address->update($validated);
    
        return redirect()->route('profile.data')->with('success', 'Address updated successfully.');
    }
    public function destroy(Address $address)
{
    if ($address->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    $address->delete();

    return redirect()->route('profile.data')->with('success', 'Address deleted successfully.');
}

}
