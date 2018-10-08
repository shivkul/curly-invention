<?php include "config.php"; ?>
<?php
/**
 * Created by PhpStorm.
 * User: Shiv
 * Date: 10/7/2018
 * Time: 12:23 AM
 */
$str_json = file_get_contents('php://input');
$response = json_decode($str_json, true);
$mode = 1;
foreach ($response as $resp) {
    $studentID = $resp['studentID'];
    $ans = $resp['answer'];
    $questionID = $resp['id'];
    $sql = "SELECT * FROM question WHERE `id`='$questionID'";
    $query = $db->query($sql);
    $res = $query->fetch();
    /*$main=$res['code'];
    $main=rtrim($main);
    $main=rtrim($main,"}");
    $code=$main."\n\t".$ans."\n}";//APPENDING CODE INTO PRESET MAIN*/
    for ($i = 1; $i < 4; $i++) {
        $input = $res['input' . $i];
        if ($mode == 1) {
            exec("cp -rf ./backup/in.txt .");
            exec("cp -rf ./backup/Main.py .");
            file_put_contents("PYTHON_FILE_NAME", $code, FILE_APPEND);
        } else {
            file_put_contents("PYTHON_FILE_NAME", $code, FILE_APPEND);
        }
        exec("PYTHON_EXECUTE_COMMAND");
        if (file_exists("PYTHON_CLASS_FILE")) {
            $out = exec("PYTHON MAIN <in.txt");
            unlink("PYTHON_CLASS_FILE");
        } else {
            $out = '';
        }
        $s = 'output' . $i;
        //PASS OUTPUT TO BACK HERE
        //AND RUN HAVE IT RUN QUERY TO UPDATE ANSWER FOR STUDENT
    }
    //GET RESPONSE FROM QUERY
    if (QUERY_RESP_TRUE) echo "success";
    else echo "fail";
}