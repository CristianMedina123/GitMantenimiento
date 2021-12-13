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
    $this->Cell(70,10,'Mantenimiento de Equipos por Fecha y CN',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFillColor(19, 141, 117);
    $this->Cell(55,10,'Equipo', 1, 0, 'C', 1);
    $this->Cell(25,10,utf8_decode('Código'), 1, 0, 'C', 1);
    $this->Cell(25,10,'Modelo', 1, 0, 'C', 1);
    $this->Cell(30,10,'CN', 1, 0, 'C', 1);
    $this->Cell(30,10,'Estado', 1, 0, 'C', 1);
    $this->Cell(30,10,'Fecha', 1, 1, 'C', 1);

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

$query = mysqli_query($conn, "SELECT equipo.equipo, equipo.codigo, equipo.modelo,centronegocio.centronegocio, centronegocio.estado, mantenimiento.fechamantenimiento FROM mantenimiento
INNER JOIN equipo
ON mantenimiento.equipo_idequipo = equipo.idequipo
INNER JOIN centronegocio
ON equipo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
WHERE fechamantenimiento BETWEEN '1/11/2021 08:55:52' AND '4/11/2021 13:07:20' AND idcentronegocio = 1 ORDER BY FechaMantenimiento DESC");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row = $query->fetch_assoc()){
    $pdf->Cell(55,8, $row['equipo'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['codigo'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['modelo'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['centronegocio'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['estado'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['fechamantenimiento'], 1, 1, 'C', 0);
}


$pdf->Output();
?>