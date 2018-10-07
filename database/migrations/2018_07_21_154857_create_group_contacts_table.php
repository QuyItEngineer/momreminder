<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['group_contacts'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('contact_id');
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on($tableNames['groups'])
                ->onDelete('cascade');

            $table->foreign('contact_id')
                ->references('id')
                ->on($tableNames['contacts'])
                ->onDelete('cascade');

            $table->primary(['group_id', 'contact_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_contacts');
    }
}
