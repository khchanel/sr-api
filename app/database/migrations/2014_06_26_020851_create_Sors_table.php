<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSorsTable extends Migration {

    private $tablename = 'sr_sors';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sr_sors', function(Blueprint $table)
        {
            $table->string('SORCode')->primary();
            $table->string('Tradecode');
            $table->string('UomCode');
            $table->string('Name');
            $table->text('LongDescription');
            $table->string('Status');
            $table->double('Price201213');
            $table->double('Price');
            $table->integer('Warranty');
            $table->integer('Manual');
            $table->boolean('Deleted');
            $table->string('Code');
            $table->string('Location');
            $table->string('Photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sr_sors');
    }

}
