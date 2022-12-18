<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'fcm_token',
        'photo',
        'isBlocked'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'two_factor_confirmed_at',
        'created_at',
        'updated_at',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $with = ['profile', 'bankDetail'];

    protected function firstname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    protected function lastname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => ucwords(strtolower($value)),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => strtolower($value),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value),
        );
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function bankDetail()
    {
        return $this->hasOne(BankAccount::class);
    }

    public function subOrders()
    {
        return $this->hasMany(SubOrder::class, 'seller_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }






    // getters and setters


    public function setFirstname($firstname){
        return $this->firstname= $firstname;
    }
    public function getFirstname(){
        return $this->firstname;
    }

    public function setLastName($lastname){
        return $this->lastname= $lastname;
    }
    public function getLastName(){
        return $this->lastname;
    }

    public function setEmail($email){
        return $this->email=$email;
    }

    //
    public function getPhone(){
        return $this->phone;
    }
    public function setPhone($phone){
        return $this->phone=$phone;
    }

    //
    public function setPassword($password){
        return $this->password= $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setFcmToken($fcm_token){
        return $this->fcm_token=$fcm_token;
    }
    public function getFcmToken(){
        return $this->fcm_token;
    }

    public function setPhoto($photo){
        return $this->photo=$photo;
    }
    public function getPhoto(){
        return $this->photo;
    }



}
