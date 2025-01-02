<?php

// include the definition of the ChatBot class to be used for our query
require("ChatBot.php");

// decode the parameters received from the index.html file and store them in $paramsFetch array
$paramsFetch = json_decode(file_get_contents("php://input"), true);

$ChatBot = new ChatBot();

// send the message to our AI
$resMessage = $ChatBot->sendMessage($paramsFetch["message"]);

// return the response in JSON format and exit the execution
$jsonResponse = json_encode(array("responseMessage" => $resMessage));
echo $jsonResponse;
exit;
