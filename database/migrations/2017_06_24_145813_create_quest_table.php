<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest', function (Blueprint $table) {
            $table->increments('quest_id');
            $table->string('quest_name', 50);
            $table->smallInteger('invitation')->default(1);
            $table->smallInteger('source_id');
            $table->smallInteger('relation_id');
            $table->smallInteger('is_come')->default(1);
            $table->smallInteger('status')->default(1);

            $table->foreign('source_id', 'quest_source_id_fkey')
            ->references('source_id')->on('source')
            ->onUpdate('CASCADE')->onDelete('RESTRICT');

            $table->foreign('relation_id', 'quest_relation_id_fkey')
            ->references('relation_id')->on('relation')
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
        Schema::dropIfExists('quest');
    }
}
