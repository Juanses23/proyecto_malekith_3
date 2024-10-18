<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../agregar/conexion.php';

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('logo.jpg', 260, 15, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(80); // Movernos a la derecha
      $this->SetTextColor(15, 180, 96); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('MALEKITH'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(80);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : Nos ubicamos en la calle 22"), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(80);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : +57 123 456 7890"), 0, 0, '', 0);
      $this->Ln(5);

      /* COREEO */
      $this->Cell(80);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Correo : malekith@masas.com "), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(80);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Sucursal : Maxiaseo"), 0, 0, '', 0);
      $this->Ln(10);

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(15, 180, 96);
      $this->Cell(90); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE USUARIOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(15, 180, 96); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(15, 180, 96); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(30, 10, 'N', 1, 0, 'C', 1);
      $this->Cell(40, 10, 'Nombre', 1, 0, 'C', 1);
      $this->Cell(40, 10, 'Apellido', 1, 0, 'C', 1);
      $this->Cell(40, 10, 'Cedula', 1, 0, 'C', 1);
      $this->Cell(85, 10, 'Email', 1, 0, 'C', 1);
      $this->Cell(40, 10, 'Telefono', 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

include '../../agregar/conexion.php';
$consulta_reporte = $conexion->query("SELECT nombre, apellido, cedula, email, telefono FROM Usuario");

$i = 1;
while ($row = $consulta_reporte->fetch_assoc()) {
   $pdf->Cell(30, 10, $i, 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($row['apellido']), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($row['cedula']), 1, 0, 'C', 0);
   $pdf->Cell(85, 10, utf8_decode($row['email']), 1, 0, 'C', 0);
   $pdf->Cell(40, 10, utf8_decode($row['telefono']), 1, 1, 'C', 0);
   $i++;
}

$pdf->Output('Usuarios.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>
