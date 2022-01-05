<?php
include '../db.php';

$response=null;
try {
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_GET['id'];
        $nama = $_POST['Client']['nama'];
        $hp = $_POST['Client']['hp'];
        $email = $_POST['Client']['email'];
        
        $query = "UPDATE client SET nama = ?, hp = ?, email = ? WHERE id_client = '$id'";
        
        $stmt = $conn->prepare($query);
        $stmt->execute([$nama, $hp, $email]);
        $response['message'] = "Client berhasil diperbarui";  
    }
}catch (Exception $e){
    $response['message'] = "Gagal : ".$e->getMessage();
}

echo json_encode($response);