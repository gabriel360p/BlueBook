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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_name')->nullable()->default(0);
            $table->string('title');
            $table->integer('visualized')->nullable()->default(1);
            $table->string('description');
            $table->string('password')->nullable()->default(NULL);
            $table->integer('archived')->nullable()->default(NULL);
            $table->integer('exclued')->nullable()->default(0);
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
        Schema::dropIfExists('books');
    }
};
