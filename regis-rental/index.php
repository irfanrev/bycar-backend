<?php
include '../db.php';

$result=null;
$id_client = $_GET['id_client'] ?? null;
$id_supir = $_GET['id_supir'] ?? null;
$rental = $_GET['rental'] ?? null;
$tgl_booking_start = $_GET['tgl_booking_start'] ?? null;
$tgl_booking_end = $_GET['tgl_booking_end'] ?? null;

$query = "SELECT * FROM regis_rental";

if ($id_client!=null){
    $query = $query."  WHERE id_client = '$id_client'";
}

if ($id_supir!=null){
    $query = $query." AND WHERE id_supir = '$id_supir'";
}

if ($rental!=null){
    $query = $query." AND WHERE rental = '$rental'";
}

if ($tgl_booking_start!=null && $tgl_booking_end!=null){
    $tgl_booking_start = $tgl_booking_start." AND WHERE tgl_booking BETWEEN '$tgl_booking_start' AND '$tgl_booking_end'";
}

$sql = $conn->query($query);
$result_regis_rental = $sql->fetchAll(PDO::FETCH_ASSOC);

$result = $result_regis_rental;
foreach($result as $i => $regis){
    $id_client = $regis['id_client'];
    $result_client = $conn->query("SELECT * FROM client WHERE id_client = '$id_client'")->fetch(PDO::FETCH_ASSOC);
    $result[$i]['id_client'] = $result_client;

    $id_supir = $regis['id_supir'];
    $result_dokter = $conn->query("SELECT * FROM supir WHERE id_supir = '$id_supir'")->fetch(PDO::FETCH_ASSOC);
    $result[$i]['id_supir'] = $result_dokter;
}

echo json_encode($result);