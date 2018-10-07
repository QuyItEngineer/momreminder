<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['user_metas'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('meta_id');
            $table->unsignedInteger('user_id')->default(0);
            $table->string('meta_key', 255)->default('');
            $table->longText('meta_value')->nullable();
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on($tableNames['users'])
                ->onDelete('cascade');

            $table->primary('meta_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}
