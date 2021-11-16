<?php
    date_default_timezone_set("Asia/Jakarta");

    $file = 'dataDestination.json';
    $json = file_get_contents($file);

    $data = json_decode($json);

    foreach($data->destinations as $destination){
        $open_hour = strtotime($destination->jam_buka);
        $close_hour = strtotime($destination->jam_tutup);

        if($open_hour == $close_hour){
            $destination->status = 'Buka';
        }else{
            if(time() > $open_hour && time() < $close_hour){
                $destination->status = 'Buka';
            }else{
                $destination->status = 'Tutup';
            }
        }
    }

    if(isset($_GET['q'])){
        $query = $_GET['q'];

        $result = array_filter($data->destinations, function ($destination) use ($query) {
            return str_contains(strtolower($destination->nama_wisata), strtolower($query));
        });  

        echo json_encode(array(
            "destinations" => $result
        ));
    }else{
        echo json_encode($data);
    }
?>