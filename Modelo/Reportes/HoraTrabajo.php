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
    $this->Cell(70,10,'Horas Trabajadas',0,0,'C');
    // Salto de línea
    $this->SetFont('Arial','B',9);
    $this->Ln(20);
    $this->SetFillColor(19, 141, 117);
    $this->Cell(15,10,'Id', 1, 0, 'C', 1);
    $this->Cell(20,10,'Nombre', 1, 0, 'C', 1);
    $this->Cell(25,10,'Ape Paterno', 1, 0, 'C', 1);
    $this->Cell(25,10,'Ape Materno', 1, 0, 'C', 1);
    $this->Cell(35,10,'CN', 1, 0, 'C', 1);
    $this->Cell(35,10,'Estado', 1, 0, 'C', 1);
    $this->Cell(35,10,'Horas Semanal', 1, 1, 'C', 1);


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
$fecha =  $_GET['fechaSabado'];
$fecha2 =  $_GET['fechaDomingo'];

$query = mysqli_query($conn, "SELECT usuario.idusuario, SEC_TO_TIME(SUM(TIME_TO_SEC(tiempoperiodo))) AS tiempo, usuario.nombre, usuario.apellidopa, usuario.apellidoma, centronegocio.centronegocio, centronegocio.estadocn
FROM periodo 
INNER JOIN usuario
ON periodo.idusuario = usuario.idusuario
INNER JOIN centronegocio
ON usuario.centronegocio_idcentronegocio = centronegocio.idcentronegocio
WHERE fecha1 BETWEEN '$fecha2' AND '$fecha' AND fecha2 BETWEEN '$fecha2' AND '$fecha' 
GROUP BY usuario.idusuario, usuario.nombre, usuario.apellidopa, usuario.apellidoma, centronegocio.centronegocio, centronegocio.estadocn");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

while($row = $query->fetch_assoc()){
    $pdf->Cell(15,8, $row['idusuario'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['apellidopa'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['apellidoma'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['centronegocio'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['estadocn'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['tiempo'], 1, 1, 'C', 0);
}


$pdf->Output();
?>