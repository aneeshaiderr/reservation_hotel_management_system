<?php
use App\Core\Database;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/seeders/roleSeeder.php";
require_once __DIR__ . "/seeders/permissionSeeder.php";
require_once __DIR__ . "/seeders/rolePermissionSeeder.php";
require_once __DIR__ . "/seeders/userSeeder.php";


echo "Running seeders...\n\n";

(new roleSeeder)->run();
(new permissionSeeder)->run();
(new rolePermissionSeeder)->run();
(new userSeeder)->run();

echo "\nAll seeds completed.\n";
