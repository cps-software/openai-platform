<?php
/*
|----------------------------------------------------------------------
| config.php
|----------------------------------------------------------------------
| Configuration value constants
*/

require_once './apikey.php';

// OpenAI API endpoint
define('BASE_URL', 'https://api.openai.com/v1/chat/completions');

// Post data to send
define('DATA', [
  'model' => 'gpt-4o-mini',
  'messages' => [
    [
      'role' => 'system',
      'content' => 'You are a helpful assistant.',
    ],
    [
      'role' => 'user',
      'content' => 'Tell me two knock-knock jokes. Create a visual separator between the two jokes using a laughing emoji.',
    ]
  ]
]);
