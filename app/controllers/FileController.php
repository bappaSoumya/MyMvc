<?php


class FileController extends Controller {
    public function upload() {
        $request = new Request();
        // Validate the request method
        
        $fileData = $request->files();
        if (isset($fileData['file'])) {
            $fileUpload = new FileUpload($fileData['file']);

            // Set allowed extensions and max size (e.g., 2MB)
            $fileUpload->setAllowedExtensions(['jpg', 'png', 'pdf']);
            $fileUpload->setMaxSize(2 * 1024 * 1024); // 2MB

            // Save the file
            $uploadDir = '../storage/uploads';
            $filePath = $fileUpload->save($uploadDir);

            if ($filePath) {
                echo "File uploaded successfully: " . $filePath;
            } else {
                $errors = $fileUpload->getErrors();
                $this->view('file_upload', ['errors' => $errors]);
            }
        } else {
            $this->view('file_upload');
        }
    }
}