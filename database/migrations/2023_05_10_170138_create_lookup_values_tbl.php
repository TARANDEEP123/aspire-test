<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLookupValuesTbl
 */
class CreateLookupValuesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('utl_lookup_values', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('Lookup value name');
            $table->text('description')->comment('Description that what value does');
            $table->string('value');

            $table->unsignedInteger('lookup_type_id');
            $table->foreign('lookup_type_id')->references('id')->on('utl_lookup_types');

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
        Schema::dropIfExists('utl_lookup_values');
    }
}
