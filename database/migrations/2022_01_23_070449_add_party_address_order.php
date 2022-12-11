<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPartyAddressOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('party_address')->after('contract_number')->nullable();
            DB::statement('ALTER TABLE `orders` MODIFY `end_time` time NULL;');

        });
        Schema::table('items', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true);
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
            $table->dropColumn('party_address');
        });

        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('is_visible');
        });
    }
}
