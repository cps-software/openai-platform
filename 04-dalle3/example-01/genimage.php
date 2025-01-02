<?php
session_start();

require_once './apikey.php';

// Replace with your OpenAI API key
$api_key = API_KEY;

// Check if prompt and size are provided
if (isset($_POST['prompt']) && isset($_POST['size'])) {
  $prompt = htmlspecialchars(trim($_POST['prompt']));
  $size = htmlspecialchars(trim($_POST['size']));

  if (!empty($prompt) && !empty($size)) {
    // Initialize cURL session
    $ch = curl_init();

    // Payload for the API request
    $payload = json_encode([
      "prompt" => $prompt,
      "n" => 1,
      "model" => "dall-e-3",
      "size" => $size,
      "response_format" => "url",
      "user" => session_id() // Use session ID as user identifier
    ]);

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/images/generations");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "Authorization: Bearer $api_key"
    ]);

    // Execute the cURL request
    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_status == 200) {
      $data = json_decode($response, true);
      if (isset($data['data'][0]['url'])) {
        $image_url = $data['data'][0]['url'];

        // Store the generated image in the session history
        if (!isset($_SESSION['history'])) {
          $_SESSION['history'] = [];
        }
        $_SESSION['history'][] = ['prompt' => $prompt, 'images' => [$image_url]];

        // Return the image URL as JSON
        echo json_encode(['url' => $image_url]);
      } else {
        echo json_encode(['error' => 'Failed to generate image.']);
      }
    } else {
      // Handle API or cURL errors
      $data = json_decode($response, true);
      $error_message = isset($data['error']['message']) ? $data['error']['message'] : 'Unknown error occurred.';
      echo json_encode(['error' => $error_message]);
    }
  } else {
    echo json_encode(['error' => 'Invalid prompt or size.']);
  }
} else {
  echo json_encode(['error' => 'No prompt or size provided.']);
}
