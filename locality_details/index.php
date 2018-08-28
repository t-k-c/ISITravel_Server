<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 01/10/2017
 * Time: 19:54
 */
include_once '../isitravel.config/isitravel_config.php';
include_once '../isitravel.classes/Locality_details.php';
if(isset($_POST['locality_name'])){
    $locality_name = $_POST['locality_name'];
    $locality_details = new Locality_details();
    $the_details = $locality_details->getLocalityDetails($locality_name);
    if(count($the_details)!=0)
    {
    echo json_encode($the_details);
    }
    else
    {
        echo '1';
    }
}
