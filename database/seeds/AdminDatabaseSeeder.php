<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Muhanad Aisami',
            'email'=>'werk8562@gmail.com',
            'password'=>bcrypt('12345678'),

        ]);
    }
}
