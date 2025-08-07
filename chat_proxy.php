<?php
header('Content-Type: application/json');

$req = json_decode(file_get_contents('php://input'), true);
if (!$req || empty($req['user'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid input']);
  exit;
}

$prompt = $req['user'];

// 🛑 এখানে তোমার নতুন OpenAI Key বসাও:
$apiKey = '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';

$data = [
  'model' => 'gpt-4',
  'messages' => [
    ['role'=>'system','content'=>'You are SocialPro AI Assistant. Help the user politely.'],
    ['role'=>'user','content'=>$prompt]
  ],
  'temperature'=>0.7
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);

if (!$response) {
  http_response_code(500);
  echo json_encode(['error'=>'API request failed']);
  exit;
}

$json = json_decode($response, true);
$reply = $json['choices'][0]['message']['content'] ?? 'No answer.';
echo json_encode(['reply'=> $reply]);
