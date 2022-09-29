<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\{Hash, Validator};
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $validator = Validator::make($input, [
            'current_password'  =>   'required',
            'password'  =>   'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user->forceFill([
            'password' => $input['password'],
        ])->save();
    }
}
