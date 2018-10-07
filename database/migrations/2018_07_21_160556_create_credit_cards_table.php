<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['credit_cards'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name', 255)->nullable();
            $table->string('card_number', 255)->nullable();
            $table->string('expiration_month', 10)->nullable();
            $table->string('expiration_year', 10)->nullable();
            $table->string('cvv', 10)->nullable();
            $table->tinyInteger('is_default')->default(0);
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('credit_card');
    }
}
