<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTypeSeeder
 * @package Database\Seeders
 */
class UserTypeSeeder extends Seeder
{
    /**
     * @var array
     */
    private $data = array(
        [
            'type' => 'Admin'
        ],
        [
            'type' => 'Customer'
        ],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        UserType::insert($this->data);
    }
}
