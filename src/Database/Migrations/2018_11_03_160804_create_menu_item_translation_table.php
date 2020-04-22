<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('menu_item_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_item_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['menu_item_id', 'locale']);
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('menu_item_translations');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
