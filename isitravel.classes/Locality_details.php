<?php

/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 01/10/2017
 * Time: 19:49
 */

include_once '../isitravel.config/isitravel_config.php';
class Locality_details
{
    private $connector;
    public function __construct()
    {
        $isitravel_config = new isitravel_config();
        $this->connector = $isitravel_config->getConnection();
    }
   public function getLocalityDetails($locality_name)
   {
       $query = $this->connector->prepare("SELECT * FROM locality WHERE locality.name = ?");
       $query->execute(array($locality_name));
       return $query->fetch(PDO::FETCH_ASSOC);
   }
    public function getLocalityDetailsFromId($locality_id)
    {
        $query = $this->connector->prepare("SELECT * FROM locality WHERE locality.locality_id = ?");
        $query->execute(array($locality_id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
   public function getLocalitiesForTrip($trip_id)
   {
       $query = $this->connector->prepare("SELECT * FROM contains WHERE contains.trip_id = ?");
       $query->execute(array($trip_id));
       $result1  = $query->fetchAll(PDO::FETCH_ASSOC);
       $ans="[";
       for ($i =0;$i<count($result1);$i++){
          $ans.="{ \"locality\": ". json_encode($this->getLocalityDetailsFromId($result1[$i]['locality_id'])).", \"next_locality\": "
              . json_encode($this->getLocalityDetailsFromId($result1[$i]['next_locality_id'])) . "}";
           if($i!=count($result1)-1){
               $ans.=",";
           }
       }
       $ans.="]";
        return $ans;
   }
}
