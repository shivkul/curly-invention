<?php include "config.php"; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 8:18 PM
 * This file passes a username and password to the backend to validate if student or instructor
 */

$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
$username = "empty";
$pass = "empty";
if (isset($resp['username'])) $username = $resp['username'];
if (isset($resp['pass'])) $pass = $resp['pass'];
$loginStatus = login($username, md5($pass));
echo $loginStatus;

function login($username, $pass)
{
    $data = array('username' => $username, 'pass' => $pass);
    $url = $GLOBALS['BACK_PATH'] . "login_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}