<?php

/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */
class isitravel_config
{
public function getConnection(){
    $connection=null;
    try {
        $connection = new PDO("mysql:host=localhost;dbname=isitravel", "isitravel", "ISItravel@1234");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('Africa/Douala');//set time zone
    } catch (PDOException $e) {
        die("error");
    }
    return $connection;
}
}