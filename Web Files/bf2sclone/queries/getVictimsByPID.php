<?php
	$query = "SELECT victim, count FROM kills WHERE attacker = ".intval($PID)." ORDER BY count DESC LIMIT 11;";
?>