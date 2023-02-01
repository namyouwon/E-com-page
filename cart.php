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
    $mysqli = new mysqli("localhost", "root", "", "e_commerce");
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }
    $index = -1;
    if (count($_SESSION['Cart']) == 0) {
        $_SESSION['StoreID'] = $_GET['r'];
        array_splice($_SESSION['Cart'], count($_SESSION['Cart']), 0, $_GET['q']);
        array_splice($_SESSION['NumCart'], count($_SESSION['NumCart']), 0, 1);
    } else {
        //Validate store
        if ($_GET['r'] == $_SESSION['StoreID']) {
            //Find number of product
            for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
                if ($_GET['q'] == $_SESSION['Cart'][$i]) {
                    $index = $i;
                    $_SESSION['NumCart'][$i]++;
                    $remainSQL = "SELECT Remain FROM productinventory WHERE productID=" . $_SESSION['Cart'][$i] . " AND InvenID=" . $_SESSION['StoreID'];
                    $remainValidate = mysqli_query($mysqli, $remainSQL);
                    $remain = 0;
                    foreach ($remainValidate as $item) {
                        $remain = $item['Remain'];
                    }
                    if ($_SESSION['NumCart'][$i] > $remain)
                        $_SESSION['NumCart'][$i] = $remain;
                    break;
                } else
                    $index = -1;
            }
            ///Update number of product
            if ($index == -1) {
                array_splice($_SESSION['Cart'], count($_SESSION['Cart']), 0, $_GET['q']);
                array_splice($_SESSION['NumCart'], count($_SESSION['NumCart']), 0, 1);
            }
        }
    }
    // if ($_SESSION['StoreID'] == $_GET['r']){
    //     for($i=0;$i<count($_SESSION['Cart']);$i++){
    //         if ($_SESSION['Cart'][$i] == $_GET['q']){
    //             echo $_SESSION['Cart'][$i];
    //             echo "<br>";
    //             $_SESSION['NumCart'][$i]++;
    //             $remainSQL = "SELECT Remain FROM productinventory WHERE productID=" . $_SESSION['Cart'][$i] . " AND InvenID=" . $_SESSION['StoreID'];
    //             $remainValidate = mysqli_query($mysqli, $remainSQL);
    //             $remain = 0;
    //             foreach ($remainValidate as $item) {
    //                 $remain = $item['Remain'];
    //             }
    //             if ($_SESSION['NumCart'][$i] > $remain)
    //                 $_SESSION['NumCart'][$i] = $remain;
    //             // if ($_SESSION['Cart'][$i] == $_GET['q']){
    //             //     $_SESSION['NumCart'][$i] += 1;
    //             //     break;
    //             break;
    //         } 
            
    //     }
       
    // } else
    //     echo "nam";
    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
        $value += $_SESSION['NumCart'][$i];
    }
    echo $value;
    ?>
    

</body>

</html>