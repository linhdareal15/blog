<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<100;$i++){
            $user = new User;
            $user->name = "Vu Hoang ".$i;
            $user->email = "email".$i."@gmail.com";
            $user->password = "Admin123";
            $user->save();
        }
    }
}
