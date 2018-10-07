<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['posts'], function (Blueprint $table) use ($tableNames) {
            $table->increments('id');
            $table->unsignedBigInteger('post_author')->default(0);
            $table->unsignedInteger('category_id')->nullable();
            $table->dateTime('post_date');
            $table->longText('post_content');
            $table->text('post_title');
            $table->string('permalink', 255);
            $table->text('post_excerpt');
            $table->string('post_status', 20)->default('publish');
            $table->string('post_password', 20)->default('');
            $table->unsignedInteger('post_parent')->default(0);
            $table->integer('menu_order')->default(0);
            $table->string('post_type', 20)->default('post');
            $table->string('post_mime_type', 100)->default('');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on($tableNames['categories'])
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
        Schema::dropIfExists('posts');
    }
}
