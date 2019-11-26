<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\User;
use App\Role;

class UsersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment(['local'])) {
            $user = new User([
                'name' => 'Dummy',
                'email' => 'dummy@dummy.com',
                'email_verified_at' => Carbon::now(),
                'cp_refilled_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'credit_point' => 0,
            ]);
            $role = Role::where('label', 'Administrator')->first();
            $user->role()->associate($role);
            $user->save();

            $user = new User([
                'name' => 'Owner',
                'email' => 'owner@dummy.com',
                'email_verified_at' => Carbon::now(),
                'cp_refilled_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'credit_point' => 0,
            ]);
            $role = Role::where('label', 'Owner')->first();
            $user->role()->associate($role);
            $user->save();

            $user = new User([
                'name' => 'Premium',
                'email' => 'premium@dummy.com',
                'email_verified_at' => Carbon::now(),
                'cp_refilled_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'credit_point' => 40,
            ]);
            $role = Role::where('label', 'Premium User')->first();
            $user->role()->associate($role);
            $user->save();

            $user = new User([
                'name' => 'Regular',
                'email' => 'regular@dummy.com',
                'email_verified_at' => Carbon::now(),
                'cp_refilled_at' => Carbon::now(),
                'password' => bcrypt('12345678'),
                'credit_point' => 20,
            ]);
            $role = Role::where('label', 'Regular User')->first();
            $user->role()->associate($role);
            $user->save();
        }
    }
}
