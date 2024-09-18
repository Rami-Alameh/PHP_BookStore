<?php

function uploadCover($file)
{
    $uploadsFile = "cover_uploads/";
    $coverimg = $uploadsFile . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($coverimg, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // don't want to big size and set uploadok to 0 so we can get an error 
    if ($file["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // allow uploading jpg jpeg and png only
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo " only upload JPG,JPEG and PNG files only.";
        $uploadOk = 0;
    }

    // if not uploaded correctly then uploadok is 0 the then add error else upload 
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $coverimg)) {
            return $file["name"];
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    return null;
}
?>
