<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['campaigns'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('record_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('template_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('delivery', 50)->nullable();
            $table->string('routine_appointment', 255)->nullable();
            $table->string('date')->nullable();
            $table->string('time', 50)->nullable();
            $table->text('message')->nullable();
            $table->string('send_to', 50)->nullable();
            $table->string('send_type', 50)->nullable();
            $table->tinyInteger('bot')->default(0);
            $table->string('phones')->nullable();
            $table->string('media', 255)->nullable();
            $table->string('voice', 50)->nullable();
            $table->dateTime('timestamp')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('record_id')
                ->references('id')
                ->on('records');

            $table->foreign('group_id')
                ->references('id')
                ->on('groups');

            $table->foreign('template_id')
                ->references('id')
                ->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
