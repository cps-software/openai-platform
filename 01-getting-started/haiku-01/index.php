<?php
/*
|----------------------------------------------------------------------
| index.php
|----------------------------------------------------------------------
| Make a call to OpenAI module to get a response to a prompt.
| Use the PHP curl class.
| Display results as a webpage.
*/

// function that performs the work to communicate with OpenAI
require_once './haiku.php';

$haikuPoem = get_haiku();
$haikuPoemJSON = json_decode($haikuPoem, true);

// Access the generated poem
if (isset($haikuPoemJSON['object'])) {
  // echo "Response object: " . trim($haikuPoemJSON['object']);
} else {
  echo "No text was generated...";
}

// get message content
$haikuText = $haikuPoemJSON['choices'][0]['message']['content'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="star-logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="main.css">
  <title>Haiku 01</title>
</head>

<body>
  <header>
    <h1>Haiku 01</h1>
    <hr>
  </header>
  <main>
    <p><?= DATA['messages'][0]['content']; ?></p>
    <hr>
    <p><?= $haikuText; ?></p>
  </main>

</body>

</html>