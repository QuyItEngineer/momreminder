<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['messages'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('message_id', 255)->nullable();
            $table->string('from', 50)->nullable();
            $table->string('to', 50)->nullable();
            $table->text('text')->nullable();
            $table->text('media')->nullable();
            $table->string('time', 50)->nullable();
            $table->string('fallback_url', 50)->nullable();
            $table->string('skip_mms_carrier_validation', 50)->nullable();
            $table->string('direction', 50)->nullable();
            $table->string('state', 20)->nullable();
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
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
        Schema::dropIfExists('messages');
    }
}
