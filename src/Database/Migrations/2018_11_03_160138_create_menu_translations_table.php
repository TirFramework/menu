<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('menu_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->string('locale');
            $table->string('name');

            $table->unique(['menu_id', 'locale']);
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
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

        Schema::dropIfExists('menu_translations');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
