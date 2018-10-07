<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['activities'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('activity', 255);
            $table->string('module', 255);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
