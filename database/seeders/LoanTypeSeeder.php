<?php

namespace Database\Seeders;

use App\Models\LoanType;
use Illuminate\Database\Seeder;

/**
 * Class LoanTypeSeeder
 * @package Database\Seeders
 */
class LoanTypeSeeder extends Seeder
{
    /**
     * @var array
     */
    private $data = array(
        [
            'id'                          => 1,
            'name'                        => 'Car loan',
            'amount'                      => 500000,
            'description'                 => 'Loan to buy a brand new car worth Rs. 5,00,000 at 10.5% interest for 12 weeks',
            'duration'                    => 12,
            'interest_rate'               => 10.5,
            'arrangement_fee'             => 200,
            'repayment_frequency_type_id' => 1,
            'active'                      => 1,
        ],
        [
            'id'                          => 2,
            'name'                        => 'House loan',
            'amount'                      => 2500000,
            'description'                 => 'Loan to by house worth Rs 25,00,000 at 12% interest for 55 year',
            'duration'                    => 55,
            'interest_rate'               => 12,
            'arrangement_fee'             => 4000,
            'repayment_frequency_type_id' => 1,
            'active'                      => 1,
        ],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        LoanType::insert($this->data);
    }
}
