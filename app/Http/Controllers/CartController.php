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

        return view('cart.checkout', compact('items', 'total'));
    }

    public function checkoutProcess(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customers.login')->with('error', 'Please log in as a customer to checkout.');
        }

        // Validate form inputs
        $validated = $request->validate([
            'bill_name' => 'required|string|max:255',
            'bill_phone' => 'required|string|max:20',
            'bill_email' => 'required|email',
            'bill_address' => 'required|string|max:500',
            'recv_name' => 'required|string|max:255',
            'recv_phone' => 'required|string|max:20',
            'recv_email' => 'required|email',
            'recv_address' => 'required|string|max:500',
            'payment_method' => 'required|in:card,tng,shopee,grab',
            'agree_terms' => 'required|accepted',
        ]);

        $cart = $this->getCart();
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            $customer = Auth::guard('customer')->user();
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

            $latestSaleId = null;
            $orderNumber = 'ORD-' . now()->format('YmdHis') . '-' . $customer->id;

            DB::transaction(function () use ($cart, $products, $customer, $validated, &$latestSaleId, $orderNumber) {
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

                    $sale = Sale::create([
                        'order_number' => $orderNumber,
                        'artisan_id' => $product->artisan_id,
                        'product_id' => $product->id,
                        'customer_id' => $customer->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'total_price' => $totalPrice,
                        'sale_date' => now()->toDateString(),
                        'payment_status' => 'paid',
                        'payment_method' => $validated['payment_method'],
                        'billing_name' => $validated['bill_name'],
                        'billing_phone' => $validated['bill_phone'],
                        'billing_email' => $validated['bill_email'],
                        'billing_address' => $validated['bill_address'],
                        'receiver_name' => $validated['recv_name'],
                        'receiver_phone' => $validated['recv_phone'],
                        'receiver_email' => $validated['recv_email'],
                        'receiver_address' => $validated['recv_address'],
                        'notes' => 'Online cart purchase',
                    ]);

                    // Keep track of the first sale ID to show as current order
                    if ($latestSaleId === null) {
                        $latestSaleId = $sale->id;
                    }

                    $product->decreaseStock($quantity);
                }
            });

            // Clear cart after successful checkout
            $this->saveCart([]);

            // Redirect to order confirmation/detail page showing the latest order
            return redirect()->route('customers.order', [$customer->id, $latestSaleId])
                ->with('success', 'Thank you! Your order has been placed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('cart.checkout')->withErrors(['checkout' => 'An error occurred during checkout. Please try again.']);
        }
    }
}
