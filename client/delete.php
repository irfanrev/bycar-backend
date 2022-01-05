<?php
include '../db.php';

$response=null;
try {
    
    $id = $_GET['id'];
    $query = "DELETE FROM client WHERE id_client = '$id'";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $response['message'] = "Client berhasil dihapus";  

}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
}

echo json_encode($response);