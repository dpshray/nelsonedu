<?php

namespace Database\Seeders;

use App\Constants\Constants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->truncate();

        // $users = [
        //     [
        //         'name' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => '$2y$12$46WSVa5/V35SFehIF.gSSeUYESWvj7nJg3r92d7UCu08zk.6sN65C', // testing123
        //         'email_verified_at' => now(),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'Teacher',
        //         'email' => 'teacher@gmail.com',
        //         'password' => '$2y$12$46WSVa5/V35SFehIF.gSSeUYESWvj7nJg3r92d7UCu08zk.6sN65C',
        //         'email_verified_at' => now(),
        //         'created_at' => now(),
        //     ],
        //     [
        //         'name' => 'Student',
        //         'email' => 'student@gmail.com',
        //         'password' => '$2y$12$46WSVa5/V35SFehIF.gSSeUYESWvj7nJg3r92d7UCu08zk.6sN65C',
        //         'email_verified_at' => now(),
        //         'created_at' => now(),
        //     ],

        // ];

        // DB::table('users')->insert($users);

        $admin = User::where(['name' => 'Admin'])->first();
        $admin->assignRole(Constants::ROLE_ADMIN);

        $teacher = User::where(['name' => 'Teacher'])->first();
        $teacher->assignRole(Constants::ROLE_TEACHER);

        $student = User::where(['name' => 'Student'])->first();
        $student->assignRole(Constants::ROLE_STUDENT);
    }
}
