<?php
$table_name = 'sell';
$sqlQuery = "CREATE TABLE sale_report (
			invoice_number  VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			salesman_id VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			store_name VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			register_number VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			customer_name VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci NOT NULL,
			mobile VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci NOT NULL,
			total_amount decimal(10,2) NOT NULL COLLATE utf8mb4_unicode_ci NOT NULL,
			due decimal(10,2) COLLATE utf8mb4_unicode_ci NOT NULL,
			date Date NOT NULL COLLATE utf8mb4_unicode_ci NOT NULL,
			PRIMARY KEY (invoice_number) )";
?>
