<?php
namespace App\Http\Controllers;
use App\Models\Menu;

class HomeController extends Controller {
    public function index() {
        $featuredMenus = Menu::whereNotNull('badge')
                             ->with('category')
                             ->take(4)
                             ->get();
        return view('pages.home', compact('featuredMenus'));
    }
}