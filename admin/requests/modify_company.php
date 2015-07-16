<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $datetime = date('Y-m-d');
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'Add') {
        $companyName = mysqli_real_escape_string($connection, $_POST['companyName']);
        $companyAddress = mysqli_real_escape_string($connection, $_POST['companyAddress']);
        $companyContactNumber = mysqli_real_escape_string($connection, $_POST['companyContactNumber']);
        $companyEmailAddress = mysqli_real_escape_string($connection, $_POST['companyEmailAddress']);
        $zipCode = mysqli_real_escape_string($connection, $_POST['zipCode']);
        $primaryContact = mysqli_real_escape_string($connection, $_POST['primaryContact']);
        $primaryContactCompanyPosition = mysqli_real_escape_string($connection, $_POST['primaryContactCompanyPosition']);
        $primaryContactEmail = mysqli_real_escape_string($connection, $_POST['primaryContactEmail']);
        $primaryContactPhoneNumber = mysqli_real_escape_string($connection, $_POST['primaryContactPhoneNumber']);
        $mainBusinessActivities = mysqli_real_escape_string($connection, $_POST['mainBusinessActivities']);
        $country = mysqli_real_escape_string($connection, $_POST['country']);
        $defaultTimeZone = mysqli_real_escape_string($connection, $_POST['defaultTimeZone']);
        $fax = mysqli_real_escape_string($connection, $_POST['fax']);
        $phoneNumber = mysqli_real_escape_string($connection, $_POST['phoneNumber']);
        $established = mysqli_real_escape_string($connection, $_POST['established']);

        $query = mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$companyName' AND Company_Address='$companyAddress' AND Company_Number='$companyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 0) {
            $query = mysqli_query($connection, "INSERT INTO companies (Company_Name, Company_Address, Company_Number, Company_Email_Address, Zip_Code, Company_Contact_Person, Company_Contact_Person_Position, Company_Contact_Person_Email, Company_Contact_Person_Number, Main_Business_Activities, Country, Default_Time_Zone, Fax, Phone_Number, Established) VALUES ('$companyName', '$companyAddress', '$companyContactNumber', '$companyEmailAddress', '$zipCode', '$primaryContact', '$primaryContactCompanyPosition', '$primaryContactEmail', '$primaryContactPhoneNumber', '$mainBusinessActivities', '$country', '$defaultTimeZone', '$fax', '$phoneNumber', '$established')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                $query = mysqli_query($connection, "SELECT * FROM companies WHERE Company_Name='$companyName' AND Company_Address='$companyAddress' AND Company_Number='$companyContactNumber'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                $scan = mysqli_num_rows($query);

                if($scan == 1) {
                    $row = mysqli_fetch_array($query);

                    $query = mysqli_query($connection, "SELECT * FROM clients WHERE First_Name='Not Available' AND Middle_Name='Not Available' AND Last_Name='Not Available' AND Company_ID='$row[Company_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
                    $scan = mysqli_num_rows($query);

                    if($scan == 0) {
                        $query = mysqli_query($connection, "INSERT INTO clients (First_Name, Middle_Name, Last_Name, Company_ID, Added_By, Date_Added) VALUES ('Not Available', 'Not Available', 'Not Available', '$row[Company_ID]', '$username', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                        if($query) {
                            echo 'Company successfully added.';
                        } else {
                            echo 'Failed to add company information.';
                        }
                    } else {
                        echo 'Company already exist.1';
                    }
                } else {
                    echo 'Unable to process information.';
                }
            } else {
                echo 'Failed to add company information.';
            }
        } else {
            $row = mysqli_fetch_array($query);

            $query = mysqli_query($connection, "SELECT * FROM clients WHERE First_Name='Not Available' AND Middle_Name='Not Available' AND Last_Name='Not Available' AND Company_ID='$row[Company_ID]'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
            $scan = mysqli_num_rows($query);

            if($scan == 0) {
                $query = mysqli_query($connection, "INSERT INTO clients (First_Name, Middle_Name, Last_Name, Company_ID, Added_By, Date_Added) VALUES ('Not Available', 'Not Available', 'Not Available', '$row[Company_ID]', '$username', '$datetime')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    echo 'Company successfully added.';
                } else {
                    echo 'Failed to add company information.';
                }
            } else {
                echo 'Company already exist.2';
            }
        }
    }

    mysqli_close($connection);
?>