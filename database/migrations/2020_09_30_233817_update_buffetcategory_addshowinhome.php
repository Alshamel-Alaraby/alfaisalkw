<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBuffetcategoryAddshowinhome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buffet_categories', function (Blueprint $table) {
            $table->boolean('show_in_home')->default(0);
            $table->json('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buffet_categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_home','description']);
        });
    }
}
