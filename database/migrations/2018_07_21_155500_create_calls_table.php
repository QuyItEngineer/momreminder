<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['calls'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('call_id', 255)->nullable();
            $table->string('from_phone', 50)->nullable();
            $table->string('to_phone', 50)->nullable();
            $table->string('audio', 255)->nullable();
            $table->integer('bot')->default(0);
            $table->string('sentense', 255)->nullable();
            $table->string('event_type')->nullable();
            $table->string('time')->nullable();
            $table->string('state', 50)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('callback')->nullable();
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('calls');
    }
}
