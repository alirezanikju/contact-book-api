<?php

header("Content-Type: application/json");

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $rawData = file_get_contents("php://input");
    echo $rawData;
    $data = json_decode($rawData , true);

    if(!isset($data['name']) || !isset($data['phone'])){
        echo json_encode([
            "status"=> "error",
            "msg"=> "add name and phone number"
        ], JSON_UNESCAPED_UNICODE);
    exit;
    }

    $contacts = json_decode(file_get_contents("../contacts.json"), true);


    if(!is_array($contacts)){
        $contacts = [];
    }

    $newContacts = [
        "id"=> uniqid(),
        "name"=> $data['name'],
        "phone"=> $data['phone']
    ];

    $contacts[] = $newContacts;

    file_put_contents("../contacts.json" , json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode([
        "status"=>"ok",
        "contacts"=>$newContacts
    ]);

}
elseif($_SERVER["REQUEST_METHOD"] === "GET"){
    // echo json_encode([
    //     "status"=> "error",
    //     "msg"=> "just get method"
    // ], JSON_UNESCAPED_UNICODE);
// }

$contacts = json_decode(file_get_contents("../contacts.json"), true);

if(!is_array($contacts)){
    $contacts = [];
}


echo json_encode([
    "status"=> "ok",
    "contacts"=> $contacts
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

}


