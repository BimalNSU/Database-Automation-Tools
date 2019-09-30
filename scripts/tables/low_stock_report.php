<?php
$table_name = 'low_stock_report';
$sqlQuery = "CREATE TABLE low_stock_report (
			item_id VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			item_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			generic_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			company_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			quantity decimal(10,2) NOT NULL,
			location VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			PRIMARY KEY (item_id) )";

?>
