<?php
/**
 * Project : ISItravel
 * Enterprise : Diginov.biz
 * Date: 16/09/2017
 * Time: 18:14
 */

if (isset($_POST['user_name'])) {
    include_once '../isitravel.classes/Driver_details.php';
    $user_name = $_POST['user_name'];
    $driver_details = new Driver_details();
    $dd = $driver_details->getDriverDetails($user_name);
    if (count($dd)) {
        include_once '../isitravel.classes/Agency_details.php';
        include_once '../isitravel.classes/Trip_details.php';
        include_once '../isitravel.classes/Client_details.php';
        $agency_details = new Agency_details();
        $trip_details = new Trip_details();
        $client_details = new Client_details();
        $ad = $agency_details->getAgencyDetails($dd['agency_id']);
        $td = $trip_details->getTripDetailsForSpecificDriver($dd['driver_id']);
        $cd = $client_details->getClientDetails($ad['client_id']);
        $ddjson = json_encode($dd);
        //$tdjson = json_encode($td); NO JSON FOR TD
        $adjson = json_encode($ad);
        $cdjson = json_encode($cd);
        if (count($ad)) {
            echo <<<PRINTT
{
 "driver" : {$ddjson},
 "agency" : {$adjson},
 "trips" : {$td},
 "client" : {$cdjson}
}
PRINTT;
        }
    }
}
