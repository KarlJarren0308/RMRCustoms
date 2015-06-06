<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'View') {
        $clientId = mysqli_real_escape_string($connection, $_POST['clientId']);
        $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
        $middleName = mysqli_real_escape_string($connection, $_POST['middleName']);
        $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);

        $query = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Client_ID='$clientId' AND clients.First_Name='$firstName' AND clients.Middle_Name='$middleName' AND clients.Last_Name='$lastName'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            if(strlen($row['Middle_Name']) > 1) {
                $clientName = $row['First_Name'] . ' ' . $row['Middle_Name'] . ' ' . $row['Last_Name'];
            } else {
                $clientName = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';
            
            if($row['First_Name'] != 'Not Available' && $row['Middle_Name'] != 'Not Available' && $row['Last_Name'] != 'Not Available') {
                echo '<tr>';
                echo '<td width="30%" align="right">Client Name:</td>';
                echo '<td>' . $clientName . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Client Address:</td>';
                echo '<td>' . $row['Address'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Client E-mail Address:</td>';
                echo '<td>' . $row['Email_Address'] . '</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td width="30%" align="right">Company Name:</td>';
            echo '<td>' . $row['Company_Name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Company Address:</td>';
            echo '<td>' . $row['Company_Address'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Company Contact Number:</td>';
            echo '<td>' . $row['Company_Contact_Number'] . '</td>';
            echo '</tr>';
            echo '<tr>';

            if($row['First_Name'] == 'Not Available' && $row['Middle_Name'] == 'Not Available' && $row['Last_Name'] == 'Not Available') {
                echo '<td align="right">Company Head Office Address:</td>';
                echo '<td>' . $row['Company_Head_Office_Address'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Company Email Address:</td>';
                echo '<td>' . $row['Company_Email_Address'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Zip Code:</td>';
                echo '<td>' . $row['Zip_Code'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact:</td>';
                echo '<td>' . $row['Primary_Contact'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Company Position:</td>';
                echo '<td>' . $row['Primary_Contact_Company_Position'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Email:</td>';
                echo '<td>' . $row['Primary_Contact_Email'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Phone Number:</td>';
                echo '<td>' . $row['Primary_Contact_Phone_Number'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Main Business Activities:</td>';
                echo '<td>' . $row['Main_Business_Activities'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Country:</td>';
                echo '<td>' . $row['Country'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Corporate Currency:</td>';
                echo '<td>' . $row['Corporate_Currency'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Default Language:</td>';
                echo '<td>' . $row['Default_Language'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Default Time Zone:</td>';
                echo '<td>' . $row['Default_Time_Zone'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Fax:</td>';
                echo '<td>' . $row['Fax'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Phone Number:</td>';
                echo '<td>' . $row['Phone_Number'] . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Established:</td>';
                echo '<td>' . $row['Established'] . '</td>';
                echo '</tr>';
            }

            echo '<td align="right">Added By:</td>';

            $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$row[Added_By]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                $rowAccount = mysqli_fetch_array($query);

                if(strlen($rowAccount['Middle_Name']) > 1) {
                    $addedBy = $rowAccount['First_Name'] . ' ' . substr($rowAccount['Middle_Name'], 0, 1) . '. ' . $rowAccount['Last_Name'];
                } else {
                    $addedBy = $rowAccount['First_Name'] . ' ' . $rowAccount['Last_Name'];
                }
            }

            echo '<td>' . $addedBy . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Date Added:</td>';
            echo '<td>';
            echo $row['Date_Added'] == '0000-00-00' ? '' : date('F d, Y', strtotime($row['Date_Added']));
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Updated By:</td>';

            $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$row[Updated_By]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                $rowAccount = mysqli_fetch_array($query);

                if(strlen($rowAccount['Middle_Name']) > 1) {
                    $updatedBy = $rowAccount['First_Name'] . ' ' . substr($rowAccount['Middle_Name'], 0, 1) . '. ' . $rowAccount['Last_Name'];
                } else {
                    $updatedBy = $rowAccount['First_Name'] . ' ' . $rowAccount['Last_Name'];
                }
            }

            echo '<td>' . $updatedBy . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Date Updated:</td>';
            echo '<td>';
            echo $row['Date_Updated'] == '0000-00-00' ? '' : date('F d, Y', strtotime($row['Date_Updated']));
            echo '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '<div class="well">';
            echo '<h3 class="no-margin">Transaction History</h3><br>';
            echo '<table class="table table-hover table-striped">';
            echo '<thead class="bg-dark">';
            echo '<tr>';
            echo '<th>Waybill</th>';
            echo '<th>Date of Transaction</th>';
            echo '<th>Delivery Status</th>';
            echo '<th>Credit</th>';
            echo '<th>Debit</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            $totalCredit = 0;
            $totalDebit = 0;
            $queryHistory = mysqli_query($connection, "SELECT * FROM waybills WHERE Client_ID='$clientId' AND Status='Active'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            while($rowHistory = mysqli_fetch_array($queryHistory)) {
                $totalCredit += (double) $rowHistory['Credit'];
                $totalDebit += (double) $rowHistory['Debit'];

                echo '<tr>';
                echo '<td>' . $rowHistory['Waybill_Number'] . '</td>';
                echo '<td>' . $rowHistory['Transaction_Date'] . '</td>';
                echo '<td>' . $rowHistory['Delivery_Status'] . '</td>';
                echo '<td>&#8369; ' . $rowHistory['Credit'] . '</td>';
                echo '<td>&#8369; ' . $rowHistory['Debit'] . '</td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td colspan="3" align="right"><strong>Total:</strong></td>';
            echo '<td>&#8369; ' . $totalCredit . '</td>';
            echo '<td>&#8369; ' . $totalDebit . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        }
    } else if($action == 'Edit') {
        $clientId = mysqli_real_escape_string($connection, $_POST['clientId']);
        $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
        $middleName = mysqli_real_escape_string($connection, $_POST['middleName']);
        $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);

        $query = mysqli_query($connection, "SELECT * FROM clients LEFT JOIN companies ON clients.Company_ID=companies.Company_ID WHERE clients.Client_ID='$clientId' AND clients.First_Name='$firstName' AND clients.Middle_Name='$middleName' AND clients.Last_Name='$lastName'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';

            if($row['First_Name'] != 'Not Available' && $row['Middle_Name'] != 'Not Available' && $row['Last_Name'] != 'Not Available') {
                echo '<tr>';
                echo '<td width="30%" align="right">Client Name:</td>';
                echo '<td><div class="col-lg-4 col-md-4 form-group"><span>First Name:</span><input id="edit-client-firstname" type="text" class="form-control" value="' . $row['First_Name'] . '" placeholder="First Name"></div><div class="col-lg-4 col-md-4 form-group"><span>Middle Name:</span><input id="edit-client-middlename" type="text" class="form-control" value="' . $row['Middle_Name'] . '" placeholder="Middle Name"></div><div class="col-lg-4 col-md-4 form-group"><span>Last Name:</span><input id="edit-client-lastname" type="text" class="form-control" value="' . $row['Last_Name'] . '" placeholder="Last Name"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Client Address:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-client-address" type="text" class="form-control" value="' . $row['Address'] . '" placeholder="Address"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Client E-mail Address:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-client-email-address" type="text" class="form-control" value="' . $row['Email_Address'] . '" placeholder="E-mail Address"></div></td>';
                echo '</tr>';
            } else {
                echo '<input type="hidden" id="edit-client-firstname" value="Not Available">';
                echo '<input type="hidden" id="edit-client-middlename" value="Not Available">';
                echo '<input type="hidden" id="edit-client-lastname" value="Not Available">';
                echo '<div id="edit-client-address"></div>';
            }

            echo '<tr>';
            echo '<td width="30%" align="right">Company Name:</td>';
            echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-company-name" type="text" class="form-control" value="' . $row['Company_Name'] . '" placeholder="Company Name"></div></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Company Address:</td>';
            echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-company-address" type="text" class="form-control" value="' . $row['Company_Address'] . '" placeholder="Company Address"></div></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Company Contact Number:</td>';
            echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-company-contact-number" type="text" class="form-control" value="' . $row['Company_Contact_Number'] . '" placeholder="Company Contact Number"></div></td>';
            echo '</tr>';
            
            if($row['First_Name'] == 'Not Available' && $row['Middle_Name'] == 'Not Available' && $row['Last_Name'] == 'Not Available') {
                echo '<tr>';
                echo '<td align="right">Company Head Office Address:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-company-head-office-address" type="text" class="form-control" value="' . $row['Company_Head_Office_Address'] . '" placeholder="Company Head Office Address"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Company Email Address:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-company-email-address" type="text" class="form-control" value="' . $row['Company_Email_Address'] . '" placeholder="Company Email Address"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Zip Code:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-zip-code" type="text" class="form-control" value="' . $row['Zip_Code'] . '" placeholder="Zip Code"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-primary-contact" type="text" class="form-control" value="' . $row['Primary_Contact'] . '" placeholder="Primary Contact"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Company Position:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-primary-contact-company-position" type="text" class="form-control" value="' . $row['Primary_Contact_Company_Position'] . '" placeholder="Primary Contact Company Position"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Email:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-primary-contact-email" type="text" class="form-control" value="' . $row['Primary_Contact_Email'] . '" placeholder="Primary Contact Email"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Primary Contact Phone Number:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-primary-contact-phone-number" type="text" class="form-control" value="' . $row['Primary_Contact_Phone_Number'] . '" placeholder="Primary Contact Phone Number"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Main Business Activities:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-main-business-activities" type="text" class="form-control" value="' . $row['Main_Business_Activities'] . '" placeholder="Main Business Activities"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Country:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-country" type="text" class="form-control" value="' . $row['Country'] . '" placeholder="Country"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Corporate Currency:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-corporate-currency" type="text" class="form-control" value="' . $row['Corporate_Currency'] . '" placeholder="Corporate Currency"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Default Language:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-default-language" type="text" class="form-control" value="' . $row['Default_Language'] . '" placeholder="Default Language"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Default Time Zone:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-default-time-zone" type="text" class="form-control" value="' . $row['Default_Time_Zone'] . '" placeholder="Default Time Zone"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Fax:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-fax" type="text" class="form-control" value="' . $row['Fax'] . '" placeholder="Fax"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Phone Number:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-phonenumber" type="text" class="form-control" value="' . $row['Phone_Number'] . '" placeholder="Phone Number"></div></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Established:</td>';
                echo '<td><div class="col-lg-12 col-md-12 form-group"><input id="edit-established" type="text" class="form-control" value="' . $row['Established'] . '" placeholder="Established"></div></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '<div class="text-right"><button class="btn btn-success" data-prompt="Save">Save Changes</button></div>';
        }
    } else if($action == 'Delete') {
        $clientId = mysqli_real_escape_string($connection, $_POST['clientId']);
        $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
        $middleName = mysqli_real_escape_string($connection, $_POST['middleName']);
        $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);

        $query = mysqli_query($connection, "UPDATE clients SET Status='Inactive' WHERE Client_ID='$clientId' AND First_Name='$firstName' AND Middle_Name='$middleName' AND Last_Name='$lastName'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            echo 'Client successfully deleted.';
        } else {
            echo 'Failed to delete client.';
        }
    } else if($action == 'Save') {
        $clientId = isset($_POST['clientId']) ? mysqli_real_escape_string($connection, $_POST['clientId']) : '';
        $companyId = isset($_POST['companyId']) ? mysqli_real_escape_string($connection, $_POST['companyId']) : '';
        $firstName = isset($_POST['firstName']) ? mysqli_real_escape_string($connection, $_POST['firstName']) : '';
        $middleName = isset($_POST['middleName']) ? mysqli_real_escape_string($connection, $_POST['middleName']) : '';
        $lastName = isset($_POST['lastName']) ? mysqli_real_escape_string($connection, $_POST['lastName']) : '';
        $address = isset($_POST['address']) ? mysqli_real_escape_string($connection, $_POST['address']) : '';
        $emailAddress = isset($_POST['emailAddress']) ? mysqli_real_escape_string($connection, $_POST['emailAddress']) : '';
        $companyName = isset($_POST['companyName']) ? mysqli_real_escape_string($connection, $_POST['companyName']) : '';
        $companyAddress = isset($_POST['companyAddress']) ? mysqli_real_escape_string($connection, $_POST['companyAddress']) : '';
        $companyContactNumber = isset($_POST['companyContactNumber']) ? mysqli_real_escape_string($connection, $_POST['companyContactNumber']) : '';
        $companyHeadOfficeAddress = isset($_POST['companyHeadOfficeAddress']) ? mysqli_real_escape_string($connection, $_POST['companyHeadOfficeAddress']) : '';
        $companyEmailAddress = isset($_POST['companyEmailAddress']) ? mysqli_real_escape_string($connection, $_POST['companyEmailAddress']) : '';
        $zipCode = isset($_POST['zipCode']) ? mysqli_real_escape_string($connection, $_POST['zipCode']) : '';
        $primaryContact = isset($_POST['primaryContact']) ? mysqli_real_escape_string($connection, $_POST['primaryContact']) : '';
        $primaryContactCompanyPosition = isset($_POST['primaryContactCompanyPosition']) ? mysqli_real_escape_string($connection, $_POST['primaryContactCompanyPosition']) : '';
        $primaryContactEmail = isset($_POST['primaryContactEmail']) ? mysqli_real_escape_string($connection, $_POST['primaryContactEmail']) : '';
        $primaryContactPhoneNumber = isset($_POST['primaryContactPhoneNumber']) ? mysqli_real_escape_string($connection, $_POST['primaryContactPhoneNumber']) : '';
        $mainBusinessActivities = isset($_POST['mainBusinessActivities']) ? mysqli_real_escape_string($connection, $_POST['mainBusinessActivities']) : '';
        $country = isset($_POST['country']) ? mysqli_real_escape_string($connection, $_POST['country']) : '';
        $corporateCurrency = isset($_POST['corporateCurrency']) ? mysqli_real_escape_string($connection, $_POST['corporateCurrency']) : '';
        $defaultLanguage = isset($_POST['defaultLanguage']) ? mysqli_real_escape_string($connection, $_POST['defaultLanguage']) : '';
        $defaultTimeZone = isset($_POST['defaultTimeZone']) ? mysqli_real_escape_string($connection, $_POST['defaultTimeZone']) : '';
        $fax = isset($_POST['fax']) ? mysqli_real_escape_string($connection, $_POST['fax']) : '';
        $phoneNumber = isset($_POST['phoneNumber']) ? mysqli_real_escape_string($connection, $_POST['phoneNumber']) : '';
        $established = isset($_POST['established']) ? mysqli_real_escape_string($connection, $_POST['established']) : '';
        $datetime = date('Y-m-d');

        $query = @mysqli_query($connection, "UPDATE clients SET First_Name='$firstName', Middle_Name='$middleName', Last_Name='$lastName', Address='$address', Email_Address='$emailAddress', Updated_By='$username', Date_Updated='$datetime' WHERE Client_ID='$clientId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $query = @mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$companyName' AND Company_Address='$companyAddress' AND Company_Contact_Number='$companyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);

            if($scan == 0) {
                $query = @mysqli_query($connection, "INSERT INTO companies (Company_Name, Company_Address, Company_Contact_Number, Company_Head_Office_Address, Company_Email_Address, Zip_Code, Primary_Contact, Primary_Contact_Company_Position, Primary_Contact_Email, Primary_Contact_Phone_Number, Main_Business_Activities, Country, Corporate_Currency, Default_Language, Default_Time_Zone, Fax, Phone_Number, Established) VALUES ('$companyName', '$companyAddress', '$companyContactNumber', '$companyHeadOfficeAddress', '$companyEmailAddress', '$zipCode', '$primaryContact', '$primaryContactCompanyPosition', '$primaryContactEmail', '$primaryContactPhoneNumber', '$mainBusinessActivities', '$country', '$corporateCurrency', '$defaultLanguage', '$defaultTimeZone', '$fax', '$phoneNumber', '$established')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    $query = @mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$companyName' AND Company_Address='$companyAddress' AND Company_Contact_Number='$companyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    $scan = mysqli_num_rows($query);

                    if($scan == 1) {
                        $row = mysqli_fetch_array($query);

                        $query = @mysqli_query($connection, "UPDATE clients SET Company_ID='$row[Company_ID]' WHERE Client_ID='$clientId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                        if($query) {
                            echo 'Saved Changes';
                        } else {
                            echo 'Failed to save changes on company\' information.';
                        }
                    } else {
                        echo 'Unable to process information.';
                    }
                } else {
                    echo 'Unable to insert new information.';
                }
            } else {
                $row = mysqli_fetch_array($query);

                $query = @mysqli_query($connection, "UPDATE clients SET Company_ID='$row[Company_ID]' WHERE Client_ID='$clientId'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    $query = @mysqli_query($connection, "UPDATE companies SET Company_Name='$companyName', Company_Address='$companyAddress', Company_Contact_Number='$companyContactNumber', Company_Head_Office_Address='$companyHeadOfficeAddress', Company_Email_Address='$companyEmailAddress', Zip_Code='$zipCode', Primary_Contact='$primaryContact', Primary_Contact_Company_Position='$primaryContactCompanyPosition', Primary_Contact_Email='$primaryContactEmail', Primary_Contact_Phone_Number='$primaryContactPhoneNumber', Main_Business_Activities='$mainBusinessActivities', Country='$country', Corporate_Currency='$corporateCurrency', Default_Language='$defaultLanguage', Default_Time_Zone='$defaultTimeZone', Fax='$fax', Phone_Number='$phoneNumber', Established='$established' WHERE Company_ID='$row[Company_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                    if($query) {
                        echo 'Saved Changes';
                    } else {
                        echo 'Failed to save changes on company\' information.';
                    }
                } else {
                    echo 'Failed to save changes on client\'s information.';
                }
            }
        } else {
            echo 'Failed to save changes on client\'s information.';
        }
    } else if($action == 'Add') {
        $addClientFirstName = mysqli_real_escape_string($connection, $_POST['addClientFirstName']);
        $addClientMiddleName = mysqli_real_escape_string($connection, $_POST['addClientMiddleName']);
        $addClientLastName = mysqli_real_escape_string($connection, $_POST['addClientLastName']);
        $addClientAddress = mysqli_real_escape_string($connection, $_POST['addClientAddress']);
        $addClientEmail = mysqli_real_escape_string($connection, $_POST['addClientEmail']);
        $addCompanyName = mysqli_real_escape_string($connection, $_POST['addCompanyName']);
        $addCompanyAddress = mysqli_real_escape_string($connection, $_POST['addCompanyAddress']);
        $addCompanyContactNumber = mysqli_real_escape_string($connection, $_POST['addCompanyContactNumber']);
        $datetime = date('Y-m-d');

        $query = mysqli_query($connection, "SELECT * FROM clients WHERE (First_Name='$addClientFirstName' AND Middle_Name='$addClientMiddleName' AND Last_Name='$addClientLastName') OR (First_Name='$addClientFirstName' AND Last_Name='$addClientLastName')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 0) {
            $queryCompanies = mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$addCompanyName' AND Company_Address='$addCompanyAddress' AND Company_Contact_Number='$addCompanyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scanCompanies = mysqli_num_rows($query);
            
            if($scanCompanies == 0) {
                $query = mysqli_query($connection, "INSERT INTO companies (Company_Name, Company_Address, Company_Contact_Number) VALUES ('$addCompanyName', '$addCompanyAddress', '$addCompanyContactNumber')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    $queryCompanies = mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$addCompanyName' AND Company_Address='$addCompanyAddress' AND Company_Contact_Number='$addCompanyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                }
            }

            $rowCompanies = mysqli_fetch_array($queryCompanies);
            $query = mysqli_query($connection, "INSERT INTO clients (First_Name, Middle_Name, Last_Name, Address, Email_Address, Added_By, Date_Added) VALUES ('$addClientFirstName', '$addClientMiddleName', '$addClientLastName', '$addClientAddress', '$addClientEmail', '$username', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'You successfully added a client.';
            }
        } else {
            echo 'Client already exist.';
        }
    }

    mysqli_close($connection);
?>