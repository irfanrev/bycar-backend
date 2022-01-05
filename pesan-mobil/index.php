<?php
include '../db.php';

$result=null;
$id_client = $_GET['id_client'] ?? null;
$is_selesai = $_GET['is_selesai'] ?? null;

$query = "SELECT * FROM pesan_mobil";

if ($id_client!=null){
    $query = $query."  WHERE id_client = '$id_client'";
}

if ($is_selesai!=null){
    $query = $query." WHERE is_selesai = '$is_selesai'";
}

$sql = $conn->query($query);
$result_pesan_mobil = $sql->fetchAll(PDO::FETCH_ASSOC);

$result = $result_pesan_mobil;
foreach($result as $i => $regis){
    $id_client = $regis['id_client'];
    $result_client = $conn->query("SELECT * FROM client WHERE id_client = '$id_client'")->fetch(PDO::FETCH_ASSOC);
    $result[$i]['id_client'] = $result_client;

}

echo json_encode($result);