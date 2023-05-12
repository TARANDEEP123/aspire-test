<?php

namespace Database\Seeders;

use App\Models\LookupValue;
use Illuminate\Database\Seeder;

/**
 * Class LookupValueSeeder
 * @package Database\Seeders
 */
class LookupValueSeeder extends Seeder
{
    /**
     * @var array
     */
    private $data = array(
        [
            'id'             => 1,
            'name'           => "Weekly",
            'description'    => "User can repay loan amount in easy monthly installment",
            'value'          => 1,
            'lookup_type_id' => 1,
        ],
        [
            'id'             => 2,
            'name'           => "Monthly",
            'description'    => "User can repay loan amount in easy Quarterly installment",
            'value'          => 1,
            'lookup_type_id' => 1,
        ],
        [
            'id'             => 3,
            'name'           => "Yearly",
            'description'    => "User can repay loan amount in easy half yearly installment",
            'value'          => 1,
            'lookup_type_id' => 1,
        ],
        [
            'id'             => 4,
            'name'           => "Car loan",
            'description'    => "Loan to buy a brand new car worth Rs. 5,00,000 at 10% interest for 12 weeks",
            'value'          => 1,
            'lookup_type_id' => 2,
        ],
        [
            'id'             => 5,
            'name'           => "House loan",
            'description'    => "Loan to by house worth Rs 25,00,000 at 12% interest for 1 year",
            'value'          => 1,
            'lookup_type_id' => 2,
        ],
        [
            'id'             => 6,
            'name'           => "Open",
            'description'    => "Loan that haven't yet closed and still premiums are left",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 7,
            'name'           => "Closed",
            'description'    => "Loan that is completed and all the payment is done",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 8,
            'name'           => "Defaulted",
            'description'    => "Loan that is being defaulted by user",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 9,
            'name'           => "Applied",
            'description'    => "When user have applied for loan",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 10,
            'name'           => "Cash",
            'description'    => "User have paid premium with cash",
            'value'          => 1,
            'lookup_type_id' => 4,
        ],
        [
            'id'             => 12,
            'name'           => "Credit Card",
            'description'    => "User have paid premium with Credit card",
            'value'          => 1,
            'lookup_type_id' => 4,
        ],
        [
            'id'             => 13,
            'name'           => "Rejected",
            'description'    => "When user application is rejected",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 14,
            'name'           => "Arrangement Fee",
            'description'    => "On Loan for the first time",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 15,
            'name'           => "Late fee Penalty",
            'description'    => "Late fee in penalties ",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 16,
            'name'           => "EMI amount",
            'description'    => "EMI amount for the loan",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
        [
            'id'             => 17,
            'name'           => "Early loan closure",
            'description'    => "Early Loan closure",
            'value'          => 1,
            'lookup_type_id' => 3,
        ],
    );

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        LookupValue::insert($this->data);
    }
}
