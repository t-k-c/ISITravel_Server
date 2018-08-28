<?php

/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 16/09/2017
 * Time: 17:30
 */
include_once '../isitravel.config/isitravel_config.php';
class Trip_details
{
    private $connector;

    public function __construct()
    {

        $isitravel_config = new isitravel_config();
        $this->connector = $isitravel_config->getConnection();
    }

    public function getTripDetailsForSpecificDriver($driver_id)
    {
        $query = $this->connector->prepare("SELECT * FROM frame WHERE frame.driver_id = ?");
        $query->execute(array($driver_id));
        $r = $query->fetchAll(PDO::FETCH_ASSOC);
        //forming json
        $json = "[";
        for($i = 0; $i<count($r);$i++){
            $json.=str_replace("}",",",json_encode($r[$i])).str_replace("{","",json_encode($this->getAssociatedtrip($r[$i]['frame_id'])));
            if($i!=(count($r)-1)){
                $json.=",";
        }
        }
        $json .= "]";
        return $json;
    }
    public function getTripDetails($frame_id)
    {
        $query = $this->connector->prepare("SELECT * FROM frame WHERE frame.frame_id = ?");
        $query->execute(array($frame_id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function updateTripInfo($frame_id,$temp,$trip_lat,$trip_long,$trip_speed)
    {
        $query = $this->connector->prepare("SELECT * FROM info WHERE info.frame_id = ?");
        $query->execute(array($frame_id));
        $result= $query->fetch(PDO::FETCH_ASSOC);
        $date = new DateTime('now',new DateTimeZone('Africa/Douala'));
        if(!empty($result)){ //at times, result returns just a 1
            $query2 = $this->connector->prepare("UPDATE info SET temp = ?, speed = ?, longitude = ?, latitude = ?, timestamp = NOW() WHERE info.frame_id ={$frame_id}");
            $query2->execute(array($temp,$trip_speed,$trip_long,$trip_lat));
        }
        else{
            $query3 = $this->connector->prepare("INSERT INTO info (temp,speed,longitude,latitude,frame_id,timestamp) VALUES(?,?,?,?,{$frame_id},NOW())");
            $query3->execute(array($temp,$trip_speed,$trip_long,$trip_lat));//ss
        }
    }
    public function abortTrip($frame_id){
        $query = $this->connector->prepare("SELECT * FROM info WHERE info.frame_id = ?");
        $query->execute(array($frame_id));
        $result= $query->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            $query2 = $this->connector->prepare("DELETE FROM info WHERE info.frame_id ={$frame_id}");
            $query2->execute();
        }
        $query3 =  $this->connector->prepare("UPDATE frame SET status = 0 WHERE frame.frame_id ={$frame_id}");
        $query3->execute();
    }
    public function startTrip($frame_id){
//        $curent_time = date('h:i:s');
        $query = $this->connector->prepare("UPDATE frame SET status = 1, actual_departure_hour = NOW() WHERE frame.frame_id ={$frame_id}");
        $query->execute();
    }
    public function getAssociatedtrip($frame_id){
        $trip_details = $this->getTripDetails($frame_id);
        $query = $this->connector->prepare("SELECT * FROM trip WHERE  trip.trip_id = {$trip_details['trip_id']}");
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
