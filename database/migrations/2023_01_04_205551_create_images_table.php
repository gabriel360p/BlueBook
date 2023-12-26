<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('image');
            $table->integer('book_id')->nullable()->default(0);
            $table->integer('page_id')->nullable()->default(0);
            $table->integer('archived')->nullable()->default(0);
            $table->integer('exclued')->nullable()->default(0);
            $table->integer('marked')->nullable()->default(0);
            $table->integer('vault')->nullable()->default(0);
            $table->integer('open')->nullable()->default(0);
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
        Schema::dropIfExists('images');
    }
};
