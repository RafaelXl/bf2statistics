<?php
error_reporting(0);
include('config.inc.php');

// process page start:
$time_start = microtime(true);

// Define a smaller Directory seperater and ROOT path
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('CACHE_PATH', ROOT . DS . 'cache' . DS);
define('TEMPLATE_PATH', ROOT . DS . 'template' . DS);

// IFF PID -> go show stats!
$PID = isset($_GET["pid"]) ? mysql_real_escape_string($_GET["pid"]) : "0";


function sm($x, $str)
{
    $dlina = strlen($str);
    if ($dlina == 2) $pogreshnost = 2;
    if ($dlina == 3) $pogreshnost = 6;
    if ($dlina == 4) $pogreshnost = 10;
    if ($dlina == 5) $pogreshnost = 14;
    if ($dlina == 6) $pogreshnost = 18;
    if ($dlina == 7) $pogreshnost = 22;
    if ($dlina == 8) $pogreshnost = 26;
    if ($dlina > 1) $x = $x - $dlina - $pogreshnost;
    return ($x);
}


/* IMPLEMENTED FUNCTIONS */
include(ROOT . DS . 'functions.inc.php');

/* PLAYER STATS SQL FUNCTIONS*/
include(ROOT . DS . 'playerstats.inc.php');
include(ROOT . DS . 'awards.inc.php');
include(ROOT . DS . 'expansions.inc.php');

/* RANKING STATS SQL FUNCTIONS*/
include(ROOT . DS . 'rankingstats.inc.php');

/* SEARCH SQL FUNCTIONS*/
include(ROOT . DS . 'search.inc.php');

/* LEADERBOARD AND HOME (as home includes leaderboard) */
include(ROOT . DS . 'leaderboard.inc.php');


if (isCached($PID . 'badge')) // already cached!
{
    $data = unserialize(getCache($PID . 'badge'));

    $score = $data['score'];
    $kd = $data['kd'];
    $acc = $data['acc'];
    $country = $data['country'];
    $rank = $data['rank'];
    $name = $data['name'];
    $goldMedal = $data['gold_medal'];
    $silverMedal = $data['silver_medal'];
    $bronzeMedal = $data['bronze_medal'];
} else {
    $player = getPlayerDataFromPID($PID); // receive player data
    $PlayerAwards = getAwardsByPID($PID);
    $weapons = getWeaponData($PID, $player); // retrieve Weapon data
    $weaponSummary = getWeaponSummary($weapons, $player); // retrieve weapon summary

    $score = $player['score'];
    $kd = ($player['deaths'])?($player['kills'] / $player['deaths']):$player['kills'];
    $acc = $weaponSummary['average']['acc'];
    $country = $player['country'];
    $rank = $player['rank'];
    $name = $player['name'];
    $goldMedal = $PlayerAwards[22][0][1];
    $silverMedal = $PlayerAwards[21][0][1];
    $bronzeMedal = $PlayerAwards[20][0][1];

    writeCache($PID . 'badge', serialize([
        'score' => $score,
        'kd' => $kd,
        'acc' => $acc,
        'country' => $country,
        'rank' => $rank,
        'name' => $name,
        'gold_medal' => $goldMedal,
        'silver_medal' => $silverMedal,
        'bronze_medal' => $bronzeMedal,
    ]));

}




$im = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/site-images/badge.png');
$rankImage = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/game-images/ranks/header/rank_' . $rank . '.png');
$countryImage = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/game-images/flags/' . strtoupper($country) . '.png');

imagecopy($im, $rankImage, 5, 4, 0, 0, 56, 56);
imagecopyresized($im, $countryImage, 66, 4, 0, 0, 16, 12, 32, 24);

$yellowColor = imagecolorallocate($im, 246, 182, 32);
$blackColor = imagecolorallocate($im, 0, 0, 0);


imagestring($im, 5, 86, 2, $name, $blackColor);
imagestring($im, 2, sm(203, $score), 21, $score, $yellowColor);
imagestring($im, 2, sm(203, round($kd, 2)), 34, round($kd, 2), $yellowColor);
imagestring($im, 2, sm(203, round($acc, 2) . '%'), 47, round($acc, 2) . '%', $yellowColor);

imagestring($im, 2, sm(250, 'x' . $goldMedal), 47, 'x' . $goldMedal, $yellowColor);
imagestring($im, 2, sm(292, 'x' . $silverMedal), 47, 'x' . $silverMedal, $yellowColor);
imagestring($im, 2, sm(331, 'x' . $bronzeMedal), 47, 'x' . $bronzeMedal, $yellowColor);

// Output the image
header('Content-type: image/png');

imagepng($im);