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
    $this->Cell(70,10,'Asistencias por Fecha',0,0,'C');
    // Salto de línea
    $this->SetFont('Arial','B',9);
    $this->Ln(20);
    $this->SetFillColor(19, 141, 117);
    $this->Cell(30,10,'Fecha', 1, 0, 'C', 1);
    $this->Cell(30,10,'Hora', 1, 0, 'C', 1);
    $this->Cell(40,10,utf8_decode('CN'), 1, 0, 'C', 1);
    $this->Cell(40,10,'Nombre', 1, 0, 'C', 1);
    $this->Cell(40,10,'Apellido Pat', 1, 0, 'C', 1);
    $this->Cell(40,10,'Apellido Mat', 1, 1, 'C', 1);

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
$fecha = $_GET['fecha'];
$fecha2 = $_GET['fecha2'];

$query = mysqli_query($conn, "SELECT controltiempo.fechatiempo, controltiempo.horatiempo ,controltiempo.estadotiempo_idrstadotiempo, controltiempo.usuario_idusuario, controltiempo.centronegocio_idcentronegocio, centronegocio.centronegocio,usuario.nombre, usuario.apellidopa, usuario.apellidoma FROM controltiempo 
INNER JOIN centronegocio
ON controltiempo.centronegocio_idcentronegocio = centronegocio.idcentronegocio
INNER JOIN usuario
ON controltiempo.usuario_idusuario = usuario.idusuario
WHERE fechatiempo BETWEEN '$fecha%' AND '$fecha2%' ORDER BY controltiempo.fechatiempo DESC");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);

while($row = $query->fetch_assoc()){
    $pdf->Cell(30,8, $row['fechatiempo'], 1, 0, 'C', 0);
    $pdf->Cell(30,8, $row['horatiempo'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['centronegocio'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['apellidopa'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['apellidoma'], 1, 1, 'C', 0);

}


$pdf->Output();
?>