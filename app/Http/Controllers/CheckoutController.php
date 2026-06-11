<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Simpan cart dari localStorage ke Laravel session.
     * Dipanggil via fetch() dari bloom.js sebelum redirect ke halaman checkout.
     * POST /checkout/session
     */
    public function storeSession(Request $request)
    {
        $request->validate([
            'cart'             => 'required|array|min:1',
            'cart.*.id'        => 'required',
            'cart.*.name'      => 'required|string',
            'cart.*.price'     => 'required|numeric|min:0',
            'cart.*.quantity'  => 'required|integer|min:1',
        ]);

        // Simpan ke session dengan format yang sama seperti yang dipakai index() dan process()
        session(['cart' => $request->cart]);

        return response()->json(['success' => true]);
    }

    /**
     * Tampilkan halaman checkout.
     * GET /checkout
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')
                ->with('info', 'Keranjangmu kosong. Silakan pilih menu terlebih dahulu.');
        }

        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $tax      = round($subtotal * 0.11);
        $total    = $subtotal + $tax;

        return view('pages.checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    /**
     * Proses order dan simpan ke database.
     * POST /checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('menu.index')
                ->with('error', 'Sesi keranjang telah habis. Silakan ulangi pemesanan.');
        }

        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $tax      = round($subtotal * 0.11);
        $total    = $subtotal + $tax;

        $order = Order::create([
            'order_id'       => 'BLM-' . date('Y') . '-' . rand(1000, 9999),
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'notes'          => $request->notes,
            'items'          => $cart,
            'subtotal'       => $subtotal,
            'tax'            => $tax,
            'total'          => $total,
            'payment_method' => 'QRIS',
            'status'         => 'paid',
        ]);

        // Hapus cart dari session setelah order berhasil
        session()->forget('cart');

        return redirect()->route('receipt.show', $order->order_id);
    }
}