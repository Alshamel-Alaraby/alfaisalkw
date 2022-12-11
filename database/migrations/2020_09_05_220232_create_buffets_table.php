<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuffetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buffet_categories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->timestamps();
        });
        Schema::create('buffets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('buffet_categories')
                ->onDelete('cascade');
            $table->json('title');
            $table->json('description')->nullable();
            $table->integer('number_attendence');
            $table->double('price');
            $table->timestamps();
        });
        Schema::create('buffet_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buffet_id');
            $table->foreign('buffet_id')
                ->references('id')
                ->on('buffets')
                ->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
            $table->integer('qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buffet_items');
        Schema::dropIfExists('buffets');
        Schema::dropIfExists('buffet_categories');
    }
}
