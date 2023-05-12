<?php

namespace Database\Seeders;

use App\Models\LookupType;
use Illuminate\Database\Seeder;

/**
 * Class LookupTypeSeeder
 * @package Database\Seeders
 */
class LookupTypeSeeder extends Seeder
{
    /**
     * @var array
     */
    private $data = array(
        [
            'id'          => 1,
            'name'        => "Installment type (Repayment frequency)",
            'description' => "Repayment frequency such as monthly, quarterly etc",
        ],
        [
            'id'          => 2,
            'name'        => "Loan types",
            'description' => "All the types of loan that Aspire provide",
        ],
        [
            'id'          => 3,
            'name'        => "Loan status",
            'description' => "All the loan status",
        ],
        [
            'id'          => 4,
            'name'        => "Payment type",
            'description' => "Payment type such as cash, credit cart, etc",
        ],
        [
            'id'          => 5,
            'name'        => "Fee regarding repayment of loan",
            'description' => "This category will consist of the payment head regarding repayment of loan",
        ],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        LookupType::insert($this->data);
    }
}
