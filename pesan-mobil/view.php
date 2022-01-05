<?php
include '../db.php';

$result=null;
$id = $_GET['id'] ?? null;

$query = "SELECT * FROM pesan_mobil WHERE id_pesan_mobil = '$id'";

$sql = $conn->query($query);
$result_pesan_mobil = $sql->fetch(PDO::FETCH_ASSOC);

$result = $result_pesan_mobil;
$id_client = $result_pesan_mobil['id_client'];
$result_client = $conn->query("SELECT * FROM client WHERE id_client = '$id_client'")->fetch(PDO::FETCH_ASSOC);
$result['id_client'] = $result_client;

echo json_encode($result);