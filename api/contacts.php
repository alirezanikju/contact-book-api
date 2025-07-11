<?php

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "GET"){
    echo json_encode([
        "status"=> "error",
        "msg"=> "just get method"
    ], JSON_UNESCAPED_UNICODE);
}

$contects = json_decode(file_get_contents("../contacts.json"), true);

if(!is_array($contects)){
    $contects = [];
}


echo json_encode([
    "status"=> "ok",
    "contects"=> $contects
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);




