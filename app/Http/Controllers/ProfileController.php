<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
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
}
