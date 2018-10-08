<?php include "config.php"; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 3:47 PM
 * This file passes questions in json format to the backend to be added to the questions table
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$id = $response['id'];
$name = $response['name'];
if (isset($response['questions'])) $questions = $response['questions'];
$res_proj = passToBack($id, $name, $questions);
echo $res_proj;

function passToBack($id, $name, $questions)
{
    $data = array('id' => $id, 'name' => $name, 'questions' => $questions);
    $url = $GLOBALS['BACK_PATH'] . "examTableAddBack.php"; //backend url
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $resp = curl_exec($ch);
    curl_close($ch);
    return $resp;
}