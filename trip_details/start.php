<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 25/09/2017
 * Time: 22:50
 */
if(isset($_POST['frame_id'])){
include_once '../isitravel.classes/Trip_details.php';
    $frame_id = $_POST['frame_id'];
    $trip_details = new Trip_details();
    $trip_details->startTrip($frame_id);
}