<?php include "config.php" ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 11:41 PM
 * ID NAME DESCRIPT LEVEL should be passed here, backend should return details of each exam with
 * that name
 */
$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
if (isset($response['name'])) $name = $response['name'];
$loginStatus = passToBack($name);
echo $loginStatus;

function passToBack($name)
{
    $data = array('name' => $name);
    $url = $GLOBALS['BACK_PATH'] . "studentExamPage_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}