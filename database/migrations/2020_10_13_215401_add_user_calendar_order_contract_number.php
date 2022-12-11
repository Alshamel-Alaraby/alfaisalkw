<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCalendarOrderContractNumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('contract_number')->after('client_id')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->json('calendar')->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('contract_number');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('calendar');
        });
    }
}
