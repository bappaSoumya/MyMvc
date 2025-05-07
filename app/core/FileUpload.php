<?php

class FileUpload {
    protected $file;
    protected $errors = [];
    protected $allowedExtensions = [];
    protected $maxSize = 0; // In bytes

    public function __construct($file) {
        $this->file = $file;
    }

    /**
     * Set allowed file extensions.
     *
     * @param array $extensions
     */
    public function setAllowedExtensions(array $extensions) {
        $this->allowedExtensions = $extensions;
    }

    /**
     * Set maximum file size.
     *
     * @param int $size Maximum size in bytes
     */
    public function setMaxSize($size) {
        $this->maxSize = $size;
    }

    /**
     * Validate the uploaded file.
     *
     * @return bool
     */
    public function validate() {
        // Check for upload errors
        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = 'File upload error.';
            return false;
        }

        // Check file size
        if ($this->maxSize > 0 && $this->file['size'] > $this->maxSize) {
            $this->errors[] = 'File exceeds the maximum allowed size.';
            return false;
        }

        // Check file extension
        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        if (!empty($this->allowedExtensions) && !in_array(strtolower($extension), $this->allowedExtensions)) {
            $this->errors[] = 'Invalid file type.';
            return false;
        }

        return true;
    }

    /**
     * Save the uploaded file to the specified directory.
     *
     * @param string $directory
     * @param string|null $newFileName
     * @return string|false The file path if successful, false otherwise
     */
    public function save($directory, $newFileName = null) {
        if (!$this->validate()) {
            return false;
        }

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Generate a new file name if not provided
        $fileName = $newFileName ?? uniqid() . '.' . pathinfo($this->file['name'], PATHINFO_EXTENSION);

        // Move the uploaded file
        $filePath = rtrim($directory, '/') . '/' . $fileName;
        if (move_uploaded_file($this->file['tmp_name'], $filePath)) {
            return $filePath;
        }

        $this->errors[] = 'Failed to save the file.';
        return false;
    }

    /**
     * Get validation errors.
     *
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
}