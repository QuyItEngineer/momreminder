<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('to_email', 254);
            $table->string('subject', 255);
            $table->text('message');
            $table->text('alt_message')->nullable();
            $table->integer('max_attempts')->default(3);
            $table->integer('attempts')->default(0);
            $table->tinyInteger('success')->default(0);
            $table->dateTime('date_published')->nullable();
            $table->dateTime('last_attempt')->nullable();
            $table->dateTime('date_sent')->nullable();
            $table->text('csv_attachment')->nullable();
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
        Schema::dropIfExists('email_queue');
    }
}
