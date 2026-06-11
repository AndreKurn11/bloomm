<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'long_description',
        'price', 'original_price', 'image', 'badge', 'is_available', 'is_featured'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getFormattedPriceAttribute() {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}