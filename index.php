<?php
    $file = 'dataDestination.json';
    $json = file_get_contents($file);

    $data = json_decode($json);

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