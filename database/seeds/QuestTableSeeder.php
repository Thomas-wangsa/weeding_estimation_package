<?php

use Illuminate\Database\Seeder;

class QuestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        factory(App\User::class)->create();
        //factory(App\Http\Models\EstimationBudgetDetail::class,50)->create();
        //factory(App\Http\Models\QuestEstimation::class,340)->create();
    }
}
