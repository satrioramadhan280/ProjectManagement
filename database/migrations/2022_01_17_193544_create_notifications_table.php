<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notification_type_id');
            $table->foreign('notification_type_id')
                ->references('id')
                ->on('notification_type')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('forum_id')->nullable();
            $table->foreign('forum_id')
                ->references('id')
                ->on('forums')->onDelete('cascade')->onUpdate('cascade');
            $table->string('additional_description')->nullable();
            $table->unsignedBigInteger('status');
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
        Schema::dropIfExists('notifications');
    }
}
