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
  'prompt' => 'Sixty year old man with thinning blonde hair and blue eyes. Height is five feet nine inches. Weight is 185 pounds. He is wearing glasses. He has a slight smile and has a gray cat on his lap. Show most of mans body. Draw as a cartoon.',
  'n' => 1,
  'size' => '1024x1024',
]);
