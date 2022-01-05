<?php
include '../db.php';

$response=null;
try {
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $data = json_decode(file_get_contents("php://input"));

        $id_client = $data->id_client;
        $waktu = date('Y-m-d H:i:s');
        $alamat = $data->alamat;
        $lat = $data->lat;
        $lng = $data->lng;
        $list_pesanan = $data->list_pesanan;
        $total_biaya = $data->total_biaya;
        $ket = $data->ket;
        
        $query = "INSERT INTO pesan_mobil (id_client, waktu, alamat, lat, lng, list_pesanan, total_biaya, ket) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);

        $stmt->execute([$id_client, $waktu, $alamat, $lat, $lng, $list_pesanan, $total_biaya, $ket]);

        $response['message'] = "Berhasil melakukan pemesanan mobil, silahkan tunggu supir mengantarkan mobil yang anda anda pesan.";
        $response['id_pesan_mobil'] = $conn->lastInsertId();
    }
}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
    $response['id_pesan_mobil'] = null;
}

echo json_encode($response);