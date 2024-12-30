<?php
/*
|----------------------------------------------------------------------
| config.php
|----------------------------------------------------------------------
| Configuration value constants
*/

require_once './apikey.php';

// OpenAI API endpoint
define('BASE_URL', 'https://api.openai.com/v1/images/generations');

// Post data to send
define('DATA', [
  'prompt' => 'Small gray cat with light stripes and green eyes lying on a blue pad. There is a christmas tree and fireplace in the background. Show cat full body.',
  'n' => 1,
  'size' => '1024x1024',
]);
