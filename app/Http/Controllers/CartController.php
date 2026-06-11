<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function add(Request $request) {
        $menu = Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$menu->id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->image,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true, 'count' => array_sum(array_column($cart, 'quantity'))]);
    }

    public function remove(Request $request) {
        $cart = session()->get('cart', []);
        unset($cart[$request->menu_id]);
        session()->put('cart', $cart);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function update(Request $request) {
        $cart = session()->get('cart', []);
        if (isset($cart[$request->menu_id])) {
            if ($request->quantity <= 0) {
                unset($cart[$request->menu_id]);
            } else {
                $cart[$request->menu_id]['quantity'] = $request->quantity;
            }
        }
        session()->put('cart', $cart);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return response()->json(['success' => true, 'cart' => $cart, 'total' => $total]);
    }

    public function count() {
        $cart = session()->get('cart', []);
        return response()->json(['count' => array_sum(array_column($cart, 'quantity'))]);
    }

    public function items() {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return response()->json(['cart' => $cart, 'total' => $total]);
    }
}