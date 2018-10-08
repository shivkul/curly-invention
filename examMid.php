<?php include 'config.php' ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 3:55 PM
 * This file receives nothing and tells the backend to get all rows from the exam table to display all of the
 * ids, names and questions
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$resp = passToBack();
echo $resp;

function passToBack()
{
    $data = array('level' => "none");
    $url = $GLOBALS['BACK_PATH'] . "exam_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}