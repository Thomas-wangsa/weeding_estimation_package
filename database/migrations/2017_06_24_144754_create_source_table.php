<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('source', function (Blueprint $table) {
            $table->increments('source_id');
            $table->string('source_name');
            $table->string('information')->nullable();
        });

        // Insert some stuff
        $faker = Faker\Factory::create();
        $array = array(
                array(
                    'source_name' => $faker->name('male'),
                    'information' => 'Pengantin Pria'
                ),
                array(
                    'source_name' => $faker->name('female'),
                    'information' => 'Pengantin Wanita'
                ),
                array(
                    'source_name' => $faker->name('male')." & ".$faker->name('female'),
                    'information' => 'Orang Tua Pria'
                ),
                array(
                    'source_name' => $faker->name('male')." & ".$faker->name('female'),
                    'information' => 'Orang Tua Wanita'
                ),

        );
        DB::table('source')->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source');
    }
}
