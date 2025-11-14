<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/migration/RolesTable.php';
require_once __DIR__ . '/migration/PermissionsTable.php';
require_once __DIR__ . '/migration/RolespermissionTable.php';
require_once __DIR__ . '/migration/UserTable.php';
require_once __DIR__ . '/migration/HotelsTable.php';
require_once __DIR__ . '/migration/RoomsTable.php';
require_once __DIR__ . '/migration/RoomPriceTable.php';
require_once __DIR__ . '/migration/ServicesTable.php';
require_once __DIR__ . '/migration/DiscountsTable.php';
require_once __DIR__ . '/migration/ReservationsTable.php';


echo "Running migrations...\n\n";

(new RolesTable())->up();
(new PermissionsTable())->up();
(new RolePermissionsTable())->up();
(new UsersTable())->up();
(new HotelsTable())->up();
(new RoomsTable())->up();
(new RoomPricesTable())->up();
(new ServicesTable())->up();
(new DiscountTable())->up();
(new ReservationsTable())->up();


echo "\nAll migrations completed.\n";
