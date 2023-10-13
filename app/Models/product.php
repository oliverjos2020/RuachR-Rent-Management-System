<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $directory = "/images/";

    public function getFeaturedImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return $this->directory . $value;
        //return asset('storage/app/' . $value);
        }

        public function user(){
            return $this->belongsTo(User::class);
        }
        public function photo(){
            return $this->hasMany(Photo::class);
        }
        public function category(){
            return $this->belongsTo(Category::class);
        }
        public function cart(){
            return $this->belongsTo(Cart::class);
        }

        public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class, 'product_id');
}
}
