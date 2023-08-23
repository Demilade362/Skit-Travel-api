<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Role::create(['name' => 'admin']);
        // $user = User::create(
        //     [
        //         'name' => 'admin',
        //         'email' => 'adminskit@email.com',
        //         'password' => 'adminpassword',
        //         'email_verified_at' => Carbon::now()
        //     ]
        // );
        $user = User::where('email', 'adminskit@email.com')->first();
        $user->assignRole('admin');

        // Permission::create(["name" => "create destination"]);
        // Permission::create(["name" => "update destination"]);
        // Permission::create(['name' => 'delete destination']);
        // Permission::create(['name' => 'create flight']);
        // Permission::create(['name' => 'update flight']);
        // Permission::create(['name' => 'delete flight']);
        // Permission::create(['name' => 'create hotel']);
        // Permission::create(['name' => 'update hotel']);
        // Permission::create(['name' => 'delete hotel']);


        $role = Role::findByName('admin');
        $role->givePermissionTo('create destination');
        $role->givePermissionTo('update destination');
        $role->givePermissionTo('delete destination');
        $role->givePermissionTo('create flight');
        $role->givePermissionTo('update flight');
        $role->givePermissionTo('delete flight');
        $role->givePermissionTo('create hotel');
        $role->givePermissionTo('update hotel');
        $role->givePermissionTo('delete hotel');
    }
}
