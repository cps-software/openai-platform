<?php
/*
|----------------------------------------------------------------------
| index.php
|----------------------------------------------------------------------
| Create a human-like response to a prompt
*/

require_once './Haiku.php';

$haiku = new Haiku();

$message = $haiku->getOpenAiMessage();
$messageJSON = json_decode($message, true);

// access the response message
if (isset($messageJSON['object'])) {
  // echo "<br>Response object: " . trim($messageJSON['object']);
} else {
  echo "No text was generated...";
}

// get message content
$messageText = $messageJSON['choices'][0]['message']['content'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="star-logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="main.css">
  <title>Haiku 2</title>
</head>

<body>
  <header>
    <h1>Haiku 2</h1>
    <hr>
  </header>
  <main>
    <p><?= DATA['messages'][1]['content']; ?></p>
    <hr>
    <p><?= $messageText; ?></p>
  </main>
</body>

</html>