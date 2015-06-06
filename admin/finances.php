<?php
    require('requests/connection.php');
    require('requests/settings.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(!isset($_SESSION['rmr_username'])) {
        header('Location: ./');
    }

    if(isset($_GET['page']) && $_GET['page'] > 0) {
        $page = $_GET['page'];
    } else {
        echo '<script>window.location = "?page=1";</script>';
    }

    $systemSettings = new RMRSettings($_SESSION['rmr_username']);
    echo $systemSettings->displayParticles();
?>

<div class="container-fluid">
    <div class="col-lg-3 col-md-3 fixed-position">
        <div class="list-group round-corner shadow">
            <a href="clients.php" class="list-group-item" data-log="Clients Module" data-toggle="popover" title="Clients" data-content="Displays all client information. This module also allows you to add, edit, or delete client information."><h4 class="no-margin">Clients</h4></a>
            <a href="companies.php" class="list-group-item" data-log="Companies Module" data-toggle="popover" title="Companies" data-content="Displays all company information. This module also allows you to add, edit, or delete company information."><h4 class="no-margin">Companies</h4></a>
            <a href="ladings.php" class="list-group-item" data-log="Bill of Lading Module" data-toggle="popover" title="Bill of Lading" data-content="Displays all bill of lading made. This module also allows you to create new bill of lading."><h4 class="no-margin">Bill of Lading</h4></a>
            <a href="transactions.php" class="list-group-item" data-log="Transactions Module" data-toggle="popover" title="Transactions" data-content="Displays all active and inactive transactions made. This module also allows you to create new transactions."><h4 class="no-margin">Transactions</h4></a>
            <a href="trucks.php" class="list-group-item" data-log="Trucks Module" data-toggle="popover" title="Trucks" data-content="Displays information about the trucks."><h4 class="no-margin">Trucks</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator' || $_SESSION['rmr_type'] == 'President') {
                    echo '<a href="finances.php" class="list-group-item active-dark" data-toggle="popover" title="Finances" data-content="Tracks all credits and debits of the company."><h4 class="no-margin">Finances</h4></a>';
                }
            ?>
            <a href="gps.php" class="list-group-item" data-log="Global Positioning System Module" data-toggle="popover" title="Global Positioning System" data-content="Tracks all GPS-equipped trucks."><h4 class="no-margin">Global Positioning System</h4></a>
            <a href="users.php" class="list-group-item" data-log="Users Module" data-toggle="popover" title="Users" data-content="Manage users. This module allows you to add, edit or delete users. You may also set/unset modules he/she should/shouldn't use."><h4 class="no-margin">Users</h4></a>
            <?php
                if($_SESSION['rmr_type'] == 'Administrator') {
                    echo '<a href="charges.php" class="list-group-item" data-log="Company Fix Rate Charges Module" data-toggle="popover" title="Company Fix Rate Charges" data-content="This module allows you to modify values of different charges."><h4 class="no-margin">Company Fix Rate Charges</h4></a>';
                }
            ?>
        </div>
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-9 col-md-offset-3 fg-white auto-next-line">
        <div class="col-lg-12 col-md-12 text-center">
            <div class="navbar navbar-inverse navbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="javascript:void(0);" class="navbar-brand">Income per Client</a>
                    </div>
                    <div class="navbar-right">
                        <a id="generate-client-income-report-button" class="btn btn-primary navbar-btn" href="requests/generate_finance_report.php?action=clientIncome">Generate Report</a>
                        &nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
            <div class="text-left col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                <div>
                    <ul class="pagination pagination-sm">
                        <?php
                            $query = mysqli_query($connection, "SELECT * FROM clients") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                            if($query) {
                                $scan = mysqli_num_rows($query);
                                $pages = ceil($scan / 10);

                                for($ctr = 1; $ctr <= $pages; $ctr++) {
                                    $marker = $page == $ctr ? ' class="active-dark"' : '';
                                    echo '<li' . $marker . '><a href="?page=' . $ctr . '">' . $ctr . '</a></li>';
                                }
                            }
                        ?>
                    </ul>
                </div>
                <canvas id="client-income-chart" class="center-block" height="400" width="740"></canvas>
                <br>
                <div style="font-size: 20px;">Legend:</div>
                <div style="font-size: 15px;">
                    <div class="colored-box" style="background-color: rgba(57, 117, 189, 0.75); border: 2px solid rgba(7, 67, 139, 0.75);"></div> Total Credit
                    &nbsp;&nbsp;&nbsp;
                    <div class="colored-box" style="background-color: rgba(195, 57, 55, 0.75); border: 2px solid rgba(145, 7, 5, 0.75);"></div> Total Debit
                </div>
                <br>
                <div>
                    <table id="client-income-table" class="table table-hover table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th width="50%">Client Name</th>
                                <th>Total Credit</th>
                                <th>Total Debit</th>
                            </tr>
                        </thead>
                        <tbody class="fg-dark">
                            <?php
                                $offset = ($page * 10) - 10;
                                $queryClient = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID LIMIT $offset, 10") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                                while($rowClient = mysqli_fetch_array($queryClient)) {
                                    $query = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$rowClient[Client_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                                    $scan = mysqli_num_rows($query);
                                    $first = true;

                                    if($rowClient['First_Name'] == 'Not Available' && $rowClient['Middle_Name'] == 'Not Available' && $rowClient['Last_Name'] == 'Not Available') {
                                        $name = $rowClient['Company_Name'];
                                    } else {
                                        if(strlen($rowClient['Middle_Name']) > 1) {
                                            $name = $rowClient['First_Name'] . ' ' . substr($rowClient['Middle_Name'], 0, 1) . '. ' . $rowClient['Last_Name'];
                                        } else {
                                            $name = $rowClient['First_Name'] . ' ' . $rowClient['Last_Name'];
                                        }
                                    }

                                    if($scan > 0) {
                                        while($row = mysqli_fetch_array($query)) {
                                            if($first) {
                                                $credit = (double) $row['Credit'];
                                                $debit = (double) $row['Debit'];
                                                $first = false;
                                            } else {
                                                $credit += (double) $row['Credit'];
                                                $debit += (double) $row['Debit'];
                                            }
                                        }
                                    } else {
                                        $credit = 0;
                                        $debit = 0;
                                    }

                                    echo '<tr>';
                                    echo '<td>' . $name . '</td>';
                                    echo '<td>&#8369; ' . $credit . '</td>';
                                    echo '<td>&#8369; ' . $debit . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 text-center with-padding-top-3">
            <div class="navbar navbar-inverse navbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="javascript:void(0);" class="navbar-brand">Total Income for the Month of <?php echo date('F'); ?></a>
                    </div>
                    <div class="navbar-right">
                        <a id="generate-total-monthly-income-report-button" class="btn btn-primary navbar-btn" href="requests/generate_finance_report.php?action=totalMonthlyIncome">Generate Report</a>
                        &nbsp;&nbsp;&nbsp;
                    </div>
                </div>
            </div>
            <div class="text-left col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                <canvas id="total-monthly-income-chart" class="center-block" height="250" width="740"></canvas>
                <br>
                <div>Legend:</div>
                <div>
                    <div class="colored-box" style="background-color: rgba(57, 117, 189, 0.75); border: 2px solid rgba(7, 67, 139, 0.75);"></div> Credit
                    &nbsp;&nbsp;&nbsp;
                    <div class="colored-box" style="background-color: rgba(195, 57, 55, 0.75); border: 2px solid rgba(145, 7, 5, 0.75);"></div> Debit
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark top-corners-round">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove fg-white"></span></button>
                <div class="modal-title"></div>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<div id="prompt" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark top-corners-round">
                <div class="modal-title"></div>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<script>
    clientIncomeChart(<?php echo $page; ?>);
    totalMonthlyIncomeChart();
</script>

<?php
    mysqli_close($connection);

    include_once('assets/system/footer.php');
?>