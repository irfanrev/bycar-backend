<?php
include '../db.php';

$response=null;
try {
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $data = json_decode(file_get_contents("php://input"));
        
        $id_client = $data->id_client;
        $id_supir = $data->id_supir;
        $tgl_booking = $data->tgl_booking;
        $rental = $data->rental;
        
        $query = "INSERT INTO regis_rental (id_client, id_supir, tgl_booking, rental) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);

        $stmt->execute([$id_client, $id_supir, $tgl_booking, $rental]);

        $response['message'] = "Booking registrasi berhasil dibuat";  
        $response['id_regis_rental'] = $conn->lastInsertId();
    }
}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
    $response['id_regis_rental'] = null;
}

echo json_encode($response);