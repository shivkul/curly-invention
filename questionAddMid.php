<?php include 'config.php' ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 11:15 PM
 *This file passes a new question that the backend should add to the DB
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$id = $response['id'];
if (isset($response['name'])) $name = $response['name'];
if (isset($response['level'])) $level = $response['level'];
if (isset($response['description'])) $description = $response['description'];
$res_proj = passToBack($id, $name, $description, $level);
echo $res_proj;

function passToBack($id, $name, $description, $level)
{
    $data = array('id' => $id, 'name' => $name, 'description' => $description, 'level' => $level);
    $url = $GLOBALS['BACK_PATH'] . "questionAdd_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}