<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('role_user')->delete();
        
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        
        $admin = User::create([
           'name' => 'admin',
           'email' => 'gaspar@example.com',
           'password' => Hash::make('abc12345')
        ]); 
        $user = User::create([
           'name' => 'user',
           'email' => 'darwin@example.com',
           'password' => Hash::make('abc12345')
        ]); 
        
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
        
        factory(App\User::class, 50)->create();
    }
}
