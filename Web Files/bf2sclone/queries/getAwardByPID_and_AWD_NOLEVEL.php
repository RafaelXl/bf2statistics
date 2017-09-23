<?php
	$query = "SELECT * FROM awards where id = ".intval($PID)." AND awd = ".intval($AWD)." LIMIT 1";