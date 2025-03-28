<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantitySoldInPurchaseLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_lines', function (Blueprint $table) {
            $table->decimal('quantity_sold', 22, 4)->default(0)->after('tax_id')->comment('Quanity sold from this purchase line');
            $table->decimal('quantity_adjusted', 22, 4)->default(0)->after('quantity_sold')->comment('Quanity adjusted in stock adjustment from this purchase line');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_lines', function (Blueprint $table) {
            $table->dropColumn('quantity_sold');
            $table->dropColumn('quantity_adjusted');
        });
    }
}
