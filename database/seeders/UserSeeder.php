<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'nom' => 'admin',
        //     'prenom' => '',
        //     'email' => 'admin@gmail.com',
        //     'fonction' => 'fonction',
        //     'password' => Hash::make('1234'),
        // ]);

        // DB::table('users')->insert([
        //     'nom' => 'jobs',
        //     'prenom' => '',
        //     'email' => 'jobs@gmail.com',
        //     'fonction' => 'fonction',
        //     'password' => Hash::make('1234'),
        // ]);

        $user = User::create([
            'nom' => 'Admin',
            'prenom' => 'jobs',
            'email' => 'admin@jobs-conseil.com',
            'fonction' => 'Super admin',
            'password' => Hash::make('admin@2023'),
        ]);

        // DB::table('users')->insert([
        //     'nom' => 'wilfried',
        //     'prenom' => '',
        //     'email' => 'wilfried@gmail.com',
        //     'fonction' => 'fonction',
        //     'password' => Hash::make('1234'),
        // ]);

        $role = Role::create(['name' => 'Super admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
