<?php
/*
|----------------------------------------------------------------------
| Haiku.php
|----------------------------------------------------------------------
| Make a call to OpenAI API and return response to calling object.
| Use PHP cURL library.
*/

require_once './config.php';

class Haiku
{
  public function getOpenAiMessage(): string
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
}
