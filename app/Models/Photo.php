<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function property(){
    //     return $this->belongsTo(Property::class);
    // }
    public $directory = "/images/";

    public function getFileAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return $this->directory . $value;
        //return asset('storage/app/' . $value);
        }

        public function property(){
            return $this->belongsTO(Property::class);
        }
}
