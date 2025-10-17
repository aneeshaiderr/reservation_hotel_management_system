<?php

define('BASE_PATH', __DIR__);   // Base path define kar do

require BASE_PATH . '/vendor/autoload.php';

// Yahan tumhari Seeder class ko import karo
use Database\Seeders\UsersSeeder;

// Seeder ka instance banao
$seeder = new UsersSeeder();

// Seeder ka run() method call karo
$seeder->run();

echo "✅ Users table seeded successfully!\n";
