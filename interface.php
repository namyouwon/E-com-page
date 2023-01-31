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
    <div style="height: 20%"></div>
    <div style="height: 40%; padding:auto;" class="slds-p-around_large slds-text-align_center">
        <img src="<?=$link; ?>" style="max-height:100%">
    </div>
    <div class="slds-form-element__control slds-text-align_center" style="height:30%;">
        <table class="slds-table " style="max-height:100%">
            <tr>
                <td>Name:</td>
                <td style="font-weight: bold"><?=$name; ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td style="font-weight: bold"><?=TransferNumber(round($price * $_SESSION['rate'])); ?> VND</td>
            </tr>
            <tr>
                <td>Remain:</td>
                <td style="font-weight: bold"><?=$remain; ?></td>
            </tr>
            <tr>
                <td>Store:</td>
                <td style="font-weight: bold"><?=$inven; ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td style="font-weight: bold"><?=$address; ?></td>
            </tr>
        </table>
    </div>
</body>

</html>