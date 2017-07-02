<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        $array = array(
            0 => "undefined",
            1 => "Thomas",
            2 => "Novita",
            3 => "GOUW SIAN TEK",
            4 => "ERNA WANGSA",
            5 => "LIE KIAN JIN",
            6 => "AFUNG",
            );
        foreach($array as $key=>$val) :
            if($key === 0) {
                continue;
            } 
            DB::table('source')->where('source_id',$key)
                ->update(['source_name'=>$val]);
        endforeach;

        $array = array(
                array(
                    'estimation_id'     => 1,
                    'prediction'        => 55000000,
                    'paid'              => 22000000,
                    'detail'            => 'weeding package + Cashback Invitation 500rb'
                ),
                array(
                    'estimation_id'     => 2,
                    'prediction'        => 2000000,
                    'paid'              => 2000000,
                    'detail'            => 'Upgrade Dress in Cucu + Deposit 500rb'
                ),
                array(
                    'estimation_id'     => 2,
                    'prediction'        => 1750000,
                    'paid'              => 500000,
                    'detail'            => 'Upgrade Dress in Creativo'
                ),
                array(
                    'estimation_id'     => 2,
                    'prediction'        => 1700000,
                    'paid'              => 0,
                    'detail'            => 'Buy Suit For Daniel '
                ),
                array(
                    'estimation_id'     => 3,
                    'prediction'        => 750000,
                    'paid'              => 0,
                    'detail'            => '100 Pack of Food '
                ),
                array(
                    'estimation_id'     => 3,
                    'prediction'        => 375000,
                    'paid'              => 0,
                    'detail'            => '50 Pack of Food '
                ),
                array(
                    'estimation_id'     => 3,
                    'prediction'        => 3000000,
                    'paid'              => 0,
                    'detail'            => '100 Pack of Nasi Bogana'
                ),
                array(
                    'estimation_id'     => 3,
                    'prediction'        => 200000,
                    'paid'              => 0,
                    'detail'            => '20 Winggle'
                ),
                array(
                    'estimation_id'     => 4,
                    'prediction'        => 2100000,
                    'paid'              => 500000,
                    'detail'            => '300 Invitation Card'
                ),
                array(
                    'estimation_id'     => 4,
                    'prediction'        => 1675000,
                    'paid'              => 0,
                    'detail'            => '350 pack of souvenir'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 600000,
                    'paid'              => 300000,
                    'detail'            => 'Sepatu Thomas & Novi'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 2000000,
                    'paid'              => 0,
                    'detail'            => 'Buy 2 party dress for our mothers'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 2000000,
                    'paid'              => 0,
                    'detail'            => 'Budget for 2 person in Front Event'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 300000,
                    'paid'              => 0,
                    'detail'            => 'Budget for rent Suite for Marcus'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 2000000,
                    'paid'              => 0,
                    'detail'            => 'Budget for Gift'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 1000000,
                    'paid'              => 0,
                    'detail'            => 'Budget for Rent Car'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 1000000,
                    'paid'              => 0,
                    'detail'            => 'Budget for Add on Make Up'
                ),
                array(
                    'estimation_id'     => 5,
                    'prediction'        => 1000000,
                    'paid'              => 0,
                    'detail'            => 'Backup Budget for cost'
                ),
                array(
                    'estimation_id'     => 6,
                    'prediction'        => 1000000,
                    'paid'              => 1000000,
                    'detail'            => 'Survey Cost 1'
                ),
                array(
                    'estimation_id'     => 6,
                    'prediction'        => 585000,
                    'paid'              => 585000,
                    'detail'            => 'Survey Cost 2'
                ),
                array(
                    'estimation_id'     => 6,
                    'prediction'        => 117000,
                    'paid'              => 117000,
                    'detail'            => 'Survey Cost 3 Mcd + Baso'
                ),

        );
        DB::table('estimation_budget_detail')->insert($array);
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
