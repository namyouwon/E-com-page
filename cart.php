<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <link href="index.css" rel="stylesheet">

</head>

<body>
    <?php
    $value = 0;
    if ($_SESSION['StoreID'] == $_GET['r']){
        for($i=0;$i<count($_SESSION['Cart']);$i++){
            if ($_SESSION['Cart'][$i] == $_GET['q']){
                $_SESSION['NumCart'][$i] += 1;
                break;
            } 
        }
        for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
            $value += $_SESSION['NumCart'][$i];
        }
        echo $value;
    } else
        echo "nam"; 
    ?>
    

</body>

</html>