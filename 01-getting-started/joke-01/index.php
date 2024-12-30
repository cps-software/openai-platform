<?php
/*
|----------------------------------------------------------------------
| index.php
|----------------------------------------------------------------------
| Create a human-like response to a prompt
*/

// interface to OpenAI API is via Haiku object
require_once './Joke.php';

$joke = new Joke();

$message = $joke->getOpenAiMessage();
$messageArray = json_decode($message, true);

// access the response message
if (isset($messageArray['object'])) {
  // echo "<br>Response object: " . trim($messageArray['object']);
} else {
  echo "No text was generated...";
}

// get message content
$messageText = $messageArray['choices'][0]['message']['content'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="star-logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="main.css">
  <title>Joke 1</title>
</head>

<body>
  <header>
    <h1>Joke 1</h1>
    <hr>
  </header>
  <main>
    <p><?= DATA['messages'][1]['content']; ?></p>
    <hr>
    <p><?= $messageText; ?></p>
  </main>
</body>

</html>