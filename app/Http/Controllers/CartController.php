<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;

class CartController extends Controller
{
    protected function getCart()
    {
        return session()->get('cart', []);
    }

    protected function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    public function index()
    {
        $cart = $this->getCart();
        $productIds = array_keys($cart);
        $products = $productIds ? Product::whereIn('id', $productIds)->get()->keyBy('id') : collect();

        $items = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = $products->get($productId);
            if (!$product) {
                continue;
            }

            $quantity = max(1, (int) ($item['quantity'] ?? 1));
            $unitPrice = $product->price;
            $lineTotal = $unitPrice * $quantity;
            $total += $lineTotal;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'total' => $lineTotal,
            ];
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = (int) ($validated['quantity'] ?? 1);

        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
            ];
        }

        $this->saveCart($cart);

        return redirect()->route('cart.index')->with('success', 'Product added to your cart.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = (int) $validated['quantity'];
            $this->saveCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove(Product $product)
    {
        $cart = $this->getCart();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            $this->saveCart($cart);
        }

        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customers.login')->with('error', 'Please log in as a customer to checkout.');
        }

        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            $customer = Auth::guard('customer')->user();
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            DB::transaction(function () use ($cart, $products, $customer) {
                foreach ($cart as $productId => $item) {
                    $product = $products->get($productId);
                    if (!$product) {
                        continue;
                    }

                    $quantity = max(1, (int) ($item['quantity'] ?? 1));
                    if ($quantity > $product->stock) {
                        $quantity = $product->stock;
                    }
                    if ($quantity <= 0) {
                        continue;
                    }

                    $unitPrice = $product->price;
                    $totalPrice = $unitPrice * $quantity;

                    Sale::create([
                        'artisan_id' => $product->artisan_id,
                        'product_id' => $product->id,
                        'customer_id' => $customer->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'total_price' => $totalPrice,
                        'sale_date' => now()->toDateString(),
                        'payment_status' => 'paid',
                        'notes' => 'Online cart purchase',
                    ]);

                    $product->decreaseStock($quantity);
                }
            });

            // Clear cart after successful checkout
            $this->saveCart([]);

            return redirect()->route('customers.history', Auth::guard('customer')->user()->id)
                ->with('success', 'Thank you! Your order has been placed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->withErrors(['checkout' => 'An error occurred during checkout. Please try again.']);
        }
    }
}
