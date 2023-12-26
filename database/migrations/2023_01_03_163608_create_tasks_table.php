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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');

            $table->string('title');
            $table->string('task')->nullable()->default(NULL);
            $table->longText('description')->nullable()->default(NULL);

            $table->integer('conclued')->nullable()->default(0);
            $table->integer('exclued')->nullable()->default(0);
            $table->integer('visualized')->nullable()->default(NULL);

            $table->date('date_finish')->nullable()->default(NULL);
            $table->time('hour_finish')->nullable()->default(NULL);

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
        Schema::dropIfExists('tasks');
    }
};
