<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="index.php" method="post" enctype='multipart/form-data' >
<input type="text" name="text" >
<input type="file" name='file' >
<input type="submit" name='submit' value="upload" >



</form>

<?php
      $conn = mysqli_connect("localhost", "root", "12345", "uploads2");


if(isset($_POST['submit'])){
  
$text = $_POST['text'];





    $file = $_FILES["file"];
//print_r($file);
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError= $file['error'];
    $fileSize = $file['size'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

 
    $explode_filename = explode('.', $fileName);
    $newFileName = $explode_filename[0];

    $fileNameNew = $newFileName . "." . $fileActualExt;
    $fileDestination = 'uploads/'.$fileNameNew;

    

    if (in_array($fileActualExt, $allowed)) {
        if ($fileSize < 1000000) {
            move_uploaded_file($fileTmpName, $fileDestination);

        }



    }


    


    $sql = "INSERT INTO images(imagename, text)
    Values ('$fileNameNew','$text')";
        mysqli_query($conn, $sql);


    






   // echo "<img src='uploads/".$fileNameNew." '  height='70' width='60'>";


}


$sql = "SELECT * FROM images";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $image_src= $row['imagename'];
        $textInside = $row['text'];
        echo "
        <div class='imageCont'>
        <p>$textInside</p>
        <img src ='uploads/".$image_src."' height='70' width='60'>
        </div>
        
        
        ";

        }



?>

</body>
</html>
