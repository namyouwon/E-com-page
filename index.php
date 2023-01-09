<?php
session_start();
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Page product</title>
    <link rel="stylesheet" href="interface.php">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="cart.php">
    <link rel="stylesheet" href="cart.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- view detail of product -->
    <script>
        function showProduct(num) {
            var myArray = num.split("_");
            var page = myArray[2];
            if (num == "") {
                document.getElementById("showBlock").innerHTML = "";
                return;
            }
            //resize block to show detail
            var div = document.getElementById("showBox");
            div.style.width = "70%";
            //resize element to show detail
            var items = document.getElementsByClassName('product');
            if (page == 12) {
                for (var i = 0; i < items.length; i++) {
                    items[i].style.margin = '1% 2% 0% 1%';
                    items[i].style.backgroundColor = "white";
                    items[i].style.width = "13%";
                }
            } else if (page == 10) {
                for (var i = 0; i < items.length; i++) {
                    items[i].style.margin = '0.3% 3% 0% 3%';
                    items[i].style.backgroundColor = "white";
                    items[i].style.width = "13%";
                }
            } else {
                for (var i = 0; i < items.length; i++) {
                    items[i].style.margin = '0.3% 6% 0% 6%';
                    items[i].style.backgroundColor = "white";
                    items[i].style.width = "13%";
                }
            }

            var div1 = document.getElementById(num);
            div1.style.background = "rgb(203, 203, 203)";
            const xhttp = new XMLHttpRequest();

            xhttp.onload = function() {
                document.getElementById("showBlock").innerHTML = this.responseText;
            }
            xhttp.open("GET", "interface.php?q=" + myArray[0] + "&r=" + myArray[1]);
            xhttp.send();
        }
    </script>

    <script>
        function Alert() {
            alert("Error: product in different shop");
        }
    </script>
</head>

