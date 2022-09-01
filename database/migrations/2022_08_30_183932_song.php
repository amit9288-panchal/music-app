<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('song', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('year')->nullable(true);
            $table->string('songable_type',1024);
            $table->integer('songable_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('song');
    }
};
