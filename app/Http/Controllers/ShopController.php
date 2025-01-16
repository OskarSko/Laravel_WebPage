<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ProductPromotion;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\User;
use App\Models\CartItem;

class ShopController extends Controller
{  
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
    
        $query = Product::query();
    
        if ($request->has('category') && $request->input('category')) {
            $categoryId = $request->input('category');
            $query->where('category_id', $categoryId);
        }
    
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $products = $query->with('category')->get();
        $query->paginate(10)->appends($request->except('page'));
        $products = $query->paginate(10);
        return view('shop.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        
        $categories = Category::all();
        return view('shop.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::with('category', 'reviews.user')->findOrFail($id);
        return view('shop.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('shop.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        $product = Product::findOrFail($id);
        $product->update($validated);
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Display a listing of categories.
     */
    public function categories()
    {
        $categories = Category::all();
        return view('shop.categories.index', compact('categories'));
    }

    /**
     * Display a listing of orders.
     */
    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('shop.orders.index', compact('orders'));
    }

    /**
     * Display a listing of promotions.
     */
    public function promotions()
    {
        $promotions = Promotion::all();
        return view('shop.promotions.index', compact('promotions'));
    }

    public function buy(Request $request, $productId)
{
    $product = Product::findOrFail($productId);

    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock.');
    }

    $order = Order::create([
        'user_id' => Auth::id(),
        'total_price' => $product->price,
    ]);

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => 1,
        'price' => $product->price,
    ]);

    $product->decrement('stock', 1);

    return view('thankyou', ['order' => $order]);
    }

    public function addToCart(Request $request, $productId)
{
    $product = Product::findOrFail($productId);

    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'Product is out of stock and cannot be added to the cart.');
    }

    $cartItem = CartItem::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}

public function viewCart()
{
    $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

    return view('cart.index', compact('cartItems'));
}

public function checkout()
{
    $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
    }

    $totalPrice = $cartItems->sum(function ($cartItem) {
        return $cartItem->product->price * $cartItem->quantity;
    });

    $order = Order::create([
        'user_id' => Auth::id(),
        'total_price' => $totalPrice,
    ]);

    foreach ($cartItems as $cartItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);

        $cartItem->product->decrement('stock', $cartItem->quantity);
    }

    CartItem::where('user_id', Auth::id())->delete();

    session(['order_id' => $order->id]);
    return view('thankyou', compact('order'));
}



public function showOrder($orderId)
{
    $order = Order::with('items.product')->findOrFail($orderId);

    return view('shop.orders.show', compact('order'));
}

public function removeFromCart($cartItemId)
{
    $cartItem = CartItem::where('id', $cartItemId)->where('user_id', Auth::id())->first();

    if (!$cartItem) {
        return redirect()->route('cart.index')->with('error', 'Item not found in your cart.');
    }

    $cartItem->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
}
public function checkoutAddressPayment()
{
    $buyNowProduct = session('buy_now_product');
    $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

    if (!$buyNowProduct && $cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
    }

    $addresses = Address::where('user_id', Auth::id())->get();

    $paymentMethods = [
        'credit_card' => 'Credit Card',
        'paypal' => 'PayPal',
        'bank_transfer' => 'Bank Transfer',
    ];

    return view('shop.checkout.address-payment', compact('addresses', 'buyNowProduct', 'cartItems', 'paymentMethods'));
}

public function processPayment(Request $request)
{
    $request->validate([
        'address_id' => 'required|exists:addresses,id',
        'payment_method' => 'required|string',
    ]);

    $userId = Auth::id();
    $buyNowProduct = session('buy_now_product');
    $cartItems = CartItem::where('user_id', $userId)->with('product')->get();

    if ($buyNowProduct) {
        if ($buyNowProduct->stock <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }
    
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $buyNowProduct->price,
            'status' => 'pending',
        ]);
    
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $buyNowProduct->id,
            'quantity' => 1,
            'price' => $buyNowProduct->price,
        ]);
    
        $buyNowProduct->decrement('stock', 1);
    
        Payment::create([
            'order_id' => $order->id,
            'status' => 'completed',
            'amount' => $buyNowProduct->price,
            'payment_method' => $request->payment_method,
        ]);
    
        session()->forget('buy_now_product');
    
        return redirect()->route('thankyou')->with('order', $order);
    } else {
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        foreach ($cartItems as $cartItem) {
            if ($cartItem->quantity > $cartItem->product->stock) {
                return redirect()->route('cart.index')->with('error', "The product '{$cartItem->product->name}' does not have enough stock.");
            }
        }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $cartItem->product->decrement('stock', $cartItem->quantity);
        }

        Payment::create([
            'order_id' => $order->id,
            'status' => 'completed',
            'amount' => $totalPrice,
            'payment_method' => $request->payment_method,
        ]);

        CartItem::where('user_id', $userId)->delete();
    }

    return redirect()->route('thankyou')->with('order', $order);
}
public function storeReview(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ]);

    Review::create([
        'user_id' => auth()->id(),
        'product_id' => $request->product_id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Review added successfully!');
}
public function buyNowAddressPayment(Request $request, $productId)
{
    $product = Product::findOrFail($productId);

    if ($product->stock <= 0) {
        return redirect()->back()->with('error', 'This product is out of stock.');
    }

    session(['buy_now_product' => $product]);

    return redirect()->route('cart.checkout.address');
}
public function showAddresses()
{
    $addresses = Address::where('user_id', Auth::id())->get();

    return view('profile.addresses', compact('addresses'));
}



}



