<?php
// ¡IMPORTANTE! Este script requiere la librería FPDF.
// 1. Descarga FPDF desde fpdf.org
// 2. Crea una carpeta 'fpdf' en tu proyecto
// 3. Descomenta el código de abajo y borra la simulación

// require('fpdf/fpdf.php'); // <-- Apunta a esta librería
require 'db_config.php';

// (Aquí iría la lógica de FPDF para crear el PDF)
// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial','B',16);
// $pdf->Cell(40,10,'Factura River Garden');
// ... (añadir datos de la factura consultando la BD) ...
// $pdf->Output(); // Esto genera el PDF

// --- Simulación si no tienes FPDF ---
$id_factura = (int)$_GET["id_factura"];
header('Content-Type: text/plain');
echo "SIMULACIÓN DE FACTURA PDF\n\n";
echo "Este archivo sería un PDF generado con la librería FPDF.\n";
echo "Descarga FPDF desde fpdf.org para generarlo.\n\n";
echo "ID de Factura: $id_factura\n";
echo "--- FIN DE SIMULACIÓN ---";
?>