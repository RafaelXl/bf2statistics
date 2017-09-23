<?php
	$query = "SELECT attacker, count FROM kills where victim = ".intval($PID)." ORDER BY count DESC LIMIT 11;";
?>

