<?php

/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */

include_once '../isitravel.config/isitravel_config.php';

class Agency_details
{
    private $connector;

    public function __construct()
    {

        $isitravel_config = new isitravel_config();
        $this->connector = $isitravel_config->getConnection();
    }

    public function getAgencyDetails($agency_id)
    {
        $query = $this->connector->prepare("SELECT * FROM agency WHERE agency.agency_id = ?");
        $query->execute(array($agency_id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}