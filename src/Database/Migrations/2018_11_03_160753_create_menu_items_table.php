<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->index();
            $table->integer('parent_id')->nullable();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('is_root')->default(false);
            $table->enum('status',['draft','published','unpublished'])->default('published');
            $table->timestamps();

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

        Schema::dropIfExists('menu_items');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
