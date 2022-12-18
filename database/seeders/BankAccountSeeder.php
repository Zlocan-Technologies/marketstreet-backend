<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BankAccount;
use Illuminate\Support\Str;


class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20; $i++) { 
            BankAccount::create([
                'account_name' => Str::random(12),
                'account_number' => Str::random(12),
                'bank_name' => 'test bank',
                'bank_code' => rand(100, 999),
                'user_id' =>  $i
            ]);
        }
    }
}
