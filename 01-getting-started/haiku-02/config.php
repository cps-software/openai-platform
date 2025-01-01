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
  'model' => 'gpt-4o',
  'messages' => [
    [
      'role' => 'system',
      'content' => 'You are an impatient assistant.',
    ],
    [
      'role' => 'user',
      'content' => 'Write a haiku that talks about the benefits of daily exercise. Write a second haiku about an early morning jog. Write a third haiku about enjoing a morning cup of coffee. Separate the first two poems with an exercise-related emoji. Separate the second and third poems with a coffee emoji. Complete this message with a snarky good morning greeting with three sun emojis before and after the greeting.',
    ]
  ]
]);
