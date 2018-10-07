<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMlibUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mlib_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255);
            $table->string('title', 255)->nullable();
            $table->string('file', 255)->nullable();
            $table->string('caption', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('thumb', 255)->nullable();
            $table->integer('time');
            $table->integer('uid');
            $table->integer('size')->default('0');
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
        Schema::dropIfExists('mlib_uploads');
    }
}
