<?php
    require('connection.php');
    require('fpdf/fpdf.php');
    require('pdf2.php');

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();

    $pdf->AddCustomPage();
    $pdf->SetFont('Helvetica', 'B', 20);
    $pdf->SetTextColor(25, 40, 35);
    $pdf->Cell(0, 8, 'RMR Customs Brokerage Corporation', 0, 0, 'L');
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->Cell(0, 5, 'Delivery Report', 0, 0, 'L');
    $pdf->Ln(20);

    $pdf->SetFont('Helvetica', 'B', 10);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(30, 8, 'Waybill_Number', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Transaction Date', 1, 0, 'C', true);
    $pdf->Cell(56, 8, 'Client Name', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Delivery Status', 1, 0, 'C', true);
    $pdf->Cell(25, 8, 'Credit', 1, 0, 'C', true);
    $pdf->Cell(25, 8, 'Debit', 1, 0, 'C', true);
    $pdf->Ln();
    $pdf->SetFont('Helvetica', 'B', 8);
    $pdf->SetTextColor(25, 40, 35);

    $query = mysqli_query($connection, "SELECT * FROM waybills LEFT JOIN trucks ON waybills.Truck_ID=trucks.Truck_ID LEFT JOIN clients ON waybills.Client_ID=clients.Client_ID WHERE waybills.Status<>'Inactive'") or die('Failed to connect to Database. Error: ' . mysqli_error($connection));
    $scan = mysqli_num_rows($query);

    if($scan > 0) {
        while($row = mysqli_fetch_array($query)) {
            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            $pdf->Cell(30, 8, $row['Waybill_Number'], 1, 0, 'C');
            $pdf->Cell(30, 8, date('F d, Y', strtotime($row['Transaction_Date'])), 1, 0, 'C');
            $pdf->Cell(56, 8, $name, 1, 0, 'C');
            $pdf->Cell(30, 8, $row['Delivery_Status'], 1, 0, 'C');
            $pdf->Cell(25, 8, 'Php ' . $row['Credit'], 1, 0, 'C');
            $pdf->Cell(25, 8, 'Php ' . $row['Debit'], 1, 1, 'C');
        }
    } else {
    }

    $pdf->Output();
?>