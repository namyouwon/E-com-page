<!DOCTYPE HTML>
<html lang="vi">

<head>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php
    {
        /** Nên viết riêng 1 function để call API */
        $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=10"; // <-- có thể đặt tên tạm cho những biến dùng 1 lần như này

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        $findUSD = "USD"; // <-- hạn chế sử dụng động từ cho biến, có thể đặt là usdSymbol
        $findTransfer = "Transfer=";
        $posUSD = strpos($resp, $findUSD);
        $posTransfer = strpos($resp, $findTransfer, $posUSD);
        $res = 0;
        for ($i = $posTransfer + 10; $i < strlen($resp); $i++) {
            if ($resp[$i] == "\"")
                break;
            else if ($resp[$i] == "," || $resp[$i] == ".")
                continue;
            else
                $res = $res * 10 + $resp[$i];
        }
        $res /= 100;
    }
    $ID = 1;
    function TransferNumber($num)
    {
        $str = ""; // <-- những biến viết tắt nên hạn chế (có thể dùng cho biến dùng 1 lần trong for, ...)
        $count = 0;
        while ($num) {
            if ($count == 3) {
                $str = "," . $str;
                $count = 0;
            }
            $str = ($num % 10) . $str;
            $count++;
            $num = floor($num / 10);
        }
        return $str;
    }
    if (isset($_GET['ID'])) {
        $conn = new mysqli('localhost', 'root', '', 'e_commerce');
        $orderID = $_GET['ID'];
        $table1 = "SELECT NamePro,price,Quantity
                        FROM orderdetail 
                        INNER JOIN product ON orderdetail.productID=product.ID
                        WHERE orderID=" . $orderID; // <-- nên đặt tên cho biến table = tableName
        $list1 = $conn->query($table1); // <-- chỗ list này cũng vậy, nên đặt là listTableName
        $numrow = $list1->num_rows;
        if ($numrow == 0) {
            echo "Not found";
            $orderID = "";
        } else {
            $list3 = $conn->query("SELECT * FROM customercontact WHERE ID='" . $_GET['CusID'] . "'");
            while ($row = $list3->fetch_assoc()) {
                $phone = $row['Phone'];
                $cusName = $row['Name'];
                $email = $row['Email'];
                $shipAdd = $row['ShipAdd'];
            }
            $list2 = $conn->query("SELECT Total FROM orders WHERE ID=" . $orderID);
            while ($row = $list2->fetch_assoc()) {
                $total = $row['Total'];
            }
        }
    }
    // 
    ?>
    <!-- <form method="post">
            <input type="text" name="orderNo" placehoder="Enter number" value=<?php echo $orderID ?>>
            <input type="submit" value="Search">
        </form> -->
    <div class="form">
        <img src="https://images.glints.com/unsafe/glints-dashboard.s3.amazonaws.com/company-logo/4bad2e07e20c86d8aeb948f56cad89d8.png">
        <h1 id="header">furuCRM Vietnam</h1>
        <table class="InforCus">
            <tr>
                <td class="header">
                    Phone:
                </td>
                <td>
                    <span><?php echo $phone ?></span>
                </td>
            </tr>
            <tr>
                <td class="header">
                    Email:
                </td>
                <td>
                    <?php echo $email ?>
                </td>
            </tr>
            <tr>
                <td class="header">
                    Order no:
                </td>
                <td>
                    <span id="orderNo"><?php echo $orderID ?></span>
                </td>
            </tr>

        </table>
        <h1 id="invoice">Invoice</h1>
        <table class="InforBill">
            <tr>
                <td class="header">
                    Customer name:
                </td>
                <td>
                    <span><?php echo $cusName ?></span>
                </td>
            </tr>
            <tr>
                <td class="header">
                    Shipping address:
                </td>
                <td>
                    <?php echo $shipAdd; ?>
                </td>
            </tr>
        </table>
        <table class="output">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                
            </tr>
            <tr>
                <?php
                $total = 0; // hạn chế đặt tên chung chung như thế này để tránh nhầm với những total khác, như totalProduct, totalOrder, ...
                while ($row = $list1->fetch_assoc()) {
                    echo "<tr>";
                    //echo "id: " . $row["email"]. " - Name: " . $row["customerName"]. "<br>";
                    // $proName = $row['name_product'];                             //,quantity,customerName,email,phone
                    // $price =    $row['price'];                                      //,orders,customercontact
                    // $quan=      $row['quantity'];
                    echo "<td>" . $ID . "</td>";
                    echo "<td>" . ($row['NamePro']) . "</td>";
                    echo "<td>" . TransferNumber(round($row['price']*$res)) . " VND</td>";
                    echo "<td>" . ($row['Quantity']) . "</td>";
                    echo "<td>" . TransferNumber(round($row['price'] * $res)* ($row['Quantity'])). " VND</td>";
                    //$total += $price * $quan;

                    $total += round($row['price'] * $res) * ($row['Quantity']);
                    $ID++;
                    echo "</tr>";
                }

                ?>
            </tr>
        </table>
        <div class="total">
            <p id="total">Total <span id="value"><?php echo TransferNumber($total); ?></span> VND</p>
        </div>

    </div>
</body>

</html>