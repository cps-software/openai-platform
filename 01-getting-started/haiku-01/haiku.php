<?php
/*
|----------------------------------------------------------------------
| haiku.php
|----------------------------------------------------------------------
| Function to make call to OpenAPI model to prompt and get response
| Return response (a string formatted as JSON) caller
*/

require_once './config.php';

function get_haiku()
{
  // initiate a curl session and return a handle to the session
  $ch = curl_init(BASE_URL);

  // set request options
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . API_KEY,
  ]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(DATA));

  // execute API request
  $response = curl_exec($ch);

  // check for errors
  if ($response === false) {
    $error = curl_error($ch);
    echo 'cURL Error: ' . $error;
  } else {
    // received good response
    // echo 'cURL Success';
  }

  curl_close($ch);
  return $response;
}
