<?php

class ApiLibrary {
    /**
     * Send a JSON response
     *
     * @param mixed $data The data to send
     * @param int $status HTTP status code
     */
    public static function sendResponse($data, $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    /**
     * Get JSON input from the request
     *
     * @return mixed The decoded JSON input
     */
    public static function getRequestData() {
        $input = file_get_contents('php://input');
        return json_decode($input, true);
    }

    /**
     * Send an error response
     *
     * @param string $message Error message
     * @param int $status HTTP status code
     */
    public static function sendError($message, $status = 400) {
        self::sendResponse(['error' => $message], $status);
    }
}