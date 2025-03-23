<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;

class SetStatusAsReceivedForOpeningStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Transaction::where('type', 'opening_stock')
            ->where('status', '!=', 'received')
            ->update(['status' => 'received']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
