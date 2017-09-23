<?php
global $link;
$query = "SELECT id,name,rank,score,(score/(time/60)) as spm, (kills/deaths) as kdr, time, country FROM player WHERE name LIKE '".mysql_real_escape_string($SEARCHVALUE,$link)."' OR name LIKE ' ".mysql_real_escape_string($SEARCHVALUE,$link)."' OR id = '".intval($SEARCHVALUE)."' ORDER BY score DESC LIMIT 30;";

?>