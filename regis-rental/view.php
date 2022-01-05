<?php
include '../db.php';

$result=null;
$id = $_GET['id'];

$query = "SELECT * FROM regis_rental WHERE id_regis_rental = '$id'";

$sql = $conn->query($query);
$result_regis_rental = $sql->fetch(PDO::FETCH_ASSOC);

$result = $result_regis_rental;
$id_client = $result_regis_rental['id_client'];
$result_client = $conn->query("SELECT * FROM client WHERE id_client = '$id_client'")->fetch(PDO::FETCH_ASSOC);
$result['id_client'] = $result_client;

$id_supir = $result_regis_rental['id_supir'];
$result_supir = $conn->query("SELECT * FROM supir WHERE id_supir = '$id_supir'")->fetch(PDO::FETCH_ASSOC);
$result['id_supir'] = $result_supir;

echo json_encode($result);