<?php
$template = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="inner">
<head>
	<title>Server Detail, '. $TITLE .'</title>
	<link rel="icon" href="'.$ROOT.'favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="'.$ROOT.'favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" media="screen" href="'.$ROOT.'css/two-tiers.css">
	<link rel="stylesheet" type="text/css" media="screen" href="'.$ROOT.'css/nt.css">
	<link rel="stylesheet" type="text/css" media="print" href="'.$ROOT.'css/print.css">
	<link rel="stylesheet" type="text/css" media="screen" href="'.$ROOT.'css/default.css">

	<script type="text/javascript">/* no frames */ if(top.location != self.location) top.location.replace(self.location);</script>
	<script type="text/javascript" src="'. $ROOT .'js/nt2.js"></script>
	<script type="text/javascript" src="'. $ROOT .'js/show.js"></script>

</head>

<body class="inner">

<div id="page-1">
	<div id="page-2">
		<h1 id="page-title">Server Detail<small>"nuh uh! I\'m better!"</small></h1>
		<div id="page-3">
			<div id="content"><div id="content-id"><!-- template header end == begin content below -->
			
				
				';
ob_start();
?>
<table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="stat">
<tbody>
    <tr>
        <td width="50%" align="center">
            <img src="/ASP/frontend/images/maps/<?php echo $serverData['map']?>.png">
        </td>
        <td>
            <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="stat">
                <tbody>
                    <tr>
                        <td>
                            Server OS:
                        </td>
                        <td>
                            <?php
                            echo $serverData['server']['bf2_os'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Game Type:
                        </td>
                        <td>
                            <?php
                            echo $serverData['server']['gametype'];
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address:
                        </td>
                        <td>
                            <?php
                            echo $serverData['ip'].':'.$serverData['server']['hostport'];
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>

    <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="stat">
        <tbody>
        <tr>
            <td width="50%" valign="top">

                <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="stat">
                    <tbody>
                    <tr>
                        <th width="1%">

                        </th>
                        <th>
                            <?php
                            echo $serverData['server']['team1_name']
                            ?>
                        </th>
                        <th>
                            <img src="/game-images/score.png">
                        </th>
                        <th>
                            <img src="/game-images/kill.png">
                        </th>
                        <th>
                            <img src="/game-images/deaths.png">
                        </th>
                        <th>
                            <img src="/game-images/ping.png">
                        </th>
                    </tr>
                    <?php
                    foreach ($serverData['team1'] as $player):
                        $playerData = getPlayerDataFromPID($player['pid']);
                        ?>
                        <tr>
                            <td>
                                <img src="/game-images/ranks/icon/rank_<?php echo $playerData['rank']?>.gif">
                            </td>
                            <td>
                                <a href="/?pid=<?php echo $player['pid']?> "><?php
                                    echo $player['name']
                                    ?></a>
                            </td>
                            <td>
                                <?php
                                echo $player['score']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['kills']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['deaths']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['ping']
                                ?>
                            </td>
                        </tr>

                        <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>

            </td>
            <td width="50%" valign="top">
                <table cellspacing="0" cellpadding="0" border="0" style="width: 100%;" class="stat">
                    <tbody>
                    <tr>
                        <th width="1%">

                        </th>
                        <th>
                            <?php
                            echo $serverData['server']['team2_name']
                            ?>
                        </th>
                        <th>
                            <img src="/game-images/score.png">
                        </th>
                        <th>
                            <img src="/game-images/kill.png">
                        </th>
                        <th>
                            <img src="/game-images/deaths.png">
                        </th>
                        <th>
                            <img src="/game-images/ping.png">
                        </th>
                    </tr>

                    <?php
                    foreach ($serverData['team2'] as $player):
                        $playerData = getPlayerDataFromPID($player['pid']);
                    ?>
                        <tr>
                            <td>
                                <img src="/game-images/ranks/icon/rank_<?php echo $playerData['rank']?>.gif">
                            </td>
                            <td>
                                <a href="/?pid=<?php echo $player['pid']?> "><?php
                                echo $player['name']
                                ?></a>
                            </td>
                            <td>
                                <?php
                                echo $player['score']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['kills']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['deaths']
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $player['ping']
                                ?>
                            </td>
                        </tr>

                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>

            </td>
        </tr>
        </tbody>
    </table>



<?php
$template .= ob_get_contents();
ob_end_clean();




$template .= '	

				<p><!-- end content == footer below --></p>
				<p>&nbsp;</p>
				<p>&nbsp; </p>
				<hr class="clear">
	
			</div></div> <!-- content-id --><!-- content -->
			<a id="secondhome" href="'.$ROOT.'"> </a>

		</div><!-- page 3 -->	
	</div><!-- page 2 -->
	<div id="footer">This page was last updated {:LASTUPDATE:} ago. Next update will be in {:NEXTUPDATE:}<br>
	This page was processed in {:PROCESSED:} seconds.</div>
	
	<ul id="navitems">
		<li><a href="'. $ROOT .'">Home</a></li>
		<li><a href="'. $ROOT .'?go=servers">Servers</a></li>
		<li><a href="'. $ROOT .'?go=my-leaderboard">My Leader Board</a></li>
		<li><a href="'. $ROOT .'?go=currentranking">Rankings</a></li>
		<li><a href="'. $ROOT .'?go=ubar">UBAR</a></li>
		<li><a href="https://battlelog.co/post.php?id=28081" target="_blank">Support Forum</a></li>
	</ul>
	
	<form action="'.$ROOT.'?go=search" method="post" id="getstats">
		<label for="pid">Get Stats</label>
		<input type="text" name="searchvalue" id="pid" value="" />
		<input type="submit" class="btn" value="Go" />
	</form>
</div><!-- page 1 -->
</body>
</html>';