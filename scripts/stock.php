<?php
$table_name = 'stock';
$sqlQuery = "CREATE TABLE stock (
			item_id VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			item_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			generic_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			company_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			buy_price decimal(10,2) NOT NULL,
			sale_price decimal(10,2) NOT NULL,
			quantity decimal(10,2) NOT NULL,
			location VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			minimum_stock decimal(10,2) NOT NULL,
			PRIMARY KEY (item_id) )";

?>
