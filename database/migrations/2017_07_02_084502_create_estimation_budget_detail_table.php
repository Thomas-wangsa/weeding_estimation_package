<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimationBudgetDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimation_budget_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estimation_id');
            $table->integer('prediction')->nullable();
            $table->integer('paid')->nullable();
            $table->string('detail')->nullable();

            $table->foreign('estimation_id', 'estimation_budget_detail_estimation_id_fkey')
            ->references('estimation_id')->on('estimation_budget')
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
        Schema::dropIfExists('estimation_budget_detail');
    }
}
