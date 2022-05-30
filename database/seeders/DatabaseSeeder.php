<?php

namespace Database\Seeders;

use App\Models\Pos;
use App\Models\User;
use App\Models\Area;
use App\Models\Sector;
use App\Models\Product;
use App\Models\Routing;
use App\Models\ProductVisit;
use App\Models\Role;

/**
 * use Spatie\Models\Role
 */

use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $roles = Role::factory(4)->create();
        $roles = $roles->all();
        $users = User::factory(10)->create();
        foreach($users as $user)
        {
            $user->assignRole($roles[rand(0,3)]->name);
        }

        Area::factory(15)->create();
        Sector::factory(25)->create();
        Routing::factory(30)->create();
        Pos::factory(130)->create();
        Product::factory(135)->create();
        Visit::factory(220)->create();
        ProductVisit::factory(250)->create();
    }
}
