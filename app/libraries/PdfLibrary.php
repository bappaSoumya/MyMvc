<?php

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    protected $dompdf;

    public function __construct() {
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html) {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size = 'A4', $orientation = 'portrait') {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render() {
        $this->dompdf->render();
    }

    public function stream($filename = 'document.pdf', $options = ['Attachment' => true]) {
        $this->dompdf->stream($filename, $options);
    }

    public function output() {
        return $this->dompdf->output();
    }
}