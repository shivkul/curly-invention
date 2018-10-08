<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/6/2018
 * Time: 11:43 PM
 * Grading should be done here.
 */

$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true); // decoding received JSON to array
print_r($response);