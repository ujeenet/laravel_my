<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('resource_id');
            $table->string('title');
            $table->integer('exp_duration')->nullable();
            $table->integer('duration')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['on_hold','in_process','done']);
            $table->enum('type', ['upgrade','fix','experimental','new']);
            $table->integer('starts_at');
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
        Schema::dropIfExists('projects');
    }
}
