<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> Hash::make('qwerty123')
        ]);

        $user2 = User::create([
            'name'=> 'create',
            'email'=> 'create@gmail.com',
            'password'=> Hash::make('qwerty123')
        ]);

        $user3 = User::create([
            'name'=> 'update',
            'email'=> 'update@gmail.com',
            'password'=> Hash::make('qwerty123')
        ]);

        $user4 = User::create([
            'name'=> 'delete',
            'email'=> 'delete@gmail.com',
            'password'=> Hash::make('qwerty123')
        ]);

        $roleNames = ['admin', 'create', 'update', 'delete'];
        $roles = [];

        foreach ($roleNames as $roleName) {
            $roles[$roleName] = Role::create(['name' => $roleName]);
        }

        $rolePermissions = [
            'create' => ['post.create', 'post.store','post.index'],
            'update' => ['post.edit', 'post.update','post.index'],
            'delete' => ['post.destroy','post.index'],
        ];

        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $routeName = $route->getName();
            if ($routeName && !str_starts_with($routeName, 'generated::') && $routeName !== 'storage.local') {
                
                $permission = Permission::firstOrCreate(['name' => $routeName]);

                foreach ($roles as $roleName => $role) {
                    if ($roleName === 'admin' || in_array($routeName, $rolePermissions[$roleName] ?? [])) {
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }

        $user1->assignRole('admin');
        $user2->assignRole('create');
        $user3->assignRole('update');
        $user4->assignRole('delete');
        
        $this->call([
            PostSeeder::class,
        ]);
    }
}
