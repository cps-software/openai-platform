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
  'prompt' => 'Sixty year old man with thinning blonde hair and blue eyes. Height is five feet ten inches. Weight is 180 pounds. He is wearing glasses. He has a slight smile and has a cat on his lap. Draw as a cartoon.',
  'n' => 1,
  'size' => '512x512',
]);

// I believe the supported image sizes are 256x256, 512x512, and 1024x1024
// The API only supports square images (currently)
