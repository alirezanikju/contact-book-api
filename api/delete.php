<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] === "DELETE"){

$rawData = file_get_contents("php://input");
$data = json_decode($rawData , true);

if(!isset($data['id'])){
    echo json_encode([
        "status"=> "error",
        "msg"=> "send id plz"
    ]);
        exit;
}

$contacts = json_decode(file_get_contents("../contacts.json"),true);

$filtered = array_values(array_filter($contacts , fn($c)=> $c['id'] !== $data['id']));

file_put_contents("../contacts.json", json_encode($filtered, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo json_encode([
    "status"=>"ok",
    "msg"=>"delete ok"
]);

}