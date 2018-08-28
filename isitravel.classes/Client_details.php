<?php

/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */
include_once '../isitravel.config/isitravel_config.php';

class Client_details
{
    private $connector;

    public function __construct()
    {

        $isitravel_config = new isitravel_config();
        $this->connector = $isitravel_config->getConnection();
    }

    public function getClientDetails($client_data)
    {
        $query = $this->connector->prepare("SELECT * FROM client WHERE client.client_id = ?");
        $query->execute(array($client_data));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}