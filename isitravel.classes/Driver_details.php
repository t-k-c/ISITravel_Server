<?php

/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */

include_once '../isitravel.config/isitravel_config.php';

class Driver_details
{
    private $connector;

    public function __construct()
    {

        $isitravel_config = new isitravel_config();
        $this->connector = $isitravel_config->getConnection();
    }

    public function getDriverDetails($user_name)
    {
        $query = $this->connector->prepare("SELECT * FROM driver WHERE driver.user_name=?");
        $query->execute(array($user_name));
        return $response = $query->fetch(PDO::FETCH_ASSOC);
    }

}