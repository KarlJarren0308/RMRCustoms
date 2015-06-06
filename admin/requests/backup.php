<?php
    require('connection.php');

    $table = mysqli_real_escape_string($connection, $_POST['table']);

    if(!file_exists('../assets/backup/')) {
        @mkdir('../assets/backup/');
    }

    if($table == 'Logs') {
        $fileStream = fopen('../assets/backup/' . date('Y_m_d_H_i_s') . '_logs.sql', 'w');

        fwrite($fileStream, "DELETE FROM logs;" . PHP_EOL);

        $query = mysqli_query($connection, "SELECT * FROM logs");

        while($row = mysqli_fetch_array($query)) {
            fwrite($fileStream, "INSERT INTO logs (Log_ID, Account_Username, Log, Log_Datetime) VALUES ('$row[Log_ID]', '$row[Account_Username]', '$row[Log]', '$row[Log_Datetime]');" . PHP_EOL);
        }

        fclose($fileStream);

        echo 'Backup Successful.';
    }
?>