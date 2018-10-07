<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['galleries'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('file', 255)->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
