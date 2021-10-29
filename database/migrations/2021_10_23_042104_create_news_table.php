<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("news", function (Blueprint $table) {
            $table->id();
            $table->string("title", 255)->unique();
            $table->string("slug", 255)->unique();
            $table->text("description")->nullable();
            $table->text("text");
            $table->boolean("is_published");
            $table->timestamps();
            $table->timestamp("published_at");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
