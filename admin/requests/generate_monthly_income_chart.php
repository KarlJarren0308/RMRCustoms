<?php
    require('connection.php');
    $action = mysqli_real_escape_string($connection, $_POST['action']);

    if($action == 'renderGraph') {
        $graph = mysqli_real_escape_string($connection, $_POST['graph']);

        list($type, $graph) = explode(';', $graph);
        list($base64, $graph) = explode(',', $graph);
        $graph = base64_decode($graph);

        file_put_contents('../assets/img/graph_report[' . date('Y-m') . '].png', $graph);
    }

    mysqli_close($connection);
?>