<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReminderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['reminder_users'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('type', 50)->nullable();
            $table->unsignedInteger('user_id');
            $table->integer('days')->nullable();
            $table->text('message')->nullable();
            $table->integer('media')->nullable();
            $table->string('media_file', 255)->nullable();
            $table->unsignedInteger('group_id');
            $table->date('date')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('id')
                ->on($tableNames['groups'])
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminder_user');
    }
}
