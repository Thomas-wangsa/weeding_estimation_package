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
            3 => "GOUW SIAN TEK & ERNA WANGSA",
            4 => "LIE KIAN JIN & APUNG",
            );
        foreach($array as $key=>$val) :
            if($key === 0) {
                continue;
            } 
            DB::table('source')->where('source_id',$key)
                ->update(['source_name'=>$val]);
        endforeach;
    
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