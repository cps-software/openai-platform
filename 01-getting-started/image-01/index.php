<?php
/*
|----------------------------------------------------------------------
| index.php
|----------------------------------------------------------------------
| Make a call to OpenAI API to generate an image.
*/

require_once './OaImage.php';

$image = new OaImage();
$display = $image->getOpenAiMessage();

$messageJSON = json_decode($display, true);

// Access the response message
if (isset($messageJSON['object'])) {
  // echo "<br>Response object: " . trim($messageJSON['object']);
} else {
  // echo "No text was generated...";
}

// get message content
// $messageText = $messageJSON['choices'][0]['message']['content'];
$messageText = $messageJSON['data'][0]['url'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <title>Gray Cat</title>
</head>

<body>
  <header>
    <h1>Gray Cat on Heating Pad</h1>
  </header>
  <main>
    <p><?= '<img src="' . $messageText . '" height="45px"></img>' ?></p>
  </main>
</body>

</html>