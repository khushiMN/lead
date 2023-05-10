<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        User::insert([
            'name'=>'admin',
            'phone_no'=>'+191234567890',
            'email' =>'admin@gmail.com',
            'password'=>Hash::make('admin'),
            'role'=>'admin',
            'created_at'=> Carbon::now(),
        ]);
    }
}
