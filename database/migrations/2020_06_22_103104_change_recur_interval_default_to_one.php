<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;

class ChangeRecurIntervalDefaultToOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Transaction::where('is_recurring', 1)
            ->whereNull('recur_interval')
            ->update(['recur_interval' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {}
}
