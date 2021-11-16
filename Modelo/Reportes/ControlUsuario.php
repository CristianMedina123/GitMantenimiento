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
    $this->Cell(70,10,'Asistencias por Usuario',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->Cell(30,10,'Fecha', 1, 0, 'C', 0);
    $this->Cell(40,10,utf8_decode('CN'), 1, 0, 'C', 0);
    $this->Cell(40,10,'Nombre', 1, 0, 'C', 0);
    $this->Cell(40,10,'Apellido Pat', 1, 0, 'C', 0);
    $this->Cell(40,10,'Apellido Mat', 1, 1, 'C', 0);

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
$usuario = $_GET['usuario'];

$query = mysqli_query($conn, "SELECT controltiempo.Fecha, controltiempo.EstadoTiempo_IdEstadoTiempo, controltiempo.Usuario_IdUsuario, controltiempo.CentroNegocio_IdCentroNegocio, centronegocio.CentroNegocio,usuario.Nombre, usuario.ApellidoPat, usuario.ApellidoMat FROM controltiempo 
INNER JOIN centronegocio
ON controltiempo.CentroNegocio_IdCentroNegocio = centronegocio.IdCentroNegocio
INNER JOIN usuario
ON controltiempo.Usuario_IdUsuario = usuario.IdUsuario
WHERE usuario.IdUsuario = $usuario ORDER BY controltiempo.Fecha DESC");

// $pdf = new PDF('L','mm','A4');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row = $query->fetch_assoc()){
    $pdf->Cell(30,8, $row['Fecha'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['CentroNegocio'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['Nombre'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['ApellidoPat'], 1, 0, 'C', 0);
    $pdf->Cell(40,8, $row['ApellidoMat'], 1, 1, 'C', 0);

}


$pdf->Output();
?>