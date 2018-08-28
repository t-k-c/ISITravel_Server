<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 11/10/2017
 * Time: 10:51
 */
include_once '../isitravel.classes/Locality_details.php';
if(isset($_POST['trip_id'])){
    $trip_id  = $_POST['trip_id'];
    $locality_details = new Locality_details();
    echo $locality_details->getLocalitiesForTrip($trip_id);
}