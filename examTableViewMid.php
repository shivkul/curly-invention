<?php include 'config.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 3:51 PM
 * This file receives a url to a table which has the table details,
 * the backend should return the corresponding exam
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$name = "empty";
if (isset($response['name'])) $name = $response['name'];
$res_proj = passToBack($name);
echo $res_proj;

function passToBack($name)
{
    $data = array('name' => $name);
    $url = $GLOBALS['BACK_PATH'] . "examTableViewBack.php"; //backend url
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}