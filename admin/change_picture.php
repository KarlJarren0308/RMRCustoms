<?php
    require('requests/connection.php');
    include_once('assets/system/header.php');
    include_once('assets/system/navigation.php');

    if(!isset($_SESSION['rmr_username'])) {
        header('Location: ./');
    }
?>

<div class="container">
    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
        <div class="thumbnail shadow">
            <div class="container-fluid">
                <h2>Change Picture</h2>
                <p>Any JPEG or PNG formatted images can be used as your account picture.</p>
                <p>Be sure to upload image with equal height and width or the image will be stretched.</p>
                <?php
                    $flag = false;

                    if(isset($_POST['btnUpload'])) {
                        if(!empty($_FILES['maImageFile']['name'])) {
                            $username = $_SESSION['rmr_username'];
                            $whiteExt = array('jpg', 'png');
                            $directory = "user_files/";

                            if(isset($_FILES['maImageFile']) && $_FILES['maImageFile']['error'] == 0) {
                                /*
                                $upfile = $username . '_' . basename($_FILES['maImageFile']['name']);
                                $uploadfile = $directory . $upfile;
                                $ext = pathinfo($_FILES['maImageFile']['name'], PATHINFO_EXTENSION);
                                */
                                $ext = pathinfo($_FILES['maImageFile']['name'], PATHINFO_EXTENSION);
                                $upfile = $username . '.' . $ext;
                                $uploadfile = $directory . $upfile;

                                if(!in_array(strtolower($ext), $whiteExt)) {
                                    echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;File type not supported.</div>';
                                } else {
                                    if(move_uploaded_file($_FILES['maImageFile']['tmp_name'], $uploadfile)) {
                                        $query = mysqli_query($connection, "UPDATE accounts SET User_Image='$upfile' WHERE Account_Username='$username'");

                                        if($query) {
                                            $_SESSION['rmr_profile'] = $upfile;
                                            $flag = true;

                                            echo '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Image has been uploaded.</div>';
                                            echo '<div class="alert alert-info">We\'ll refresh the page in <span id="countdown"></span>...</div>';
                                            echo '<script>countdown();</script>';
                                        } else {
                                            echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Failed to upload image.</div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Failed to move file to folder.</div>';
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;&nbsp;Oops! Please contact the administrator.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No file has been chosen.</div>';
                        }
                    }

                    if(!$flag) {
                        echo '<strong>Preview:</strong>';
                        echo '<div class="text-center">';
                        echo '<img id="preview-picture" src="">';
                        echo '</div>';
                        echo '<br>';
                        echo '<strong>Upload:</strong>';
                        echo '<form method="POST" enctype="multipart/form-data">';
                        echo '<input id="image-input" name="maImageFile" type="file">';
                        echo '<br>';
                        echo '<div class="text-right">';
                        echo '<input type="submit" name="btnUpload" class="btn btn-primary" value="Upload Image">';
                        echo '</div>';
                        echo '</form>';
                    }
                ?>
                <br>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(function() {
            var URL = window.URL || window.webkitURL;

            var input = document.querySelector('#image-input');
            var preview = document.querySelector('#preview-picture');
            
            // When the file input changes, create a object URL around the file.
            input.addEventListener('change', function () {
                preview.src = URL.createObjectURL(this.files[0]);
            });
            
            // When the image loads, release object URL
            preview.addEventListener('load', function () {
                URL.revokeObjectURL(this.src);
            });
        });
    });
</script>

<?php
    include_once('assets/system/footer.php');
?>