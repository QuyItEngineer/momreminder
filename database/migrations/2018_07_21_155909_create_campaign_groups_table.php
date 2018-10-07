<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('db_names.table_names');

        Schema::create($tableNames['campaign_groups'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('campaign_id');
            $table->unsignedInteger('group_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')
                ->references('id')
                ->on($tableNames['campaigns'])
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('id')
                ->on($tableNames['groups'])
                ->onDelete('cascade');

            $table->primary(['campaign_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_group');
    }
}
