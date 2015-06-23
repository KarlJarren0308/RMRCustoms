<?php
    require('connection.php');
    require('tfpdf/tfpdf.php');
    require('pdf.php');

    $credit = 0;
    $debit = 0;
    $action = mysqli_real_escape_string($connection, $_GET['action']);

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AliasNbPages();
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);

    if($action == 'clientIncome') {
        $query = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $ctr = 1;

        $pdf->AddPage();
        $pdf->SetFillColor(225);

        while($row = mysqli_fetch_array($query)) {
            $queryIncome = mysqli_query($connection, "SELECT * FROM waybills WHERE Status='Active' AND Client_ID='$row[Client_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scanIncome = mysqli_num_rows($queryIncome);
            $credit = 0;
            $debit = 0;

            if($row['First_Name'] != 'Not Available' && $row['Middle_Name'] != 'Not Available' && $row['Last_Name'] != 'Not Available') {
                if(strlen($row['Middle_Name']) > 1) {
                    $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
                } else {
                    $name = $row['First_Name'] . ' ' . $row['Last_Name'];
                }
            } else {
                $name = $row['Company_Name'];
            }

            while($rowIncome = mysqli_fetch_array($queryIncome)) {
                $credit += (double) $rowIncome['Credit'];
                $debit += (double) $rowIncome['Debit'];
            }

            if($ctr % 2 == 0) {
                $pdf->Cell(76, 8, $name, 1, 0, 'C', true);
                $pdf->Cell(40, 8, '₱ ' . number_format($credit, 2, '.', ','), 1, 0, 'C', true);
                $pdf->Cell(40, 8, '₱ ' . number_format($debit, 2, '.', ','), 1, 0, 'C', true);
                $pdf->Cell(40, 8, $scanIncome, 1, 0, 'C', true);
                $pdf->Ln();
            } else {
                $pdf->Cell(76, 8, $name, 1, 0, 'C');
                $pdf->Cell(40, 8, '₱ ' . number_format($credit, 2, '.', ','), 1, 0, 'C');
                $pdf->Cell(40, 8, '₱ ' . number_format($debit, 2, '.', ','), 1, 0, 'C');
                $pdf->Cell(40, 8, $scanIncome, 1, 0, 'C');
                $pdf->Ln();
            }

            $ctr++;
        }

        $pdf->Output();
    } else if($action == 'totalMonthlyIncome') {
        $datetime = date('Y-m');
        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Transaction_Date LIKE '$datetime%'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $flag = false;
        $ctr = 31;
        $imagefile = '';

        while($flag == false) {
            if(file_exists('../assets/img/graph_report[' . date('Y-m') . '-' . $ctr . '].png')) {
                $imagefile = 'graph_report[' . date('Y-m') . '-' . $ctr . '].png';
                $flag = true;
            } else {
                $ctr--;
            }
        }

        $pdf->AddCustomPage();
        $pdf->SetFont('DejaVu', '', 20);
        $pdf->SetTextColor(25, 40, 35);
        $pdf->Cell(0, 8, 'RMR Customs Brokerage Corporation', 0, 0, 'L');
        $pdf->Ln();
        $pdf->SetFont('DejaVu', '', 10);
        $pdf->Cell(0, 5, 'Income per Client Report', 0, 0, 'L');
        $pdf->Ln(20);

        $pdf->Image('../assets/img/' . $imagefile);
        $pdf->SetFont('DejaVu', '', 8);
        $pdf->Cell(196, 8, 'Total Credit and Debit for the month of ' . date('F'), 0, 0, 'C');
        $pdf->Ln(20);

        $pdf->SetFont('DejaVu', '', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(98, 8, 'Total Credit', 1, 0, 'C', true);
        $pdf->Cell(98, 8, 'Total Debit', 1, 0, 'C', true);
        $pdf->Ln();
        $txt = file_get_contents('tfpdf/symbol.txt');
        $pdf->SetFont('DejaVu', '', 8);
        $pdf->SetTextColor(25, 40, 35);

        while($row = mysqli_fetch_array($query)) {
            $credit += $row['Credit'];
            $debit += $row['Debit'];
        }

        $pdf->Cell(98, 8, '₱ ' . number_format($credit, 2, '.', ','), 1, 0, 'C');
        $pdf->Cell(98, 8, '₱ ' . number_format($debit, 2, '.', ','), 1, 0, 'C');

        $pdf->Output();
    }

    mysqli_close($connection);
?>