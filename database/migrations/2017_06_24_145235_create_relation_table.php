<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation', function (Blueprint $table) {
            $table->increments('relation_id');
            $table->string('relation_name');
        });

        // Insert some stuff
        $array = array(
                array(
                    'relation_name' => 'sibling',
                ),
                array(
                    'relation_name' => 'neighbors',
                ),
                array(
                    'relation_name' => 'co-workers',
                ),
                array(
                    'relation_name' => 'friends',
                ),
                array(
                    'relation_name' => 'others',
                ),
        );
        DB::table('relation')->insert($array);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation');
    }
}