<body>
    <?php
    $res = 1;
    function transferNumber($num){
        $str = "";
        $count = 0;
        $decimal = $num - floor($num);
        while ($num) {
            if ($count == 3) {
                $str = "," . $str;
                $count = 0;
            }
            $str = ($num % 10) . $str;
            $count++;
            $num = floor($num / 10);
        }
        if ($decimal != 0){
            $str = $str . '.';
            $decimal *= 100;
            $decimal = round($decimal);
            $str .= $decimal;
        }  
        return $str;
    }
    function generateRandomString($length = 9)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $mysqli = new mysqli("localhost", "root", "", "e_commerce");
    $customerSQL = "SELECT * FROM customercontact";
    $customerList = mysqli_query($mysqli, $customerSQL);
    $cusNumRows = mysqli_num_rows($customerList);
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }
    $sql = "SELECT NamePro as Name,price as Price,ID as id
            FROM product";
    $result = mysqli_query($mysqli, $sql);
    $disableBackground = false;
    $showCart = false;


    //POST/////////////////////////////////////////// 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Inc,Dec,Delete,ChangeNum
        for ($i = 0; $i < count($_SESSION['NumCart']); $i++) {
            $_SESSION['NumCart'][$i] = isset($_POST["number" . $i]) ? $_POST['number' . $i] : $_SESSION['NumCart'][$i];
            //change num of product
            if (isset($_POST['number' . $i])) {
                $disableBackground = true;
                $showCart = true;
                if ($_POST['number' . $i] <= 0) {
                    $_SESSION['NumCart'][$i] = 1;
                } else {
                    $remainSQL = "SELECT Remain FROM productinventory WHERE productID=" . $_SESSION['Cart'][$i];
                    $remainValidate = mysqli_query($mysqli, $remainSQL);
                    $remain = 1000;
                    foreach ($remainValidate as $item) {
                        $remain = $item['Remain'];
                    }
                    if ($_SESSION['NumCart'][$i] > $remain)
                        $_SESSION['NumCart'][$i] = $remain;
                }
                break;
            }
            //click DELETE product
            if (isset($_POST['delete' . $i]) || $_SESSION['NumCart'][$i] == 0) {
                $disableBackground = true;
    ?>
                <div class="CartBoxAlert">
                    <h1>Are you sure to delete this product?</h1>
                    <form method="post">
                        <button id="Permit" name="YPermit<?php echo $i; ?>">Yes</button>
                        <button id="Permit" name="NPermit<?= $i; ?>">No</button>
                    </form>
                </div>
                <div class="CartBox DisableBox" id="CartBox">
                    <h1>Cart</h1>
                    <table id="table">
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>

                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sub total</th>
                        </tr>
                        <!-- <form method="post"> -->

                        <?php
                        $pay = 0;
                        for ($j = 0; $j < count($_SESSION["NumCart"]); $j++) {
                            echo "<tr>";
                            echo "<td>" . ($j + 1) . "</td>";
                            foreach ($result as $item) {
                                if ($item['id'] == $_SESSION["Cart"][$j]) {
                                    echo "<td>" . $item['Name'] . "</td>";

                        ?>
                                    <td>
                                        <span>
                                            <form method="post">
                                                <button class="valuebutton" id="decbut" name='decqty<?php echo $j; ?>' onclick="decreaseValue(<?php echo $j; ?>)">-</button>
                                            </form>
                                        </span>
                                        <!-- <formm method="post"> -->
                                        <span>
                                            <form method="post">
                                                <input class="numberChange" type="number" name="number<?php echo $j; ?>" id="number<?php echo $j; ?>" value="<?= $_SESSION['NumCart'][$j]; ?>" onchange="this.form.submit()" />
                                            </form>
                                        </span>
                                        <!-- </formm> -->
                                        <form method="post">
                                            <button class="valuebutton" id="incbut" name='incqty<?php echo $j; ?>' onclick="increaseValue(<?php echo $j; ?>)">+</button>
                                        </form>
                                    </td>
                                    <?php
                                echo "<td>" . round($item['Price'] / $_SESSION['rate'], 2) . " USD</td>";
                                echo "<td>" . transferNumber(round($item['Price'] / $_SESSION['rate'] * $_SESSION['NumCart'][$j], 2)) . " USD</td>";
                                    $pay += $item['Price'] / $_SESSION['rate'] * $_SESSION['NumCart'][$j];
                                    ?>
                                    <div class="sub"></div>
                                    <td>
                                        <form method="post">
                                            <button name="delete<?php echo $j; ?>" class="DelBut">Delete</button>
                                        </form>
                                    </td>
                            <?php
                                }
                            }
                            ?>

                        <?php
                            echo "</tr>";
                        }
                        ?>


                    </table>
                    <div class="totalPay">
                        <p>Total: <span style="color:red;"><?php echo transferNumber($pay)  ?> USD</span> </p>
                    </div>
                    <form method="post">
                        <button id="Checkout" name="Checkout">Checkout</button>
                    </form>
                    <form method="post">
                        <input type="submit" name="cancel" id="Cancel" value="Cancel">
                    </form>
                </div>

                <!-- <div class="Permission">
                <p>Are you sure to delete this product?</p>
                <form method="post">
                    <button class="permission" id="YPermission" name="Y_Permission<?php echo $i; ?>">Yes</button>
                    <button class="permission" id="NPermission" name="N_Permission<?php echo $i; ?>">No</button>
                </form>
            </div> -->
            <?php
                break;
            }
            //click INCREASE/DECREASE product
            if (isset($_POST['incqty' . $i]) || isset($_POST['decqty' . $i])) {
                $disableBackground = true;
                $showCart = true;
                if (isset($_POST['incqty' . $i])) {
                    $_SESSION['NumCart'][$i]++;
                    $remainSQL = "SELECT Remain FROM productinventory WHERE productID=" . $_SESSION['Cart'][$i];
                    $remainValidate = mysqli_query($mysqli, $remainSQL);
                    $remain = 1000;
                    foreach ($remainValidate as $item) {
                        $remain = $item['Remain'];
                    }
                    if ($_SESSION['NumCart'][$i] > $remain)
                        $_SESSION['NumCart'][$i] = $remain;
                }
                if (isset($_POST['decqty' . $i])) {
                    $_SESSION['NumCart'][$i]--;
                    if ($_SESSION['NumCart'][$i] == 0)
                        $_SESSION['NumCart'][$i] = 1;
                }
            ?>
            <?php
                break;
            }
            //Agree DELETE
            if (isset($_POST['YPermit' . $i])) {
                $disableBackground = true;
                array_splice($_SESSION['NumCart'], $i, 1);
                array_splice($_SESSION['Cart'], $i, 1);
                $showCart = true;
                break;
            }
            //Disagree DELETE
            if (isset($_POST['NPermit' . $i])) {
                $disableBackground = true;
                $showCart = true;
                break;
            }
        }

        //Add data to db
        for ($i = 1; $i <= $cusNumRows; $i++) {
            foreach ($customerList as $item) {
                if (isset($_POST['Customer' . $i . '_' . $item['ID']])) {
                    $random = generateRandomString();
                    $total = 0;
                    $CusID = $item['ID'];
                    for ($i = 0; $i < count($_SESSION['NumCart']); $i++) {
                        $InsertOrderDetails = "INSERT INTO `orderdetail` (`ID`, `Quantity`, `productID`, `orderID`) VALUES ('', " . $_SESSION['NumCart'][$i] . ", " . $_SESSION['Cart'][$i] . ", " . $random . ");";
                        // echo $InsertOrderDetails;
                        $mysqli->query($InsertOrderDetails);
                        foreach ($result as $item) {
                            if ($item['id'] == $_SESSION["Cart"][$i]) {
                                $total += $_SESSION['NumCart'][$i] * $item['Price'];
                            }
                        }
                    }
                    $InsertOrder
                        = "INSERT INTO `orders` (`ID`, `StoreID`, `Customer`, `Total`) VALUES (" . $random . ", " . 7777 . "," . $CusID . ", " . $total . ");";
                    $mysqli->query($InsertOrder);
                    $_SESSION["Cart"] = array();
                    $_SESSION['NumCart'] = array();
                    $_SESSION['StoreID'] = 0;
                    header("Location: bill/index.php?ID=$random&CusID=$CusID");
                    exit();
                }
            }
        }

        //click CHECKOUT
        if (isset($_POST['Checkout'])) {
            $disableBackground = true;
            if (count($_SESSION['NumCart']) == 0) {
            ?>
                <div class="CartBox">
                    <div>
                        <h1> There's no product to checkout</h1>
                    </div>
                    <form method="post">
                        <button id="Cancel" name="Cancel">Cancel</button>
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="CartBox">
                    <h1>Customer List Checkout</h1>
                    <table>
                        <tr>
                            <th>No </th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Shipping address</th>
                        </tr>

                        <?php
                        $No = 1;
                        foreach ($customerList as $item) {
                            echo "<tr>";
                            echo "<td>" . $No . "</td>";
                            echo "<td>" . $item['Name'] . "</td>";
                            echo "<td>" . $item['Phone'] . "</td>";
                            echo "<td>" . $item['ShipAdd'] . "</td>";
                        ?>
                            <td>
                                <form method="post">
                                    <button id="EachCheckout" name="Customer<?php echo $No; ?>_<?php echo $item['ID']; ?>">Checkout</button>
                                </form>
                            </td>
                        <?php
                            $No++;
                            echo "</tr>";
                        }
                        ?>
                    </table>
                    <form method="post">
                        <button id="Checkout" name="subCart">Cart</button>
                        <button id="Cancel" name="Cancel">Cancel</button>
                    </form>
                </div>

                <?php
            }
        }
        // click Cart
        if (isset($_POST["subCart"])) {
            $disableBackground = true;
            $showCart = true;
        }
        // click Cancel
        if (isset($_POST['cancel'])) {
            $disableBackground = 0;
            $showCart = false;
        }
        // click Add To Cart
        if (isset($_POST['CartSubmit'])) {
            $index = -3;

            if (count($_SESSION['Cart']) == 0) {
                $_SESSION['StoreID'] = $_POST['StoreID'];
                array_splice($_SESSION['Cart'], count($_SESSION['Cart']), 0, $_POST['ProductID']);
                array_splice($_SESSION['NumCart'], count($_SESSION['NumCart']), 0, 1);
            } else {
                if ($_POST['StoreID'] == $_SESSION['StoreID']) {
                    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
                        if ($_POST['ProductID'] == $_SESSION['Cart'][$i]) {
                            $index = $i;
                            break;
                        } else
                            $index = -2;
                    }
                    if ($index == -2) {
                        array_splice($_SESSION['Cart'], count($_SESSION['Cart']), 0, $_POST['ProductID']);
                        array_splice($_SESSION['NumCart'], count($_SESSION['NumCart']), 0, 1);
                    } else $_SESSION['NumCart'][$index] += 1;
                }
            }
        }



        //click Search
        if (isset($_POST['submit'])) {
            $_SESSION['KeyWord'] = $_POST["KeyWord"];
            $_SESSION['Large'] = $_POST['LargeName'];
            $_SESSION['Child'] = $_POST['ChildName'];
            $_SESSION['Min'] = $_POST['MinPrice'];
            if (preg_match("/^[a-zA-Z-' ]*$/", $_SESSION['Min']) && $_SESSION['Min']) {
                $_SESSION['faultmin'] = "Value is invalid!";
            } else {
                $_SESSION['faultmin'] = '';
            }
            $_SESSION['Max'] = $_POST['MaxPrice'];
            if (preg_match("/^[a-zA-Z-' ]*$/", $_SESSION['Max']) && $_SESSION['Max']) {
                $_SESSION['faultmax'] = "Value is invalid!";
            } else {
                $_SESSION['faultmax'] = '';
            }

            if (empty($_POST['Publish'])) {
                $_SESSION['Public'] = '0';
                $_SESSION['CheckedPublic'] = "";
            } else {
                $_SESSION['Public'] = $_POST['Publish'];
                $_SESSION['CheckedPublic'] = "checked";
            }
            if (empty($_POST['Empty'])) {
                $_SESSION['Empty'] = '0';
                $_SESSION['CheckedEmpty'] = "";
            } else {
                $_SESSION['Empty'] = $_POST['Empty'];
                $_SESSION['CheckedEmpty'] = "checked";
            }
            $_SESSION['page_number'] = 1;
        }
        //click ClearSearch
        if (isset($_POST['ClearSearch'])) {
            $_SESSION['KeyWord'] = '';
            $_SESSION['Large'] = '';
            $_SESSION['Child'] = '';
            $_SESSION['Min'] = '';
            $_SESSION['Max'] = '';
            $_SESSION['CheckedPublic'] = "";
            $_SESSION['CheckedEmpty'] = "";
            $_SESSION['Public'] = '0';
            $_SESSION['Empty'] = '0';
            $_SESSION['faultmin'] = '';
            $_SESSION['faultmax'] = '';
        }
        //sort NumPro  8,10,12
        if (empty($_POST['NumOfPro']))
            $_SESSION['NumPage'] = $_SESSION['NumPage'];
        else
            $_SESSION['NumPage'] = $_POST['NumOfPro'];
        //sort by Name/Price
        if (empty($_POST['SortBy'])) {
        } else
            $_SESSION['Field'] = $_POST['SortBy'];
        //sort by ASC/DESC
        if (empty($_POST['sort'])) {
        } else {
            $_SESSION['Order'] = $_POST['sort'];
        }
    } else {
        if (isset($_GET['page'])) {
            $_SESSION['ID'] = $_GET['id'];
            $list = explode("_", $_SESSION['ID']);
            $_SESSION['KeyWord'] = $list[0];
            $_SESSION['Large'] = $list[1];
            $_SESSION['Child'] = $list[2];
            $_SESSION['Min'] = $list[3];
            $_SESSION['Max'] = $list[4];
            $_SESSION['Public'] = $list['5'];
            $_SESSION['Empty'] = $list['6'];
            $_SESSION['CheckedPublic'] = $list['7'];
            $_SESSION['CheckedEmpty'] = $list['8'];
            $_SESSION['NumPage'] = $list['9'];
            $_SESSION['Field'] = $list['10'];
            $_SESSION['Order'] = $list['11'];
            $_SESSION['page_number']  = $_GET["page"];
        } else {
            $_SESSION['KeyWord'] = "";
            $_SESSION['Large'] = "";
            $_SESSION['Child'] = "";
            $_SESSION['Min'] = "";
            $_SESSION['Max'] = "";
            $_SESSION['Public'] = "";
            $_SESSION['Empty'] = "";
            $_SESSION['CheckedPublic'] = "";
            $_SESSION['CheckedEmpty'] = "";
            $_SESSION['NumPage'] = "12";
            $_SESSION['Field'] = "name";
            $_SESSION['Order'] = "ASC";
            $_SESSION['faultmin'] = "";
            $_SESSION['faultmax'] = "";
            $_SESSION['Cart'] = array();
            $_SESSION['NumCart'] = array();
            $_SESSION['StoreID'] = 0;
            $_SESSION['page_number'] = 1;
            $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=10";

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
            $findUSD = "USD";
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
            $_SESSION['rate'] = $res;
        }
    }


    //////Show Cart Box
    if ($showCart == true) {
        ?>
        <div class="CartBox" id="CartBox">

            <h1>Cart</h1>
            <table >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Sub total</th>
                    </tr>
                </thead>

                <?php
                $pay = 0;
                for ($j = 0; $j < count($_SESSION["NumCart"]); $j++) {
                    echo "<tr>";
                    echo "<td>" . ($j + 1) . "</td>";
                    foreach ($result as $item) {
                        if ($item['id'] == $_SESSION["Cart"][$j]) {
                            echo "<td>" . $item['Name'] . "</td>";

                ?>
                            <td>
                                <span>
                                    <form method="post">
                                        <button class="valuebutton" id="decbut" name='decqty<?php echo $j; ?>' onclick="decreaseValue(<?php echo $j; ?>)">-</button>
                                    </form>
                                </span>
                                <!-- <formm method="post"> -->
                                <span>
                                    <form method="post">
                                        <input class="numberChange" type="number" name="number<?php echo $j; ?>" id="number<?php echo $j; ?>" value="<?= $_SESSION['NumCart'][$j]; ?>" onchange="this.form.submit()" />
                                    </form>
                                </span>
                                <!-- </formm> -->
                                <form method="post">
                                    <button class="valuebutton" id="incbut" name='incqty<?php echo $j; ?>' onclick="increaseValue(<?php echo $j; ?>)">+</button>
                                </form>
                            </td>
                            <?php
                            echo "<td>" . round($item['Price']/$_SESSION['rate'],2) . " USD</td>";
                            echo "<td>" . transferNumber(round($item['Price']/ $_SESSION['rate'] * $_SESSION['NumCart'][$j],2)) . " USD</td>";
                            $pay += $item['Price'] / $_SESSION['rate'] * $_SESSION['NumCart'][$j];
                            ?>
                            <div class="sub"></div>
                            <td>
                                <form method="post">
                                    <button name="delete<?php echo $j; ?>" class="DelBut">Delete</button>
                                </form>
                            </td>
                    <?php
                        }
                    }
                    ?>

                <?php
                    echo "</tr>";
                }
                ?>


            </table>
            <div class="totalPay">
                <p>Total: <span style="color:red;"><?php echo transferNumber($pay)  ?> USD</span> </p>
            </div>
            <form method="post">
                <button id="Checkout" name="Checkout">Checkout</button>
            </form>
            <form method="post">
                <input type="submit" name="cancel" id="Cancel" value="Cancel">
            </form>

        </div>
    <?php
    }

    /////Show CustomerBox


    $_SESSION['ID'] = $_SESSION['KeyWord'] . '_' . $_SESSION['Large'] . '_' . $_SESSION['Child'] . '_' . $_SESSION['Min'] . '_' . $_SESSION['Max'] . '_' . $_SESSION['Public'] . '_' . $_SESSION['Empty'] . '_' . $_SESSION['CheckedPublic'] . '_' . $_SESSION['CheckedEmpty'] . '_' . $_SESSION['NumPage'] . '_' . $_SESSION['Field'] . '_' . $_SESSION['Order'];
    $initial_page = ($_SESSION['page_number'] - 1) * $_SESSION['NumPage'];
    //SQL/////////////////////////////////////////////
    {
        $sql = "WITH RECURSIVE categories AS (
                SELECT      ID,
                            CatName,
                            ParentID,
                        0 AS hierarchy_level
                FROM categry
                WHERE ParentID =0
                
                UNION ALL
                
                SELECT      e.ID,
                            e.CatName,
                            e.ParentID,
                        hierarchy_level + 1
                FROM categry e, categories ch
                WHERE e.ParentID = ch.id
                )
                
                SELECT   ch.CatName AS ProName,
                        ch.ID   AS ID,
                        e.CatName AS CatName,
                        e.ID AS CatID,
                        hierarchy_level
                FROM categories ch
                LEFT JOIN categry e
                ON ch.ParentID = e.ID
                ORDER BY ch.hierarchy_level, ch.ParentID;";
        $result = mysqli_query($mysqli, $sql);
    }
    ?>


    <!-- FORM -->
    <div class="totalform <?php if ($disableBackground ==true) echo "DisableBox" ?>">
        <form method="post">
            <div id="form">
                <div class="InputKeyWord">
                    <input type=" text" placeholder="Enter keyword..." name="KeyWord" id="keyword" value="<?php echo $_SESSION["KeyWord"]; ?>">
                </div>
                <div class="level">
                    <div class="ChildCat">
                        <h3 id="ChildComent">Child Category</h3>
                        <select id="ChildCategory" name="ChildName">
                            <?php

                            foreach ($result as $child) {
                                if ($child['hierarchy_level'] == 1) {
                            ?>
                                    <option <?php if ($_SESSION['Child'] == $child['ProName']) { ?>selected="true" <?php }; ?>data-option="<?php echo $child['CatName']; ?>" value="<?php echo $child['ProName']; ?>"><?php echo $child['ProName']; ?></option>

                                <?php
                                } else {
                                ?>
                                    <option <?php if ($_SESSION['Child'] == "") { ?>selected="true" <?php }; ?> data-option="<?php echo $child['ProName']; ?>" value="">None</option>

                            <?php
                                }
                            }

                            ?>
                            <option <?php if ($_SESSION['Child'] == "" || isset($_POST['ClearSearch'])) { ?>selected=" true" <?php }; ?> data-option="" value="">None</option>
                        </select>
                    </div>
                    <div class="LargeCat">
                        <h3 id="ChildComent">Large Category</h3>
                        <select id="LargeCategory" name="LargeName" onchange="giveSelection(this.value)">
                            <?php
                            foreach ($result as $item) {
                                if ($item['hierarchy_level'] == 0) {
                            ?>
                                    <option <?php if ($_SESSION['Large'] == $item['ProName']) { ?>selected="true" <?php }; ?>value="<?php echo $item['ProName']; ?>"><?php echo $item['ProName']; ?></option>
                            <?php
                                }
                            }
                            ?>
                            <option <?php if ($_SESSION['Large'] == "" || isset($_POST['ClearSearch'])) { ?>selected="true" <?php }; ?> value="">None</option>
                        </select>
                    </div>
                </div>
                <div class="price">
                    <div class="PriceTo">
                        <h3 id="ChildComent">Price to</h3>
                        <input type="text" placeholder="Maximum price" id="MaxPrice" name="MaxPrice" value="<?php echo $_SESSION['Max']; ?>">
                        <p id="ChildComent" style="color: red; font-size: 1.5rem;font-weight:bold"><?php echo $_SESSION['faultmax']; ?></p>
                    </div>
                    <div class="PriceFrom">
                        <h3 id="ChildComent">Price from</h3>
                        <input type="text" placeholder="Minimum price" id="MinPrice" name="MinPrice" value="<?php echo $_SESSION['Min']; ?>">
                        <p id="ChildComent" style="color: red; font-size: 1.5rem;font-weight:bold"><?php echo $_SESSION['faultmin']; ?></p><br>
                    </div>
                </div>
                <div class="checkbox">
                    <input type="checkbox" id="IsPublic" name="Publish" value="1" <?php echo $_SESSION['CheckedPublic']; ?> />
                    <label for="IsPublic" style="font-size: 1.6rem; margin-right: 0px;">Is Public?</label>
                    <input type="checkbox" id="IsEmpty" name="Empty" value="1" <?php echo $_SESSION['CheckedEmpty']; ?>>
                    <label for="Empty" style="font-size: 1.6rem; margin-right: 0px;">Empty Inventory?</label>
                </div>
                <div class="onsubmit">
                    <input type="submit" value="Search" id="submit" name="submit">
                    <input type="submit" id="ClearSearch" name="ClearSearch" value="Clear Search" />
                </div>

            </div>
        </form>
        <form method="post" id="sortBar">
            <select id="NumOfPro" name="NumOfPro" onchange="this.form.submit()">
                <option value="12" <?php if ($_SESSION["NumPage"] == 12) echo 'selected=true'; ?>>12</option>
                <option value="10" <?php if ($_SESSION["NumPage"] == 10) echo 'selected=true'; ?>>10</option>
                <option value="8" <?php if ($_SESSION["NumPage"] == 8) echo 'selected=true'; ?>>8</option>

            </select>
            <div class="radioButton">
                <input type="radio" onclick="this.form.submit()" id="sort" name="sort" value='ASC' <?php if ($_SESSION["Order"] == 'ASC') echo 'checked'; ?>>
                <label for="ASC">ASC</label>
                <input type="radio" onclick="this.form.submit()" id="sort" name="sort" value='DESC' <?php if ($_SESSION["Order"] == 'DESC') echo 'checked'; ?>>
                <label for="DEC">DESC</label>
            </div>
            <select id="SortBy" name="SortBy" onchange="this.form.submit()">
                <option value="name" <?php if ($_SESSION["Field"] == 'name') echo 'selected=true'; ?>>Name</option>
                <option value="price" <?php if ($_SESSION["Field"] == 'price') echo 'selected=true'; ?>>Price</option>
            </select>
            <div class="Cart">
                <form method="post">
                    <button name="subCart" id="subCart" onclick="DisableBox()">Cart</button>
                </form>
                <div class="bubble">
                    <?php
                    $val = 0;
                    for ($i = 0; $i < count($_SESSION['NumCart']); $i++) {
                        $val += $_SESSION['NumCart'][$i];
                    }
                    echo $val;
                    ?>
                </div>
            </div>
        </form>


        <!-- Connect 2 selectors/////////////////////////////////////////////////-->
        <script>
            var sel1 = document.querySelector('#LargeCategory');
            var sel2 = document.querySelector('#ChildCategory');
            var options2 = sel2.querySelectorAll('option');

            function giveSelection(selValue) {
                sel2.innerHTML = 'noe';
                for (var i = 0; i < options2.length; i++) {
                    if (options2[i].dataset.option === selValue) {
                        sel2.appendChild(options2[i]);
                    }
                }
            }
            giveSelection(sel1.value);
        </script>

        <?php
        function filterLevel($dad, $son)
        {
            if (!$dad && !$son)
                return "(hierarchy_level>0) AND";
            else if ($dad && !$son) {
                return "(e.CatName='" . $dad . "') AND";
            } else {
                return "(e.CatName='" . $dad . "' AND ch.CatName='" . $son . "') AND";
            }
        }
        function filterPrice($pmi, $pma,$rate)
        {
            if ((preg_match("/^[a-zA-Z-' ]*$/", $pmi) && $pmi) || (preg_match("/^[a-zA-Z-' ]*$/", $pma) && $pma)) {
                return "invalid value";
            } else {
                if (!$pma && !$pmi) return "";
                else if ($pmi && !$pma) return "(a.price>=" . floor($pmi)* $rate . ") AND";
                else if (!$pmi && $pma) return "(a.price<=" . ($pma+0.005)* $rate . ") AND";
                else
                    return "(a.price>=" . floor($pmi) * $rate . " AND a.price<=" . ($pma + 0.005) * $rate . ") AND";
            }
        }
        function filterPublic($p)
        {
            if ($p == 1) {
                return "(a.Publish=1) AND";
            } else
                return "";
        }
        function filterEmpty($e)
        {
            if ($e == 1)
                return "(p.Remain=0) AND";
            else
                return "";
        }
        function SortBy($f)
        {
            if ($f == "name")
                return "ORDER BY Product";
            else
                return "ORDER BY Price";
        }
        function Order($o)
        {
            if ($o == 'ASC')
                return " ASC ";
            else
                return " DESC ";
        }


        //SQL-recursive db/////////////////////////////////////////////////////////////////////////////// 
        {
            $sql1 = "WITH RECURSIVE categories AS (
                SELECT ID,
                CatName,
                ParentID,
                0 AS hierarchy_level
                FROM categry
                WHERE ParentID =0

                UNION ALL

                SELECT e.ID,
                e.CatName,
                e.ParentID,
                hierarchy_level + 1
                FROM categry e, categories ch
                WHERE e.ParentID = ch.id
                )

                SELECT

                e.CatName AS ParentName,
                        e.ID AS ParentID,
                        ch.CatName AS ChildName,
                        ch.ID   AS ChildID,
                       	a.NamePro AS Product,
                        a.ID AS ProductID,
                        a.price AS Price,
                        a.publish AS Public,
                        p.Remain AS Empty,
                        a.link AS Link,
                        i.NameInven AS StoreName,
                        i.ID AS InvenID,
                        i.AddressInven AS Address,
                hierarchy_level
                FROM categories ch
                LEFT JOIN categry e ON ch.ParentID = e.ID
                LEFT JOIN product a ON a.Category=ch.ID
                LEFT JOIN productinventory p ON p.productID=a.ID
                LEFT JOIN inventory i ON i.ID=p.InvenID
                WHERE ";
        }
        $sql2 = "(ch.CatName LIKE '%" . $_SESSION['KeyWord'] . "%' OR e.CatName LIKE '%" . $_SESSION['KeyWord'] . "%' OR a.NamePro LIKE'%" . $_SESSION['KeyWord'] . "%')";
        $limit_query = "LIMIT " . $initial_page . "," . $_SESSION['NumPage'] . "";
        if (filterPrice($_SESSION['Min'], $_SESSION['Max'],$_SESSION['rate']) != "invalid value")
            $sql = $sql1 . filterLevel($_SESSION['Large'], $_SESSION['Child']) . filterPrice($_SESSION['Min'], $_SESSION['Max'], $_SESSION['rate']) . filterPublic($_SESSION['Public']) . filterEmpty($_SESSION['Empty']) . $sql2 . SortBy($_SESSION['Field']) . Order($_SESSION['Order']);
        else
            $sql = $sql1 . filterLevel($_SESSION['Large'], $_SESSION['Child']) . filterPublic($_SESSION['Public']) . filterEmpty($_SESSION['Empty']) . $sql2 . SortBy($_SESSION['Field']) . Order($_SESSION['Order']);
        $listForCount = mysqli_query($mysqli, $sql);
        $numrows = mysqli_num_rows($listForCount);
        $sql = $sql . $limit_query;
        $list = mysqli_query($mysqli, $sql);
        $total_pages = ceil($numrows / $_SESSION['NumPage']);
        $pageURL = "";
        ?>
        <div class="container">
            <!-- block to show detail of product -->
            <div id="showBlock"></div>
            <!-- block to show all product -->
            <div class="showBox" id="showBox">
                <?php
                if ($numrows > 0) {
                    foreach ($list as $item) {
                ?>
                        <!-- 1 product -->
                        <div class='product product<?php echo $_SESSION['NumPage']; ?>' id="<?php echo $item['ProductID'] . '_' . $item['InvenID'] . '_' . $_SESSION['NumPage']; ?>">
                            <!-- image -->
                            <img class="img-rounded" src="<?php echo $item['Link']; ?>" width="80%" height="50%" style="border-radius: 10px"></img>
                            <!-- name -->
                            <p style="color:black; font-size: 100%; margin-top:0px;height:3%"><?php echo $item['Product']; ?></p>
                            <!-- price -->
                            <p style="font-weight:bold; color: black;margin-top:0px;height:3% "><?php echo round($item['Price']/$_SESSION['rate'],2); ?> USD</p>
                            <!-- inventory -->
                            <p style="color: #000;height:3%"><?php echo $item['StoreName']; ?></p>
                            <!-- view details -->
                            <button class="view" onclick="showProduct('<?php echo $item['ProductID'] . '_' . $item['InvenID'] . '_' . $_SESSION['NumPage']; ?>')">View details</button>
                            <!-- add to cart -->
                            <div class="AddToCart">

                                <form method="post" <?php if (($item['InvenID'] != $_SESSION['StoreID']) && $_SESSION['StoreID']) echo "onsubmit='Alert()'" ?>>
                                    <input type="hidden" name="ProductID" value="<?php echo $item['ProductID']; ?>">
                                    <input type="hidden" name="StoreID" value="<?php echo $item['InvenID']; ?>">
                                    <input type="submit" name="CartSubmit" id="<?php if ($item['Empty'] != 0) echo 'CartSubmit'; ?>" value="Add To Cart" <?php if ($item['Empty'] == 0) echo "disabled"  ?>>
                                </form>
                            </div>
                            <!-- sold-out -->
                            <p class="SoldOut"><?php if ($item['Empty'] == 0) echo "SOLD OUT" ?></p>
                        </div>
                <?php
                    }
                } else
                    echo "Product does not exist";
                ?>
            </div>



            <div class="items">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $_SESSION['page_number']) {
                ?>
                        <a class='active' href="index.php?page=<?php echo $i; ?>&id=<?php echo $_SESSION['ID']; ?>"><?php echo $i; ?></a>
                    <?php
                    } else {
                    ?>
                        <a class="itemss" href="index.php?page=<?php echo $i; ?>&id=<?php echo $_SESSION['ID']; ?>"><?php echo $i; ?></a>
                <?php
                    }
                }

                ?>
            </div>
        </div>
    </div>

</body>

</html>