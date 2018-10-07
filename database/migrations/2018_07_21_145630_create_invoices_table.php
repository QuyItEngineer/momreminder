<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['invoices'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedInteger('package_id');
            $table->unsignedInteger('stripe_id');
            $table->integer('quantity')->default(0);
            $table->decimal('amount', 5, 2)->default(0);
            $table->decimal('tax', 5, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->string('balance_transaction', 255)->nullable();
//            $table->string('created',50)->nullable();
            $table->string('currency', 10)->nullable();
            $table->string('customer', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('invoice', 255)->nullable();
            $table->string('source')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable()->default(0);

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
        Schema::dropIfExists('invoices');
    }
}
