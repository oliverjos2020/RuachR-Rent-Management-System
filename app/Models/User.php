<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name','email','phone','password','avatar','shop_name','address','cac','status','verify','shop_slug','logo','banner'
    ];

    public $directory = "/images/";
    public $document = "/cac/";
    // public $logo = "/images/";
    // public $banner = "/images/";

    // public function getAvatarAttribute($value){

    //     return $this->directory . $value;

    // }

       public function getAvatarAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return $this->directory . $value;
        //return asset('storage/app/' . $value);
        }

        public function getCacAttribute($value) {
            if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
                return $value;
            }
            return $this->directory . $value;
            //return asset('storage/app/' . $value);
            }

            public function getLogoAttribute($value) {
                if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
                    return $value;
                }
                return $this->directory . $value;
                //return asset('storage/app/' . $value);
                }

                public function getBannerAttribute($value) {
                    if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
                        return $value;
                    }
                    return $this->directory . $value;
                    //return asset('storage/app/' . $value);
                    }

    public function SetPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function permissions(){
        
        return $this->belongsToMany(Permission::class);
    }

    public function roles(){
        
        return $this->belongsToMany(Role::class);
    }

        public function reviews(){
        
        return $this->hasMany(Review::class);
    }
    public function biodatas(){
        
        return $this->hasOne(Biodata::class);
    }
    public function carts(){
        
        return $this->hasMany(Cart::class);
    }

    public function chats(){
        
        return $this->hasMany(Chat::class);
    }

    public function accounts(){
        
        return $this->hasMany(Account::class);
    }

    public function userHasRole($role_name){

        foreach($this->roles as $role){
            if(Str::lower($role_name) == Str::lower($role->name))
            return true;
        }
        return false;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
