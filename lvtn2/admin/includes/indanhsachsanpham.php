<?php
require "fpdf.php";
class myPDF extends FPDF
{
    function header()
    {
        $this->Cell(276, 5, 'DSSP', 0, 0, 'C');
        $this->Ln();
    }
    function footer()
    {
        $this->SetY(-15);
        $this->Cell(0, 10, 'Trang ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    function headerTable()
    {
        $this->Cell(40, 10, '1', 1, 0, 'C');
        $this->Cell(20, 10, '2', 1, 0, 'C');
        $this->Cell(20, 10, '3', 1, 0, 'C');
        $this->Cell(20, 10, '4', 1, 0, 'C');
    }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4', 0);
$pdf->headerTable();
$pdf->Output();
