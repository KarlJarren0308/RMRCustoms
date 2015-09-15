 <?php
    require('connection.php');

    $action = mysqli_real_escape_string($connection, $_GET['action']);

    if($action == 'View Income per Client') {
        $page = mysqli_real_escape_string($connection, $_GET['page']);
        $offset = ($page * 10) - 10;
        $queryNames = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Status='Active' LIMIT $offset, 10") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $flag = true;

        echo '{"names": [';
        while($rowNames = mysqli_fetch_array($queryNames)) {
            if($rowNames['First_Name'] == 'Not Available' && $rowNames['Middle_Name'] == 'Not Available' && $rowNames['Last_Name'] == 'Not Available') {
                $name = $rowNames['Company_Name'];
            } else {
                if(strlen($rowNames['Middle_Name']) > 1) {
                    $name = $rowNames['First_Name'] . ' ' . substr($rowNames['Middle_Name'], 0, 1) . '. ' . $rowNames['Last_Name'];
                } else {
                    $name = $rowNames['First_Name'] . ' ' . $rowNames['Last_Name'];
                }
            }

            if($flag) {
                echo json_encode($name);
                $flag = false;
            } else {
                echo ', ' . json_encode($name);
            }
        }

        $queryCredit = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Status='Active' LIMIT $offset, 10") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $flag = true;

        echo '], "credits": [';
        while($rowCredit = mysqli_fetch_array($queryCredit)) {
            $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$rowCredit[Client_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);
            $first = true;

            if($flag) {
                $flag = false;
            } else {
                echo ', ';
            }

            if($scan > 0) {
                while($row = mysqli_fetch_array($query)) {
                    if($first) {
                        $credit = (double) $row['Credit'];
                        $first = false;
                    } else {
                        $credit += (double) $row['Credit'];
                    }
                }
            } else {
                $credit = 0;
            }

            echo json_encode($credit);
        }

        $queryDebit = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Status='Active' LIMIT $offset, 10") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $flag = true;

        echo '], "debits": [';
        while($rowDebit = mysqli_fetch_array($queryDebit)) {
            $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$rowDebit[Client_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);
            $first = true;

            if($flag) {
                $flag = false;
            } else {
                echo ', ';
            }

            if($scan > 0) {
                while($row = mysqli_fetch_array($query)) {
                    if($first) {
                        $debit = (double) $row['Debit'];
                        $first = false;
                    } else {
                        $debit += (double) $row['Debit'];
                    }
                }
            } else {
                $debit = 0;
            }

            echo json_encode($debit);
        }
        echo ']}';
    } else if($action == 'View Total Monthly Income') {
        $datetime = date('Y-m');
        $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Transaction_Date LIKE '$datetime%'") or die('Cannot connect to Database. Error: '. mysqli_error($connection));
        $totalCredits = 0;
        $totalDebits = 0;

        while($row = mysqli_fetch_array($query)) {
            $totalCredits += (double) $row['Credit'];
            $totalDebits += (double) $row['Debit'];
        }

        echo '{"total_credits": "' . json_encode($totalCredits) . '", "total_debits": "' . json_encode($totalDebits) . '"}';
    }

    mysqli_close($connection);
?>