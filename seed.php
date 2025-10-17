<?php

define('BASE_PATH', __DIR__);   

require BASE_PATH . '/vendor/autoload.php';


use Database\Seeders\UsersSeeder;


$seeder = new UsersSeeder();


$seeder->run();

echo " Users table seeded successfully!\n";
