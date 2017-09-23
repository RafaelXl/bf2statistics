<?php
    global $link;
	$query = "SELECT id FROM player WHERE name LIKE '".mysql_real_escape_string($NICK,$link)."';";
?>