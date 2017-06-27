<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest_detail', function (Blueprint $table) {
            $table->increments('quest_id');
            $table->smallInteger('adult')->default(1);
            $table->smallInteger('child')->nullable();
            $table->smallInteger('infant')->nullable();

            $table->foreign('quest_id', 'quest_detail_quest_id_fkey')
            ->references('quest_id')->on('quest')
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
        Schema::dropIfExists('quest_detail');
    }
}
