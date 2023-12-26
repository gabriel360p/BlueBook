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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('user_name')->nullable()->default(NULL);
            $table->string('title');
            $table->string('subtitle');
            $table->integer('visualized')->nullable()->default(1);
            $table->longText('text');
            $table->integer('pagNumber')->nullable()->default(NULL);
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
        Schema::dropIfExists('pages');
    }
};
