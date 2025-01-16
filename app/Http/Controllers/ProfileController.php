<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Address;
class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Pobieranie zamówień z relacją do produktów w order_items
        $orders = Order::where('user_id', $user->id)->with('items.product')->get();

        return view('profile.edit', compact('user', 'orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return back()->with('status', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect('/')->with('status', 'Account deleted successfully!');
    }
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('items.product')->get();

        return view('profile.orders', compact('user', 'orders'));
    }

    // Wyświetlanie zakładki Dane
    public function data()
    {
        $user = Auth::user();
        $addresses = $user->addresses;
        //$addresses = Address::where('user_id', $user->id)->get();

        return view('profile.data', compact('user', 'addresses'));
    }

    // Wyświetlanie zakładki Ustawienia
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }


}
