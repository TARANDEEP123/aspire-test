<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 * @package Database\Seeders
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run ()
    {
        $this->call([
            UserSeeder::class,
            UserTypeSeeder::class,
            LookupTypeSeeder::class,
            LookupValueSeeder::class,
            LoanTypeSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
