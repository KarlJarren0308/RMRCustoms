<?php
    require('connection.php');
    require('fpdf/fpdf.php');
    require('pdf.php');

    $credit = 0;
    $debit = 0;
    $action = mysqli_real_escape_string($connection, $_GET['action']);

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();

    if($action == 'clientIncome') {
        $query = mysqli_query($connection, "SELECT * FROM clients") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $ctr = 1;

        $pdf->SetFillColor(25, 40, 35);
        $pdf->SetMargins(15, 15, 15); // Page Max Content Width: 186
        $pdf->SetFont('Helvetica', 'B', 20);
        $pdf->SetTextColor(25, 40, 35);
        $pdf->AddPage();
        $pdf->Cell(0, 10, 'RMR Customs Brokerage Corporation', 0, 0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Cell(0, 8, 'Income per Client Report', 0, 0, 'C');
        $pdf->Ln(20);
        $pdf->SetFont('Helvetica', 'B', 12);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(86, 10, 'Client Name', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Credit', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Debit', 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFont('Helvetica', '', 8);
        $pdf->SetTextColor(25, 40, 35);
        $pdf->SetFillColor(200);

        while($row = mysqli_fetch_array($query)) {
            $queryIncome = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$row[Client_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            while($rowIncome = mysqli_fetch_array($queryIncome)) {
                $credit += (double) $rowIncome['Credit'];
                $debit += (double) $rowIncome['Debit'];
            }

            if($ctr % 2 == 0) {
                $pdf->Cell(86, 8, $name, 1, 0, 'C', true);
                $pdf->Cell(50, 8, 'Php ' . number_format($credit), 1, 0, 'C', true);
                $pdf->Cell(50, 8, 'Php ' . number_format($debit), 1, 0, 'C', true);
                $pdf->Ln();
            } else {
                $pdf->Cell(86, 8, $name, 1, 0, 'C');
                $pdf->Cell(50, 8, 'Php ' . number_format($credit), 1, 0, 'C');
                $pdf->Cell(50, 8, 'Php ' . number_format($debit), 1, 0, 'C');
                $pdf->Ln();
            }

            $ctr++;
        }

        $pdf->Output();
    } else if($action == 'totalMonthlyIncome') {
        $datetime = date('Y-m');
        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Transaction_Date LIKE '$datetime%") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        while($row = mysqli_fetch_array($query)) {
            $credit += $row['Credit'];
            $debit += $row['Debit'];
        }
    }

    mysqli_close($connection);
?>