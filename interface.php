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
    $mysqli = new mysqli("localhost", "root", "", "e_commerce");
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }
    $sql = "SELECT NamePro,price,Remain,AddressInven,NameInven,link 
        FROM productinventory 
        INNER JOIN product ON product.ID=productinventory.productID 
        INNER JOIN inventory ON inventory.ID=productinventory.InvenID 
        WHERE productID =? AND InvenID=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $_GET['q'], $_GET['r']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($name, $price, $remain, $address, $inven, $link);
    $stmt->fetch();
    $stmt->close();
    function TransferNumber($num)
    {
        $str = "";
        $count = 0;
        while ($num) {
            if ($count == 3) {
                $str = "." . $str;
                $count = 0;
            }
            $str = ($num % 10) . $str;
            $count++;

            $num = floor($num / 10);
        }
        return $str;
    }
    ?>
    <div class="details">
        <h1>Details</h1>
        <br>
        <h3> Product name: <span><?php echo $name; ?></span></h3>
        <h3> Product price: <span class="infor"><?php echo round($price / $_SESSION['rate'], 2); ?> USD</span></h3>
        <h3> Remain: <span><?php echo $remain; ?></span></h3>
        <h3> Store name: <span><?php echo $inven; ?></span></h3>
        <h3> Address bill : <span><?php echo $address; ?></span></h3>
    </div>
</body>

</html>