<?php include 'config.php' ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 11:15 PM
 * This file passes a question name which should contain qID, qDescription, qName, qLevel
 * Backend should return id, name, descript, and level
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$name = "empty";
$pass = "empty";
if (isset($response['name'])) $name = $response['name'];
$res_proj = passToBack($name);
echo $res_proj;

function passToBack($name)
{
    $data = array('name' => $name);
    $url = $GLOBALS['BACK_PATH'] . "questionView_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}