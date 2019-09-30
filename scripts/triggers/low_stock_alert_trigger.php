<?php
$trigger_name = 'low_stock_alert_trigger';
$sqlQuery = "create trigger low_stock_alert_trigger
			after update ON stock
			for each row
			begin
		
				INSERT INTO low_stock_report 
							(SELECT new.item_id,new.item_name,new.generic_name,new.company_name,new.quantity,new.location 
								WHERE new.quantity <= new.minimum_stock AND NOT EXISTS(SELECT *
						                                                    			FROM low_stock_report s
						                                                    			WHERE new.item_id=s.item_id
						                                                    			)
				 			);
				DELETE 
				FROM low_stock_report
				WHERE item_id=NEW.item_id AND NEW.minimum_stock < NEW.quantity;

				UPDATE low_stock_report
				SET quantity=new.quantity,location=new.location
				WHERE new.item_id=item_id;

			end";
?>
