<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['post_metas'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('meta_id');
            $table->unsignedInteger('post_id')->default(0);
            $table->string('meta_key', 255)->nullable();
            $table->longText('meta_value')->nullable();
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on($tableNames['posts'])
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
        Schema::dropIfExists('post_meta');
    }
}
