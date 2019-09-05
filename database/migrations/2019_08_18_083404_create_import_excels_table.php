<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_excels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('batchNo')->unsigned()->unique();
            $table->date('dateOfPayment');
            $table->integer('sponsorNo')->unsigned()->unique();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_excels');
    }
}
