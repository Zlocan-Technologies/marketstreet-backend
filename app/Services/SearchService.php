<?php

namespace App\Services;

use App\Models\User;

class SearchService
{

    public $query;

    public function __construct($query){
        $this->query = $query;
    }


    public function findUsers(){
        $query = $this->query;
        $users = User::latest()->where('isBlocked', false)
                    ->where(function($item) use ($query){
                        $item->where('firstname', 'like', '%'.$query.'%')
                                ->orWhere('lastname', 'like', '%'.$query.'%')
                                ->orWhere('email', 'like', '%'.$query.'%')
                                ->orWhere('phone', 'like', '%'.$query.'%');
                        })->paginate(10);
                
        return $users;
    }

    public function findBlockedUsers(){
      
        $query = $this->query;
        $users = User::latest()->where('isBlocked', true)
                    ->where(function($item) use ($query){
                        $item->where('firstname', 'like', '%'.$query.'%')
                                ->orWhere('lastname', 'like', '%'.$query.'%')
                                ->orWhere('email', 'like', '%'.$query.'%')
                                ->orWhere('phone', 'like', '%'.$query.'%');
                        })->paginate(10);
                         
        return $users;
    }


   

}