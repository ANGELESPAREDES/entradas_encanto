<?php
require('../fpdf/fpdf.php');
require_once "../modelo/CRUDEntradas.php";

class PDF extends FPDF
{
    private $totalMonto = 0; // Add a property to store the total sum of 'monto'

    function Header()
    {
        // Logo
        // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',12);
        // Title
        $this->Cell(0,10,'REPORTES',0,1,'C');
        // Line break
        $this->Ln(10);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
    }

    function ChapterTitle($label)
    {
        // Arial 12
        $this->SetFont('Arial','B',12);
        // Background color
        $this->SetFillColor(200,220,255);
        // Title
        $this->Cell(0,6,"$label",0,1,'L',true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($data)
    {
        // encabezado de la tabla 
        $this->Cell(10);
        $this->Cell(30,10,utf8_decode('N° TICKET '),1,0,'C');
        $this->Cell(30,10,'FECHA',1,0,'C');
        $this->Cell(50,10,'PRODUCTO',1,0,'C');
        $this->Cell(30,10,'CANTIDAD',1,0,'C');
        $this->Cell(30,10,'MONTO',1,1,'C');
        // Read text file
        // Arial 12
        $this->SetFont('Arial','',12);
        // Output justified text
        foreach ($data as $row) {
            $this->Cell(10);
            $this->Cell(30,10,$row['ticket'],1);
            $this->Cell(30,10,$row['fecha'],1);
            $this->Cell(50,10,$row['producto'],1);
            $this->Cell(30,10,$row['cantidad'],1);
            $this->Cell(30,10,$row['monto'],1);
            $this->Ln();

            // Sum the 'monto' values
            
            $this->totalMonto += $row['monto'];
        }

        // Add the total sum row
        $this->Cell(10);
        $this->SetFont('Arial','B',12);
        $this->Cell(140,10,'Total:',1);
        $this->Cell(30,10,$this->totalMonto,1);
        $this->Ln();

        // Line break
        $this->Ln();
    }
}

// Retrieve date range from GET parameters
$min = $_GET['min'];
$max = $_GET['max'];

$listado = new Entradas;
$registros = $listado->listardetalle();
$filtered_data = [];

foreach ($registros as $fila) {
    if (($min == "" && $max == "") ||
        ($min == "" && $fila['fecha'] <= $max) ||
        ($min <= $fila['fecha'] && $max == "") ||
        ($min <= $fila['fecha'] && $fila['fecha'] <= $max)) {
        $filtered_data[] = $fila;
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->ChapterTitle('FILTRAR DATOS');
$pdf->ChapterBody($filtered_data);
$pdf->Output();
?>
