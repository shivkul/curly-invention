<?php include 'config.php'; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/7/2018
 * Time: 11:42 PM
 */
$str_json = file_get_contents('php://input');
$resp = json_decode($str_json, true);
$data = [];
foreach ($resp as $r) {
    $data[] = array('assest' => $r['assest'],
        'id' => $r['id'],
        'feedback' => $r['feedback']);
}
$res = passToBack($data);

function passToBack($data)
{
    $url = $GLOBALS['BACK_PATH'] . "release_back.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
