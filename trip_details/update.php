<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 25/09/2017
 * Time: 22:19
 */
if(isset($_POST['temp'],$_POST['frame_id'],$_POST['longitude'],$_POST['speed'],$_POST['latitude'])){
    $frame_id = $_POST['frame_id'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $speed = $_POST['speed'];
    $temp = $_POST['temp'];
    include_once '../isitravel.classes/Trip_details.php';
    $trip_details = new Trip_details();
    $trip_details->updateTripInfo($frame_id,$temp,$latitude,$longitude,$speed);
}