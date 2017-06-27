<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
    'name' => "Thomas",
    'email' => "thomas.wangsa@gmail.com",
    'password' => $password ?: $password = bcrypt('668482'),
    'remember_token' => str_random(10),
    ];
});



$factory->define(App\Http\Models\Source::class, function (Faker\Generator $faker) {
    return [
    'source_name'	=> $faker->firstName,
    ];
});

$factory->define(App\Http\Models\Relation::class, function (Faker\Generator $faker) {
    return [
    'relation_name'	=> $faker->city,
    ];
});

$factory->define(App\Http\Models\Quest::class, function (Faker\Generator $faker) {
    $source = DB::table('source')->select('source_id')->get();
    $source_list = array();
    foreach($source as $key=>$val_source) :
        $source_list[] = $val_source->source_id;
    endforeach;

    $relation = DB::table('relation')->select('relation_id')->get();
    $relation_list = array();
    foreach($relation as $key=>$val_relation) :
        $relation_list[] = $val_relation->relation_id;
    endforeach;

    return [
    'quest_name'	=> $faker->name,
    'invitation'	=> 1,
    'source_id'		=> $faker->randomElement($array = $source_list),
    'relation_id'	=> $faker->randomElement($array = $relation_list),
    'is_come'       => $faker->numberBetween($min = 1, $max = 3),
    'status'		=> 1,
    ];
});

$factory->define(App\Http\Models\QuestDetail::class, function (Faker\Generator $faker) {
    return [
    'quest_id'      => factory(App\Http\Models\Quest::class)->create()->quest_id,
    'adult'			=> $faker->numberBetween($min = 1, $max = 2),
    'child'			=> $faker->numberBetween($min = 0, $max = 2),
    'infant'		    => $faker->numberBetween($min = 0, $max = 1),
    ];
});

$factory->define(App\Http\Models\QuestEstimation::class, function (Faker\Generator $faker) {
    return [
    'quest_id'          =>factory(App\Http\Models\QuestDetail::class)->create()->quest_id,
    'prediction'		=> $faker->numberBetween($min = 50000, $max = 200000),
    'ammount'			=> $faker->numberBetween($min = 50000, $max = 300000),
    ];
});