<?php
    require('connection.php');

    $username = $_SESSION['rmr_username'];
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'View') {
        $user = mysqli_real_escape_string($connection, $_POST['username']);
        $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$user'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            if(strlen($row['Middle_Name']) > 1) {
                $name = $row['First_Name'] . ' ' . substr($row['Middle_Name'], 0, 1) . '. ' . $row['Last_Name'];
            } else {
                $name = $row['First_Name'] . ' ' . $row['Last_Name'];
            }

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';
            echo '<tr>';
            echo '<td width="30%" align="right">Username:</td>';
            echo '<td>' . $row['Account_Username'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Name:</td>';
            echo '<td>' . $name . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Role:</td>';
            echo '<td>' . $row['Account_Type'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Gender:</td>';
            echo '<td>' . $row['Gender'] . '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '';
        }
    } else if($action == 'Add') {
        $addAccountUsername = mysqli_real_escape_string($connection, $_POST['addAccountUsername']);
        $addAccountPassword = mysqli_real_escape_string($connection, $_POST['addAccountPassword']);
        $addAccountConfirmPassword = mysqli_real_escape_string($connection, $_POST['addAccountConfirmPassword']);
        $addFirstName = mysqli_real_escape_string($connection, $_POST['addFirstName']);
        $addMiddleName = mysqli_real_escape_string($connection, $_POST['addMiddleName']);
        $addLastName = mysqli_real_escape_string($connection, $_POST['addLastName']);
        $addRole = mysqli_real_escape_string($connection, $_POST['addRole']);
        $addGender = mysqli_real_escape_string($connection, $_POST['addGender']);

        if($addAccountPassword == $addAccountConfirmPassword) {
            $query = mysqli_query($connection, "INSERT INTO accounts (Account_Username, Account_Password, Account_Type, First_Name, Middle_Name, Last_Name, Gender) VALUES ('$addAccountUsername', '$addAccountPassword', '$addRole', '$addFirstName', '$addMiddleName', '$addLastName', '$addGender')") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'User successfully added.';
            } else {
                echo 'Failed to add user.';
            }
        } else {
            echo 'Password did not match.';
        }
    } else if($action == 'Get Fields') {
        echo '<form id="add-new-user-form">';
        echo '<table class="table table-hover table-striped">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td width="30%" align="right">Username:</td>';
        echo '<td><input type="text" class="form-control" name="addAccountUsername" placeholder="Enter Username here..." required></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Password:</td>';
        echo '<td><input type="password" class="form-control" name="addAccountPassword" placeholder="Enter Password here..." required></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Confirm Password:</td>';
        echo '<td><input type="password" class="form-control" name="addAccountConfirmPassword" placeholder="Confirm Password here..." required></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Name:</td>';
        echo '<td><div class="row"><div class="col-lg-4 col-md-4"><input type="text" class="form-control" name="addFirstName" placeholder="Enter First Name here..." required></div><div class="col-lg-4 col-md-4"><input type="text" class="form-control" name="addMiddleName" placeholder="Enter Middle Name here..."></div><div class="col-lg-4 col-md-4"><input type="text" class="form-control" name="addLastName" placeholder="Enter Last Name here..." required></div></div></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Role:</td>';
        echo '<td><select class="form-control" name="addRole" required>';
        echo '<option value="" selected disabled>Choose a role</option>';
        
        if($_SESSION['rmr_type'] == 'Administrator') {
            echo '<option value="Administrator">Administrator</option>';
            echo '<option value="President">President</option>';
        }

        if($_SESSION['rmr_type'] == 'President') {
            echo '<option value="President">President</option>';
        }

        echo '<option value="Clerk">Clerk</option>';
        echo '</select></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td align="right">Gender:</td>';
        echo '<td><select class="form-control" name="addGender" required>';
        echo '<option value="" selected disabled>Choose a gender</option>';
        echo '<option value="Male">Male</option>';
        echo '<option value="Female">Female</option>';
        echo '</select></td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        echo '<div class="text-right"><input class="btn btn-primary" type="submit" value="Add User"></div>';
        echo '</form>';
    } else if($action == 'Edit') {
        $user = mysqli_real_escape_string($connection, $_POST['username']);
        $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$user'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

        if($query) {
            $row = mysqli_fetch_array($query);

            echo '<table class="table table-hover table-striped">';
            echo '<tbody>';
            echo '<tr>';
            echo '<td width="30%" align="right">Username:</td>';
            echo '<td><input type="text" class="form-control" id="edit-account-username" placeholder="Enter Username here..." value="' . $row['Account_Username'] . '"></td>';
            echo '</tr>';
            
            if($_SESSION['rmr_type'] == 'Administrator') {
                echo '<tr>';
                echo '<td align="right">Password:</td>';
                echo '<td><input type="password" class="form-control" id="edit-account-password" placeholder="Enter Password here..." value="' . $row['Account_Password'] . '"></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Confirm Password:</td>';
                echo '<td><input type="password" class="form-control" id="edit-account-confirm-password" placeholder="Confirm Password here..." value="' . $row['Account_Password'] . '"></td>';
                echo '</tr>';
            } else {
                if($username == $row['Account_Username']) {
                    echo '<tr>';
                    echo '<td align="right">Password:</td>';
                    echo '<td><input type="password" class="form-control" id="edit-account-password" placeholder="Enter Password here..." value="' . $row['Account_Password'] . '"></td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td align="right">Confirm Password:</td>';
                    echo '<td><input type="password" class="form-control" id="edit-account-confirm-password" placeholder="Confirm Password here..." value="' . $row['Account_Password'] . '"></td>';
                    echo '</tr>';
                }
            }

            echo '<tr>';
            echo '<td align="right">Name:</td>';
            echo '<td><div class="row"><div class="col-lg-4 col-md-4"><input type="text" class="form-control" id="edit-first-name" placeholder="Enter First Name here..." value="' . $row['First_Name'] . '"></div><div class="col-lg-4 col-md-4"><input type="text" class="form-control" id="edit-middle-name" placeholder="Enter Middle Name here..." value="' . $row['Middle_Name'] . '"></div><div class="col-lg-4 col-md-4"><input type="text" class="form-control" id="edit-last-name" placeholder="Enter Last Name here..." value="' . $row['Last_Name'] . '"></div></div></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Role:</td>';

            if($_SESSION['rmr_type'] == 'Clerk' && $row['Account_Type'] == 'Clerk') {
                $flag = true;
            } else if(($_SESSION['rmr_type'] == 'President' && $row['Account_Type'] == 'Clerk') || ($_SESSION['rmr_type'] == 'President' && $row['Account_Type'] == 'President')) {
                $flag = true;
            } else if($_SESSION['rmr_type'] == 'Administrator') {
                $flag = true;
            } else {
                $flag = false;
            }

            if($flag) {
                echo '<td><select class="form-control" id="edit-role">';
                echo '<option value="" disabled>Choose a role</option>';
                
                if($_SESSION['rmr_type'] == 'Administrator') {
                    echo '<option value="Administrator">Administrator</option>';
                    echo '<option value="President">President</option>';
                }

                if($_SESSION['rmr_type'] == 'President') {
                    echo '<option value="President">President</option>';
                }
                
                echo '<option value="Clerk" selected>Clerk</option>';
                echo '</select></td>';
            } else {
                echo '<td>Your role should be equal or higher than this user for you to change his/her role.</td>';
            }

            echo '</tr>';
            echo '<tr>';
            echo '<td align="right">Gender:</td>';
            echo '<td><select class="form-control" id="edit-gender">';
            echo '<option value="" disabled>Choose a gender</option>';

            if($row['Gender'] == 'Male') {
                echo '<option value="Male" selected>Male</option>';
                echo '<option value="Female">Female</option>';
            } else {
                echo '<option value="Male">Male</option>';
                echo '<option value="Female" selected>Female</option>';
            }

            echo '</select></td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
            echo '<div class="text-right"><button id="save-changes-on-users-button" class="btn btn-primary">Save Changes</button></div>';
        }
    } else if($action == 'Save') {
        $editAccountUsername = mysqli_real_escape_string($connection, $_POST['editAccountUsername']);
        $editAccountPassword = mysqli_real_escape_string($connection, $_POST['editAccountPassword']);
        $editAccountConfirmPassword = mysqli_real_escape_string($connection, $_POST['editAccountConfirmPassword']);
        $editFirstName = mysqli_real_escape_string($connection, $_POST['editFirstName']);
        $editMiddleName = mysqli_real_escape_string($connection, $_POST['editMiddleName']);
        $editLastName = mysqli_real_escape_string($connection, $_POST['editLastName']);
        $editRole = mysqli_real_escape_string($connection, $_POST['editRole']);
        $editGender = mysqli_real_escape_string($connection, $_POST['editGender']);
        $oldUsername = mysqli_real_escape_string($connection, $_POST['oldUsername']);

        $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$oldUsername'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 1) {
            if($editAccountPassword == $editAccountConfirmPassword) {
                $query = mysqli_query($connection, "UPDATE accounts SET Account_Username='$editAccountUsername', Account_Password='$editAccountPassword', Account_Type='$editRole', First_Name='$editFirstName', Middle_Name='$editMiddleName', Last_Name='$editLastName', Gender='$editGender' WHERE Account_Username='$oldUsername'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

                if($query) {
                    echo 'Saved Changes.';
                } else {
                    echo 'Unable to save changes.';
                }
            } else {
                echo 'Password did not match.';
            }
        } else {
            echo 'Oops. Unable to find user.';
        }
    } else if($action == 'Delete') {
        $user = mysqli_real_escape_string($connection, $_POST['username']);
        $query = mysqli_query($connection, "SELECT * FROM accounts WHERE Account_Username='$user'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));
        $scan = mysqli_num_rows($query);

        if($scan == 1) {
            $query = mysqli_query($connection, "UPDATE accounts SET Status='Inactive' WHERE Account_Username='$user'") or die('Cannot connect to Database. Error: ' . mysqli_error($connection));

            if($query) {
                echo 'User successfully deleted.';
            } else {
                echo 'Unable to save changes.';
            }
        } else {
            echo 'Oops. Unable to find user.';
        }
    }

    mysqli_close($connection);
?>