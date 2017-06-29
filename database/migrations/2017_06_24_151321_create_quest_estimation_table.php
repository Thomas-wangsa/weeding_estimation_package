<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestEstimationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest_estimation', function (Blueprint $table) {
            $table->integer('quest_id');
            $table->integer('prediction')->nullable();
            $table->integer('ammount')->nullable();

            $table->foreign('quest_id', 'quest_estimation_quest_id_fkey')
            ->references('quest_id')->on('quest_detail')
            ->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quest_estimation');
    }
}
