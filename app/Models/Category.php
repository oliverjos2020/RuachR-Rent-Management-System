<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $directory = "/images/";

    public function getCategoryImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return $this->directory . $value;
        //return asset('storage/app/' . $value);
        }

        // public function products()
        // {
        //     return $this->hasMany(Product::class);
        // }

        // public function products()
        // {
        //     return $this->belongsToMany(Product::class);
        // }
        

        public function products()
        {
            return $this->belongsToMany(Product::class, 'category_product');
        }

        

//         public function products()
// {
//     return $this->belongsToMany(Product::class, 'category_products', 'category_id', 'product_id');
// }


}
