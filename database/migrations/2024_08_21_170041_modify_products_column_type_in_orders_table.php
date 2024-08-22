<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsColumnTypeInOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('products')->nullable()->change(); // Change to LONGTEXT
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('products', 255)->nullable()->change(); // Revert to original string type
        });
    }
}

