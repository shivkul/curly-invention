<?php include "config.php"; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 8:18 PM
 * This file passes a level to the backend so it shows the questions with that level
 */

$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
$level = "empty";
if (isset($resp['level'])) $level = $resp['level'];
$loginStatus = login($level);
echo $loginStatus;

function login($level)
{
    $data = array('level' => $level);
    $url = $GLOBALS['BACK_PATH'] . "viewQuestionsBack.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}
