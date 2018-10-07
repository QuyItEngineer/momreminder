<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['logs'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('event_type', 255)->nullable();
            $table->string('direction', 255)->nullable();
            $table->text('ref')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('from_phone', 50)->nullable();
            $table->string('to_phone', 50)->nullable();
            $table->string('message_id', 255)->nullable();
            $table->string('message_uri', 255)->nullable();
            $table->text('text')->nullable();
            $table->text('media')->nullable();
            $table->string('application_id', 255)->nullable();
            $table->date('time')->nullable();
            $table->string('state', 50)->nullable();
            $table->string('delivery_state', 255)->nullable();
            $table->string('delivery_code', 255)->nullable();
            $table->string('delivery_description', 255)->nullable();
            $table->string('mark', 25)->default('unread');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
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
        Schema::dropIfExists('logs');
    }
}
