<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 25/09/2017
 * Time: 21:56
 */
include_once '../isitravel.config/isitravel_config.php';
include_once '../isitravel.classes/Trip_details.php';
if(isset($_POST['frame_id']))
{
    $frame_id= $_POST['frame_id'];
    $trip_details = new Trip_details();
    $frame_details_assoc = $trip_details->getTripDetails($frame_id);
    $trip_details_assoc =$trip_details->getAssociatedtrip($frame_id);
   echo str_replace("}",",",json_encode($trip_details_assoc)).str_replace("{","",json_encode($frame_details_assoc));
}
