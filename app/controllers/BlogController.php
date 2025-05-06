<?php
require_once '../app/core/Controller.php';
class BlogController extends Controller {
    public function index($id = null, $name = null) {
        echo $id;
        echo $name;
        $this->view('BlogHome');
    }

    public function blog(){
        echo "this blog page";
    }

    public function showReadMe() {
        $pdfFilePath = 'readme.pdf'; // Path to your PDF file

        // Check if the file exists
        if (!file_exists($pdfFilePath)) {
            die('Error: The requested PDF file does not exist.');
        }

        // Set headers to display the PDF in the browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="readme.pdf"');
        header('Content-Length: ' . filesize($pdfFilePath));

        // Read and output the PDF file
        readfile($pdfFilePath);
        exit;
    }
}