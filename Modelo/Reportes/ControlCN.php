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
    $this->Cell(70,10,'Asistencias por CN',0,0,'C');
    // Salto de línea
    $this->SetFont('Arial','B',9);
    $this->Ln(20);
    $this->Cell(30,10,'Fecha', 1, 0, 'C', 0);
    $this->Cell(30,10,utf8_decode('Motivo'), 1, 0, 'C', 0);
    $this->Cell(35,10,'Nombre', 1, 0, 'C', 0);
    $this->Cell(30,10,'Apellido Pat', 1, 0, 'C', 0);
    $this->Cell(30,10,'Apellido Mat', 1, 0, 'C', 0);
    $this->Cell(35,10,'CN', 1, 1, 'C', 0);


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
$centro =  $_GET['centro'];

$query = mysqli_query($conn, "SELECT controltiempo.Fecha, controltiempo.EstadoTiempo_IdEstadoTiempo, estadotiempo.Estado,controltiempo.Usuario_IdUsuario, controltiempo.CentroNegocio_IdCentroNegocio, centronegocio.CentroNegocio,usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat FROM controltiempo  
INNER JOIN usuario
ON controltiempo.Usuario_IdUsuario = usuario.IdUsuario
INNER JOIN centronegocio
ON controltiempo.CentroNegocio_IdCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN estadotiempo
ON controltiempo.EstadoTiempo_IdEstadoTiempo = estadotiempo.IdEstadoTiempo
WHERE IdCentroNegocio = $centro ORDER BY controltiempo.Fecha DESC");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

while($row = $query->fetch_assoc()){
    $pdf->Cell(30,8, $row['Fecha'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['Estado'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['Nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['ApellidoPat'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['ApellidoMat'], 1, 0, 'C', 0);
    $pdf->Cell(35,8, $row['CentroNegocio'], 1, 1, 'C', 0);



}


$pdf->Output();
?>