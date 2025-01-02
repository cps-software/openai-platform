<?php

require_once './apikey.php';

class ChatBot
{
  // authorization token for the API
  private $authorization;

  //endpoint URL for the OpenAI.com API
  private $endpoint;

  // ChatBot constructor.
  public function __construct()
  {
    // provide my openAI API key
    $this->authorization = API_KEY;

    // openAI API endpoint we want to use
    $this->endpoint = 'https://api.openai.com/v1/chat/completions';
  }

  public function sendMessage(string $message): string
  {
    // Read sample data from our JSON file
    $jsonSampleData = file_get_contents("test-data.json");

    // Prepare data for sending
    $data = [
      'messages' => [
        [
          'role' => 'system',
          'content' => 'You are a kind and helpful customer service member at a PC components store.
                    You speak in a formal british style.
                    If the user asks how to buy, refer them to our website at https://medium.com/winkhosting.
                    If the user asks anything about CPUs, RAM, or monitors, use exclusively the cpu, ram, and monitor input in the following JSON string to suggest options:' . $jsonSampleData
        ],
        [
          'role' => 'user',
          'content' => $message
        ],
      ],
      'model' => 'gpt-4o'
    ];

    // Set headers for the API request
    $headers = [
      'Content-Type: application/json',
      'Authorization: Bearer ' . $this->authorization,
    ];

    // Send the request to the API using cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    // Check for errors in the API response
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      curl_close($ch);
      throw new Exception('Error sending the message: ' . $error);
    }

    curl_close($ch);

    // Parse the API response
    $arrResult = json_decode($response, true);
    $resultMessage = $arrResult["choices"][0]["message"]["content"];

    // Return the response message
    return $resultMessage;
  }
}
