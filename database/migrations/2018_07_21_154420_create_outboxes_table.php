<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['outboxes'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('campaign_id')->nullable();
            $table->unsignedInteger('contact_id')->nullable();
            $table->string('from_phone', 50)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('message')->nullable();
            $table->string('media', 255)->nullable();
            $table->decimal('cost', 5, 2)->nullable();
            $table->date('date')->nullable();
            $table->dateTime('datetime')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->text('result')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')
                ->references('id')
                ->on($tableNames['invoices'])
                ->onDelete('cascade');

            $table->foreign('campaign_id')
                ->references('id')
                ->on($tableNames['campaigns'])
                ->onDelete('cascade');

            $table->foreign('contact_id')
                ->references('id')
                ->on($tableNames['contacts'])
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
        Schema::dropIfExists('outbox');
    }
}
