<?php
class UserController extends Controller {
    public function __construct() { // Example model loading
        $this->library('ApiLibrary');
    }
    public function getUsers() {
        // Example data (replace with database query)
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
        ];

        // Send JSON response
        ApiLibrary::sendResponse($users);
    }

    public function createUser() {
        // Get JSON input
        $data = ApiLibrary::getRequestData();

        // Validate input
        if (empty($data['name']) || empty($data['email'])) {
            ApiLibrary::sendError('Name and email are required.', 422);
        }

        // Example response (replace with database insertion logic)
        $newUser = [
            'id' => rand(100, 999), // Example ID
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        // Send JSON response
        ApiLibrary::sendResponse($newUser, 201);
    }
}