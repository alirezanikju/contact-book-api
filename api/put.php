<?php

header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] !== "PUT"){

    echo json_encode([
        "status"=> "error",
        "msg"=> "just put method"
    ]);
    exit;
}

$rawData = file_get_contents("php://input");
$data = json_decode($rawData , true);

if(!isset($data['id']) || !isset($data['name']) || !isset($data['phone'])){
    echo json_encode([
        "status"=> "erorr",
        "msg"=> "set name and phone and id plz"
    ]);
exit;
}

$contacts = json_decode(file_get_contents("../contacts.json"),true);

$found = false;
foreach($contacts as $contact){
    if($contact['id'] === $data['id'] ){
        $contact['name'] === $data['name'];
        $contact['phone'] === $data['phone'];
        $found = true;
        break;
    }
}

if(!$found){
    echo json_encode([
        "status"=> "error",
        "msg"=> "contacts not found"
    ]);
    exit;
}


file_put_contents("../contacts.json", json_encode($contacts,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode([
    "status"=> "ok",
    "msg"=> "edit succ"
]);



