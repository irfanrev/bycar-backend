<?php
include '../db.php';

$response=null;
try {
    
    $id = $_GET['id'];
    $query = "UPDATE pesan_mobil SET is_selesai = '1' WHERE id_pesan_mobil = '$id'";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $response['message'] = "Pesanan berhasil diupdate";  

}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
}

echo json_encode($response);