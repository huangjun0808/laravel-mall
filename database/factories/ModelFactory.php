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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\AdminRole::class,function(Faker\Generator $faker){
    return [
        'name'=>'角色名称_'.str_random(4),
        'description'=>str_random(6),
        'created_at'=>date('Y-m-d H:i:s',time()),
        'updated_at'=>date('Y-m-d H:i:s',time())
    ];
});