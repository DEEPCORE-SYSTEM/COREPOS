<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubStatusColumnToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('sub_status')->after('status')->nullable()->index();
        });

        Transaction::where('is_quotation', 1)->update(['sub_status' => 'quotation']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {}
}
