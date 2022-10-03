<?php

namespace App\Actions\Fortify;

use Carbon\Carbon;
use App\Mail\VerifyAccountMail;
use App\Models\{User};
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\{DB, Mail};

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'firstname' => $input['firstname'],
                'lastname' => $input['lastname'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => $input['password'],
                'email_verified_at' => Carbon::now()
            ]), function (User $user) use ($input) {

                //if($input['user_type'] != "admin"):
                    $user->profile()->create([]);

                    $code = mt_rand(1000, 9999);
                    DB::table('user_verification')
                    ->insert([
                        'email' => $user->email, 
                        'code' => $code, 
                        'expiry_time' => Carbon::now()->addMinutes(6)
                    ]);

                    DB::table('newsletter')
                    ->insert([
                        'email' => $user->email
                    ]);

                    /*Mail::to($user->email)
                        ->send(new VerifyAccountMail($user, $code));*/
                //endif;
            });
        });
    }
}
