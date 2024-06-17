<?php

require_once('vendor/autoload.php');

class Report {
    public $pdf = null;

    public function __construct() {
        $this->pdf = new TCPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('helvetica', '', 12);

        $this->pdf->Cell(0, 10, 'Library Management System Report', 0, 1, 'C');
    }

    public function generateSection($conn, $title, $query, $headers, $size) {
        $this->pdf->SetFont('helvetica', 'B', 14);
        $this->pdf->Cell(0, 10, $title, 0, 1, 'L');
        $this->pdf->SetFont('helvetica', '', 12);

        $data = $conn->query($query, [])->fetchall();

        if (empty($data)) {
            $this->pdf->Cell(0, 10, 'No data available', 0, 1, 'L');
        } else {
            // Header
            foreach ($headers as $header) {
                $this->pdf->Cell($size, 10, $header, 1);
            }
            $this->pdf->Ln();
    
            // Data rows
            foreach ($data as $row) {
                foreach ($row as $cell) {
                    $this->pdf->Cell($size, 10, $cell, 1);
                }
                $this->pdf->Ln();
            }
        }
    }

    public function output($filename) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "views/static/reports/" . $filename;
        
        $directory = dirname($filename);
        if (!is_dir($directory)) {
            dprint("hello");
            mkdir($directory, 0777, true);
        }
        $this->pdf->Output($filename, 'F');
    }
}