<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $table="admins";

    protected $fillable= [
         'name',
         'email',
        'password'
    ];

    public function setName($name){
        return $this->name=$name;
    }
    public function setEmail($email){
        return $this->email = $email;
    }
    public function setPassword($password){
        return $this->password =$password;
    }
}
