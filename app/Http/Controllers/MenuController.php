<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller {
    public function index(Request $request) {
        $categories = Category::all();
        $categorySlug = $request->get('category', 'semua');

        $query = Menu::with('category')->where('is_available', true);
        if ($categorySlug !== 'semua') {
            $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
        }
        $menus = $query->get();

        return view('pages.menu.index', compact('menus', 'categories', 'categorySlug'));
    }

    public function show($slug) {
        $menu = Menu::where('slug', $slug)->with('category')->firstOrFail();
        $related = Menu::where('category_id', $menu->category_id)
                       ->where('id', '!=', $menu->id)->take(3)->get();
        return view('pages.menu.show', compact('menu', 'related'));
    }
}