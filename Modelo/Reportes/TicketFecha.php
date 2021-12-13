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
    $this->Cell(70,10,'Reportes de Tickets en Hechos',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->SetFillColor(19, 141, 117);
    $this->Cell(55,10,'Ticket', 1, 0, 'C', 1);
    $this->Cell(25,10,'Fecha', 1, 0, 'C', 1);
    $this->Cell(25,10,'Estado', 1, 0, 'C', 1);
    $this->Cell(30,10,'Nombre', 1, 0, 'C', 1);
    $this->Cell(30,10,'Apellido Pat', 1, 0, 'C', 1);
    $this->Cell(30,10,'Apellido Mat', 1, 1, 'C', 1);

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

$query = mysqli_query($conn, "SELECT ticket.ticket,ticket.fechaticket,estadoticket, usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM ticket
INNER JOIN usuario
ON ticket.usuario_idusuario = usuario.idusuario
INNER JOIN estadoticket
ON ticket.estadoticket_idestadoticket = estadoticket.idestadoticket
WHERE fechaticket BETWEEN '$fecha%' AND '$fecha2%'");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row = $query->fetch_assoc()){
    $pdf->Cell(55,8, $row['ticket'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['fechaticket'], 1, 0, 'C', 0);
    $pdf->Cell(25,8, $row['estadoticket'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['apellidopa'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['apellidoma'], 1, 1, 'C', 0);
}


$pdf->Output();
?>