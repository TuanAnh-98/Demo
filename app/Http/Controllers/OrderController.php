<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paymentMethod' => 'required|string',
        ]);

        $cart = session('cart', []);
        $totalAmount = session('cartTotal', 0);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'payment_method' => $validated['paymentMethod'],
            'payment_status' => 'pending',
        ]);

        $productsToAttach = [];
        foreach ($cart as $productId => $details) {
            $productsToAttach[] = [
                'product_id' => $productId,
                'imageUrl' => $details['imageUrl'],
                'name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ];
        }

        $order->update([
            'products' => json_encode($productsToAttach, JSON_PRETTY_PRINT)
        ]);

        session()->forget('cart');
        session()->forget('cartTotal');

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    public function showCreateForm()
    {
        $cart = session('cart', []);

        $totalPrice = 0;
        foreach ($cart as $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        session(['cartTotal' => $totalPrice]);
        return view('orders.create');
    }
    public function index()
    {
        $orders = Order::with('user')->get();

        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->payment_status = $request->input('payment_status');
        $order->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
