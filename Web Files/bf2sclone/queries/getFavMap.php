<?php
	$query = "SELECT mapid FROM maps WHERE id = ".intval($PID)." ORDER BY time desc limit 1;";
?>
