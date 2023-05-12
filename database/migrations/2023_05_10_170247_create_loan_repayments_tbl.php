<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLoanRepaymentsTbl
 */
class CreateLoanRepaymentsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('utl_loan_repayments', function (Blueprint $table) {
            $table->increments('id');

            $table->double('amount', 10, 2);
            $table->date('due_date');

            $table->dateTime('paid_at')->nullable(); //some automatic job will populate it.

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('sys_users');

            $table->unsignedInteger('loan_id');
            $table->foreign('loan_id')->references('id')->on('utl_user_loans');

            $table->unsignedInteger('payment_type_id')->nullable()->comment('Payment medium e.g. cash');
            $table->foreign('payment_type_id')->references('id')->on('utl_lookup_values');

            $table->unsignedInteger('repayment_head_id')->nullable()->comment('Tell about the repayment type');
            $table->foreign('repayment_head_id')->references('id')->on('utl_lookup_values');

            $table->dateTime('verified_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('utl_loan_repayments');
    }
}
