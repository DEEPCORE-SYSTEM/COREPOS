<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCompletedStockTransferStatusToFinal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('transactions', function (Blueprint $table) {
            $table->index('status');
        });

        Transaction::where('type', 'sell_transfer')
            ->where('status', 'completed')
            ->update(['status' => 'final']);

        Transaction::where('type', 'purchase_transfer')
            ->where('status', 'completed')
            ->update(['status' => 'received']);
    }
}
