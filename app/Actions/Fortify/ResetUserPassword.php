<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\{DB, Hash, Validator};
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        $user->forceFill([
            'password' => $input['password'],
        ])->save();

        DB::table('password_resets')
        ->where([
            'email' => $input['email']
        ])->delete();
    }
}
