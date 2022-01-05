<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"));
$username = $data->username;
$password = sha1($data->password);

$query_user = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

$sql = $conn->query($query_user);
$result = $sql->fetch(PDO::FETCH_ASSOC);
$response=null;
if ($result!=false){
    $id_client = $result['id_client'];

    $query_client = "SELECT * FROM client WHERE id_client = '$id_client'";
    $result_client = $conn->query($query_client)->fetch(PDO::FETCH_ASSOC);
    $result_client = ($result_client!=false) ? $result_client : null;

    $response['message'] = "Selamat datang ".$result['username'];
    $response['user'] = $result;
    $response['user']['id_client'] = $result_client;
} else {
    http_response_code(401);
    $response['message'] = "Username atau Password salah";
    $response['user'] = null;
}
echo json_encode($response);