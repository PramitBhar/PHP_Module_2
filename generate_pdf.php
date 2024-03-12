<?php

require_once 'vendor/autoload.php';
include 'User.php';
use Fpdf\Fpdf;
if($_SERVER["REQUEST_METHOD"]=="POST") {
  $first_name = $_POST["fname"];
  $last_name = $_POST["lname"];
  $email = "pramitbhar26@gmail.com";
  $phone_number = "+91 8961310487";
  $subject_name_marks = $_POST["subject_name_and_marks_input"];
  $user = User($first_name, $last_name,$subject_name_marks);
  $marks_final = $user->pdfTableGenerator();
  $pdf = new Fpdf();
  $pdf->AddPage();

  $pdf->Rect(5,5,200,287);
  $pdf->SetFont('Arial','B', 36);
  $pdf->Cell(190, 36, "REPORT", 0, 1, 'C');

  // Display form data in the PDF
  $pdf->SetFont('Arial','B', 16);
  $pdf->Cell(40, 20, "Full-Name: ", 0, 0, 'L');
  $pdf->SetFont('Arial','', 16);
  $pdf->Cell(80, 20,$first_name, 0, 1, 'L');

  $pdf->SetFont('Arial','B', 16);
  $pdf->Cell(40, 20, "Email: ", 0, 0, 'L');
  $pdf->SetFont('Arial','', 16);
  $pdf->Cell(80, 20, $email, 0, 1, 'L');

  $pdf->SetFont('Arial','B', 16);
  $pdf->Cell(40, 20, "Phone No: ", 0, 0, 'L');
  $pdf->SetFont('Arial','', 16);
  $pdf->Cell(80, 20, $phone_number, 0, 1, 'L');

  $pdf->Image($image_validation, 150, 50, 50, 50);
  foreach ($marks_final as $x) {
    $pdf->Cell(95,10,$x[0],1,0,'C');
    $pdf->Cell(95,10,$x[1],1,1,'C');
  }
  // Output PDF to browser.
  $pdf->Output('D', 'report.pdf');
  //Store pdf in the server.
  $pdf->Output('F','.report.pdf');
}
?>

