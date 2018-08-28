<?php
/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */
include_once '../isitravel.config/isitravel_config.php';
/*$ctnt = file_get_contents('php://input');
$postparams = json_decode($ctnt, true);*/

$response_code = -1;
$response_message = "An unexpected error occurred, try again";
if (isset($_POST['username'], $_POST['code'])) {
    $username = $_POST['username'];
    $code = $_POST['code'];
    try {
        $isitravel_config = new isitravel_config();
        $connection = $isitravel_config->getConnection();
        $query = $connection->prepare("SELECT * FROM driver WHERE driver.code = ?");
        $query->execute(array($code));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) {
            $response_code = 0;
            $response_message = "The user requested does not exist";
        } else if (count($result) == 1) {
            if ($result[0]['user_name'] == $username) {
                $response_code = 1;
                $response_message = "Log In Successful";
            } else {
                $response_code = 0;
                $response_message = "The user requested does not exist";
            }
        }
    } catch (PDOException $e) {

    }
    echo <<<END
{"response_code":"$response_code","message":"$response_message"}
END;
}