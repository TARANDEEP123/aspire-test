<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUserLoansTbl
 */
class CreateUserLoansTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('utl_user_loans', function (Blueprint $table) {
            $table->increments('id');

            $table->double('amount', 10, 2);

            $table->date('sanctioned_at')->nullable()->comment('When loan was sanctioned');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('sys_users');

            $table->unsignedInteger('sanctioned_by')->nullable();
            $table->foreign('sanctioned_by')->references('id')->on('sys_users');

            $table->unsignedInteger('loan_type_id');
            $table->foreign('loan_type_id')->references('id')->on('utl_loan_types');

            $table->unsignedInteger('loan_status_id');
            $table->foreign('loan_status_id')->references('id')->on('utl_lookup_values');

            $table->text('note')->nullable();

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
        Schema::dropIfExists('utl_user_loans');
    }
}
