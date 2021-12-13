<?php
require('../../assets/fpdf.php');

class PDF extends FPDF{
// Cabecera de página
function Header(){
    // Logo
    $this->Image('../../Vista/assets/img/anli.jpg',10,8,40);
    // Arial bold 15

    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reportes de Mantenimiento de Equipos',0,0,'C');
    // Salto de línea
    $this->SetFont('Arial','B',9);
    $this->Ln(20);
    $this->SetFillColor(19, 141, 117);
    $this->Cell(30,10,'Equipo', 1, 0, 'C', 1);
    $this->Cell(20,10,utf8_decode('Código'), 1, 0, 'C', 1);
    $this->Cell(20,10,'Modelo', 1, 0, 'C', 1);
    $this->Cell(35,10,utf8_decode('Descripción'), 1, 0, 'C', 1);
    $this->Cell(25,10,utf8_decode('Mantenimiento'), 1, 0, 'C', 1);
    $this->Cell(20,10,'CN', 1, 0, 'C', 1);
    $this->Cell(20,10,'Estado', 1, 0, 'C', 1);
    $this->Cell(20,10,'Fecha', 1, 1, 'C', 1);

}

// Pie de página
function Footer(){
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Número de página
    $this->Cell(0,10, utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

require '../conexion.php';
$fecha =  $_GET['fecha'];
$fecha2 =  $_GET['fecha2'];

$query = mysqli_query($conn, "SELECT equipo.equipo, equipo.codigo, equipo.modelo,centronegocio.centronegocio, centronegocio.estadocn, mantenimiento.fechamantenimiento, mantenimiento.descripcion, mantenimiento.mantenimiento FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.equipo_idequipo = equipo.idequipo
INNER JOIN centronegocio
ON equipo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
WHERE fechamantenimiento BETWEEN '$fecha%' AND '$fecha2%' ORDER BY idcentronegocio");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

while($row = $query->fetch_assoc()){
    $pdf->Cell(30,8, $row['equipo'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['codigo'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['modelo'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['descripcion'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['mantenimiento'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['centronegocio'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['estadocn'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['fechamantenimiento'], 1, 1, 'C', 0);
}


$pdf->Output();
?>