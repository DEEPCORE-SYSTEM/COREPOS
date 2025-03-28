<?php

use App\Utils\InstallUtil;
use Illuminate\Database\Migrations\Migration;

class ModifyVariableProductData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $installUtil = new InstallUtil;
        $installUtil->createExistingProductsVariationsToTemplate();
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
