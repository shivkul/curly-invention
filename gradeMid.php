<?php include 'config.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/7/2018
 * Time: 8:50 PM
 */
$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
$studentID = $_COOKIE['userid'];
$data = [];
foreach ($resp as $r) {
    $data = array('studentID' => $studentID,
        'answer' => $r['ans'],
        'id' => $r['id']);
}
$responseFromBack = passToBack($data);
echo $responseFromBack;

function passToBack($data)
{
    $url = $GLOBALS['BACK_PATH'] . "gradeBack.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}