<?php
	$query = "SELECT * FROM awards where id = ".intval($PID)." AND awd = ".intval($AWD)." AND level = ".intval($LEVEL)." LIMIT 1";
