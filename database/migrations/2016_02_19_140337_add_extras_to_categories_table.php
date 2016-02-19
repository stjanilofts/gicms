<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtrasToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->json('extras');
        });
    }

    public function down()
    {
        Schema::table('categories', function ($table) {
            $table->dropColumn('extras');
        });
    }
}
