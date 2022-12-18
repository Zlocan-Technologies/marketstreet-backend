<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $new_admin = new Admin();
        $new_admin->setName('admin');
        $new_admin->setEmail('test@email.com');
        $new_admin->setPassword(Hash::make('password'));

        $new_admin->save();

    }
}
