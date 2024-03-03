<?php

header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
header('Content-Type: application/json');
header('X-Robots-Tag: noindex, nofollow', true);

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") {

    $postData = trim(file_get_contents("php://input"));

    $data = json_decode($postData, true);

    if (is_array($data)) {

        $location = isset($data['location']) ? sanitizeInput($data['location']) : '';
        $apiKey = isset($data['apiKey']) ? sanitizeInput($data['apiKey']) : '';

        try {
            if (empty($location) || empty($apiKey)) {
                throw new Exception("Location and API key are required.");
            }

            $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . urlencode($location) . '&appid=' . $apiKey . '&units=metric';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            curl_close($ch);

            echo $response;

        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Invalid JSON data received.']);
    }
} else {
    echo json_encode(['error' => 'Unsupported content type.']);
}

?>