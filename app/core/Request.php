<?php

class Request {
    protected $errors = [];
    protected $data = [];

    public function __construct() {
        $this->data = $_REQUEST; // You can extend this to handle GET or JSON input as well
        $this->saveOldInput($_REQUEST); // Save old input values
    }
    /**
     * Get all POST data.
     *
     * @return array
     */
    public function post() {
        return $_POST;
    }

    /**
     * Get all GET data.
     *
     * @return array
     */
    public function get() {
        return $_GET;
    }

    /**
     * Get all FILES data.
     *
     * @return array
     */
    public function files() {
        return $_FILES;
    }

    /**
     * Get a specific input value from POST, GET, or REQUEST.
     *
     * @param string $key The input key
     * @param mixed $default Default value if the key does not exist
     * @return mixed
     */
    public function input($key, $default = null) {
        return $this->data[$key] ?? $default;
    }
    /**
     * Validate the request method.
     *
     * @param string $method The expected request method (e.g., 'POST', 'GET')
     * @return bool True if the request method matches, false otherwise
     */
    public function method($method) {
        echo $_SERVER['REQUEST_METHOD'];
        exit;
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($method)) {
            $this->addError('request_method', "Invalid request method. Expected $method.");
            return false;
        }
        return true;
    }
    /**
     * Validate the input data based on the given rules and custom messages.
     *
     * @param array $rules Validation rules
     * @param array $messages Custom error messages
     * @return bool True if validation passes, false otherwise
     */
    public function validate(array $rules, array $messages = []) {
        // Validate CSRF token first
        $this->validateCsrfToken();

        foreach ($rules as $field => $ruleString) {
            $rulesArray = explode('|', $ruleString);
            foreach ($rulesArray as $rule) {
                $this->applyRule($field, $rule, $messages[$field][$rule] ?? null);
            }
        }

        return empty($this->errors);
    }
    /**
     * Save old input values to the session.
     *
     * @param array $data Input data to save
     */
    protected function saveOldInput($data) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['old'] = $data;
        
    }

    

    /**
     * Clear old input values from the session.
     */
    public function clearOldInput() {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['old']);
    }
    /**
     * Apply a single validation rule to a field.
     *
     * @param string $field Field name
     * @param string $rule Validation rule
     * @param string|null $customMessage Custom error message
     */
    protected function applyRule($field, $rule, $customMessage = null) {
        $value = $this->data[$field] ?? null;

        if (str_contains($rule, ':')) {
            [$ruleName, $parameter] = explode(':', $rule);
        } else {
            $ruleName = $rule;
            $parameter = null;
        }

        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, $customMessage ?? "$field is required.");
                }
                break;

            case 'string':
                if (!is_string($value)) {
                    $this->addError($field, $customMessage ?? "$field must be a string.");
                }
                break;

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, $customMessage ?? "$field must be a valid email address.");
                }
                break;

            case 'max':
                if (strlen($value) > (int)$parameter) {
                    $this->addError($field, $customMessage ?? "$field must not exceed $parameter characters.");
                }
                break;

            case 'min':
                if (strlen($value) < (int)$parameter) {
                    $this->addError($field, $customMessage ?? "$field must be at least $parameter characters.");
                }
                break;

            default:
                $this->addError($field, "Validation rule $ruleName is not supported.");
        }
    }

    /**
     * Validate the CSRF token.
     */
    protected function validateCsrfToken() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $csrfToken = $this->data['csrf_token'] ?? null;
        if (!$csrfToken || !hash_equals($_SESSION['csrf_token'] ?? '', $csrfToken)) {
            $this->addError('csrf_token', 'Invalid CSRF token.');
        }
    }

    /**
     * Add an error message for a field.
     *
     * @param string $field Field name
     * @param string $message Error message
     */
    protected function addError($field, $message) {
        $this->errors[$field][] = $message;
    }

    /**
     * Get all validation errors.
     *
     * @return array Validation errors
     */
    public function errors() {
        return $this->errors;
    }

}