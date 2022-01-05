<?php
include '../db.php';

$response=null;
try {
    
    $id = $_GET['id'];
    $query = "DELETE FROM regis_rental WHERE id_regis_rental = '$id'";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $response['message'] = "Registrasi berhasil dihapus";  

}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
}

echo json_encode($response);