<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 9/7/2018
 * Time: 3:00 PM
 */

//receiving data
$url = URL_TO_RECEIVING_PHP; //change for url
$username = 0;
$password = 0;
$fields = array(
    $username => $_POST["username"],
    $password => $_POST["password"]
);

echo $_POST["username"];
echo $_POST["password"];
$postvars = '';
$sep = '';
foreach ($fields as $key => $value) {
    $postvars .= $sep . urlencode($key) . '=' . urlencode($value);
    $sep = '&';
}
$ch1 = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch1);
curl_close($ch1);
echo $result;

//sending to backend
$data = array(
    'username' => $username,
    'password' => $password
);
$url = URL_TO_SEND;
$ch2 = curl_init($url);
$postString = http_build_query($data, '', '&');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch2);//store response from backend in response JSON
curl_close(ch2);


//checking njit login
$result = "";
$ch = curl_init();
$url = "https://webauth.njit.edu";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $password);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$store = curl_exec($ch);
if ($store) {
    $result = "NJIT SUCCESS";
} else {
    $result = "NJIT FAIL";
}
var_dump($store);
curl_close($ch);
exit;

