<?php
$table_name = 'expense';
$sqlQuery = "CREATE TABLE expense (
			expense_id VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			date Date COLLATE utf8mb4_unicode_ci NOT NULL,
			category VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			amount decimal(10,2) NOT NULL,
			discription VARCHAR(50) COLLATE utf8mb4_unicode_ci,
			entry_by VARCHAR(30) COLLATE utf8mb4_unicode_ci NOT NULL,
			PRIMARY KEY (expense_id) )";

?>
