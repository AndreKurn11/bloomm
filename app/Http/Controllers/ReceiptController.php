<?php
namespace App\Http\Controllers;
use App\Models\Order;

class ReceiptController extends Controller {
    public function show($orderId) {
        $order = Order::where('order_id', $orderId)->firstOrFail();
        return view('pages.receipt', compact('order'));
    }
}