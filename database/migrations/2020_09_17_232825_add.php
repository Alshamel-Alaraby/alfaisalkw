<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('delegator_id')->nullable()->after('due');
            $table->unsignedBigInteger('supervisor_id')->nullable()->after('due');
            $table->foreign('delegator_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('supervisor_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
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
            $table->dropForeign('orders_delegator_id_foreign');
            $table->dropForeign('orders_supervisor_id_foreign');
            $table->dropColumn(['delegator_id','supervisor_id']);
        });
    }
}
