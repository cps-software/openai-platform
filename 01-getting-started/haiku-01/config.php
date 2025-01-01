<?php
/*
|----------------------------------------------------------------------
| config.php
|----------------------------------------------------------------------
| Configuration values as constants
| Includes the prompt info sent to the API
*/

// secret info not under source control (get from a teammate)
require_once './apikey.php';

// OpenAI API endpoint
define('BASE_URL', 'https://api.openai.com/v1/chat/completions');

// post data to send
define('DATA', [
  'model' => 'gpt-4o-mini',
  'store' => true,
  'messages' => [
    [
      'role' => 'user',
      'content' => 'Write a haiku about looking forward to a great new year. It will be great as a result of our persistent pursuit of a goal. Write a second haiku based on this description, but is funny. Create a visual separation between the two poems with a smiley face emoji.',
    ]
  ]
]);
