<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateLookupTypeTbl
 */
class CreateLookupTypeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('utl_lookup_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->comment('Lookup type name');
            $table->text('description')->comment('Description that what it does');

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
        Schema::dropIfExists('utl_lookup_types');
    }
}
