<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimationBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimation_budget', function (Blueprint $table) {
            $table->increments('estimation_id');
            $table->string('budget_name');
        });

        $array = array(
                array(
                    'budget_name' => 'wedding-package',
                ),
                array(
                    'budget_name' => 'bridal-addon',
                ),
                array(
                    'budget_name' => 'food-addon',
                ),
                array(
                    'budget_name' => 'exclude-addon',
                ),
                array(
                    'budget_name' => 'event-budget',
                ),
                array(
                    'budget_name' => 'others',
                ),
        );
        DB::table('estimation_budget')->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimation_budget');
    }
}
