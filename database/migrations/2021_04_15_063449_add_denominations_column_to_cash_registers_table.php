<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDenominationsColumnToCashRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cash_registers', function (Blueprint $table) {
            $table->text('denominations')->nullable()->after('total_cheques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {}
}
