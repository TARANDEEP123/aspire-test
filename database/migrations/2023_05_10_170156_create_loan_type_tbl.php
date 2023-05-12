<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLoanTypeTbl
 */
class CreateLoanTypeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('utl_loan_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->text('description');
            $table->double('amount', 10, 2);

            $table->integer('duration')->comment('duration in weeks');
            $table->decimal('interest_rate');
            $table->decimal('arrangement_fee');

            $table->unsignedInteger('repayment_frequency_type_id')->default(WEEKLY_PAYMENT_ID);
            $table->foreign('repayment_frequency_type_id')->references('id')->on('utl_lookup_types');

            $table->boolean('active')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('utl_loan_types');
    }
}
