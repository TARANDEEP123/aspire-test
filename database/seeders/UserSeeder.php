<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * @var array
     */
    private $data = array(
        [
            'id'       => 1,
            'name'     => "Aspire",
            'email'    => "admin@aspire.com",
            'password' => 'password',
            'address'  => 'Singapore',
        ],
        [
            'id'       => 2,
            'name'     => "Taran",
            'email'    => "taran@gmail.com",
            'password' => 'password',
            'address'  => 'India',
        ],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        for ( $i = 0; $i < count($this->data); $i++ ) {
            $this->data[ $i ]['password'] = Hash::make($this->data[ $i ]['password']);
        }

        User::insert($this->data);
    }
}
