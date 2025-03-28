<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddPermissionForDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Permission::create(['name' => 'discount.access']);
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
