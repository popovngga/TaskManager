<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('user_executor_id')->unsigned()->nullable();
            $table->string('header');
            $table->longText('description');
            $table->string('status');
            $table->dateTime('deadline');
            $table->longText('comment')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_executor_id')
                ->references('id')->on('users')->onDelete('cascade');
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
}
