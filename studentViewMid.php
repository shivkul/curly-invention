<?php include "config.php" ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 11:31 PM
 */
$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
$loginStatus = passToBack();
echo $loginStatus;

function passToBack()
{
    $data = array('level' => "none");
    $url = $GLOBALS['BACK_PATH'] . "studentView_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}