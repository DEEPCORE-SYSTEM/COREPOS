<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeStatusColumnToVarcharInTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE transactions MODIFY COLUMN `status` VARCHAR(191) NOT NULL;');

        Transaction::where('type', 'sell_transfer')
            ->update(['status' => 'final']);

        Transaction::where('type', 'purchase_transfer')
            ->update(['status' => 'received']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {}
}
