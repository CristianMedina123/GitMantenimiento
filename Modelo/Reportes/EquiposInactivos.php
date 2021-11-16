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
    $this->Cell(70,10,'Equipos Inactivos',0,0,'C');
    // Salto de línea
    $this->SetFont('Arial','B',9);
    $this->Ln(20);
    $this->Cell(30,10,'Equipo', 1, 0, 'C', 0);
    $this->Cell(20,10,utf8_decode('Código'), 1, 0, 'C', 0);
    $this->Cell(25,10,'Modelo', 1, 0, 'C', 0);
    $this->Cell(30,10,'CN', 1, 0, 'C', 0);
    $this->Cell(30,10,'Estado', 1, 0, 'C', 0);
    $this->Cell(25,10,'Fecha', 1, 0, 'C', 0);
    $this->Cell(30,10,'Estatus', 1, 1, 'C', 0);

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
// $usuario =  mysqli_real_escape_string($conn, utf8_decode($_POST['id']));

$query = mysqli_query($conn, "SELECT equipo.Equipo, equipo.Codigo, equipo.Modelo,centronegocio.CentroNegocio, centronegocio.Estado, mantenimiento.FechaMantenimiento, tipoestado.TipoEstado FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.Equipo_idEquipo = equipo.IdEquipo
INNER JOIN centronegocio
ON equipo.CentroNegocio_idCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN tipoestado
ON equipo.TipoEstado_IdTipoEstado = tipoestado.IdTipoEstado
WHERE IdTipoEstado = 2 ORDER BY IdCentroNegocio DESC");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

while($row = $query->fetch_assoc()){
    $pdf->Cell(30,8, $row['Equipo'], 1, 0, 'C', 0);
    $pdf->Cell(20,8, $row['Codigo'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['Modelo'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['CentroNegocio'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['Estado'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['FechaMantenimiento'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['TipoEstado'], 1, 1, 'C', 0);
}


$pdf->Output();
?>