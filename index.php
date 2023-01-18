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
    <link rel="stylesheet" href="assets/styles/salesforce-lightning-design-system-offline.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript">
    </script>

    <script>
        function addToCart(event) {
            console.log(event);
            document.getElementById("bubble").innerHTML = event;
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

    $res = 0;
    function transferNumber($num)
    {
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
        if ($decimal != 0) {
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
    function getCurrentcyRate($currencyName)
    {
        $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=10";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        $findUSD = $currencyName;
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
        $res /= 100000;
        $res = round($res, 1);
        $res *= 1000;
        $_SESSION['rate'] = $res;
    }
    function showDetail($productID, $price, $remain, $storeID, $address, $link)
    {
        return $productID . '*_*' . transferNumber(round($price * $_SESSION['rate'])) . '*_*' . $remain . '*_*' . $storeID . '*_*' . $address . '*_*' . $link;
    }
    function findInformationProduct($event)
    {
        $data = new mysqli("localhost", "root", "", "e_commerce");
        $SQL = "SELECT * FROM product WHERE ID='" . $event . "'";
        $ls = mysqli_query($data, $SQL);
        foreach ($ls as $item) {
            echo $item['NamePro'];
        }
    }
    $mysqli = new mysqli("localhost", "root", "", "e_commerce");
    $customerSQL = "SELECT * FROM customercontact";
    $customerList = mysqli_query($mysqli, $customerSQL);
    $cusNumRows = mysqli_num_rows($customerList);
    if ($mysqli->connect_error) {
        exit('Could not connect');
    }
    $informationProductSQL = "SELECT NamePro as Name,price as Price,ID as id
            FROM product";
    $informationProductDB = mysqli_query($mysqli, $informationProductSQL);
    $disableBackground = false;
    $showCart = false;

    //POST/////////////////////////////////////////// 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Inc,Dec,Delete,ChangeNum in Cart
        for ($i = 0; $i < count($_SESSION['NumCart']); $i++) {
            $_SESSION['NumCart'][$i] = isset($_POST["number" . $i]) ? $_POST['number' . $i] : $_SESSION['NumCart'][$i];

            //Change Num of product // <-- những chỗ logic phức tạp như này chú thích lại là đúng r đó
            if (isset($_POST['number' . $i])) {
                $disableBackground = true;
                $showCart = true;
                if ($_POST['number' . $i] <= 0) {
                    $_SESSION['NumCart'][$i] = 1;
                } else {
                    $remainSQL = "SELECT Remain FROM productinventory WHERE productID=" . $_SESSION['Cart'][$i];
                    $remainValidate = mysqli_query($mysqli, $remainSQL);
                    $remain = 0;
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
                <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="modal-heading-01" class="slds-modal slds-fade-in-open">
                    <div class="slds-modal__container">

                        <div class="slds-modal__header">
                            <h1 id="modal-heading-01" class="slds-modal__title slds-hyphenate">Are you sure to delete this product?</h1>
                        </div>
                        <div class="slds-modal__content slds-p-around_medium slds-text-align_center">
                            <?php findInformationProduct($_SESSION['Cart'][$i]); ?>
                        </div>
                        <div class="slds-modal__footer slds-text-align_center">
                            <form method="post">
                                <button class="slds-button slds-button_brand " name="YPermit<?= $i; ?>">YES</button>
                                <button class="slds-button slds-button_destructive" name="NPermit<?= $i; ?>">NO</button>
                            </form>
                        </div>
                    </div>
                </section>
                <div class="slds-backdrop slds-backdrop_open" role="presentation"></div>
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
                    $remain = 0;
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

        //Add data to database
        //2 loops use to find infor of product to add db
        for ($i = 1; $i <= $cusNumRows; $i++) {
            foreach ($customerList as $item) {
                if (isset($_POST['Customer' . $i . '_' . $item['ID']])) {
                    $random = generateRandomString();
                    $total = 0;
                    $num = $_SESSION['StoreID'];
                    $CusID = $item['ID'];
                    for ($j = 0; $j < count($_SESSION['NumCart']); $j++) {
                        //add to ORDERDETAIL TABLE
                        $InsertOrderDetails = "INSERT INTO `orderdetail` (`ID`, `Quantity`, `productID`, `orderID`) VALUES ('', " . $_SESSION['NumCart'][$j] . ", " . $_SESSION['Cart'][$j] . ", " . $random . ");";
                        $mysqli->query($InsertOrderDetails);
                        $UpdateRemain = "UPDATE productinventory SET Remain = Remain-" . $_SESSION['NumCart'][$j] . " WHERE productID = " . $_SESSION['Cart'][$j] . " AND InvenID=" . $_SESSION['StoreID'];
                        $mysqli->query($UpdateRemain);
                        foreach ($informationProductDB as $item) {
                            if ($item['id'] == $_SESSION["Cart"][$j]) {
                                $total += $_SESSION['NumCart'][$j] * $item['Price'];
                            }
                        }
                    }
                    //add to ORDER TABLE

                    $InsertOrder = "INSERT INTO `orders` (`ID`, `StoreID`, `Customer`, `Total`) VALUES (" . $random . ", " . $_SESSION['StoreID'] . "," . $CusID . ", " . $total . ");";
                    $mysqli->query($InsertOrder);
                    //After checkout, return empty cart


                    $_SESSION["Cart"] = array();
                    $_SESSION['NumCart'] = array();
                    $_SESSION['StoreID'] = 0;

                    // Redirect to bill
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
                <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="header43" class="slds-modal slds-fade-in-open   ">
                    <div class="slds-modal__container">

                        <form method="post" class="slds-text-align_right">
                            <button class=" slds-button slds-button_icon slds-modal__close slds-button_icon-inverse">
                                <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                                    <use xlink:href="/assets/icons/utility-sprite/svg/symbols.svg#close"></use>
                                </svg>
                            </button>
                        </form>
                        <div class="slds-modal__header">
                            <h1 id="modal-heading-01" class="slds-modal__title slds-hyphenate">NO PRODUCT</h1>
                        </div>

                    </div>
                </section>
                <div class="slds-backdrop slds-backdrop_open" role="presentation"></div>
            <?php
            } else {
            ?>
                <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="modal-heading-01" class="slds-modal slds-fade-in-open slds-modal_large slds-app-launcher">
                    <div class="slds-modal__container">
                        <form method="post" class="slds-text-align_right">
                            <button class=" slds-button slds-button_icon slds-modal__close slds-button_icon-inverse">
                                <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                                    <use xlink:href="/assets/icons/utility-sprite/svg/symbols.svg#close"></use>
                                </svg>
                            </button>
                        </form>
                        <div class="slds-modal__header">
                            <h1 id="modal-heading-01" class="slds-modal__title slds-hyphenate">Customer List Checkout</h1>
                        </div>
                        <div class="slds-modal__content slds-p-around_medium slds-text-align_center">
                            <table class="slds-table slds-table_cell-buffer slds-table_bordered">
                                <thead>
                                    <tr class="slds-line-height_reset">
                                        <th>No </th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Shipping address</th>
                                        <th></th>
                                    </tr>
                                </thead>
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
                                            <button id="EachCheckout" name="Customer<?php echo $No; ?>_<?php echo $item['ID']; ?>" class="slds-button slds-button_success">Checkout</button>
                                        </form>
                                    </td>
                                <?php
                                    $No++;
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                        <div class="slds-modal__footer">
                            <form method="post">
                                <button class="slds-button slds-button_neutral" name="Cancel">Cancel</button>
                                <button class="slds-button slds-button_brand " name="subCart">Cart</button>
                            </form>
                        </div>
                    </div>
                </section>
                <div class="slds-backdrop slds-backdrop_open" role="presentation"></div>
                <!-- Show list of customer to checkout -->

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
        //click View Detail
        if (isset($_POST['viewDetail'])) {
            $inforProduct = showDetail($_POST['ProductID'], $_POST['Price'], $_POST['Remain'], $_POST['StoreID'], $_POST['Address'], $_POST['link']);
        }
        // click Add To Cart
        if (isset($_POST['CartSubmit'])) {
            if (($_POST['StoreID'] != $_SESSION['StoreID']) && $_SESSION['StoreID']&&count($_SESSION['NumCart'])) {
            ?>
                <div class="slds-notify_container slds-is-absolute">
                    <div class="slds-notify slds-notify_toast slds-theme_warning" role="status">
                        <span class="slds-assistive-text">success</span>
                        <span class="slds-icon_container slds-icon-utility-success slds-m-right_small slds-no-flex slds-align-top" title="Description of icon when needed">
                            <svg class="slds-icon slds-icon_small" aria-hidden="true">
                                <use xlink:href="/assets/icons/utility-sprite/svg/symbols.svg#warning"></use>
                            </svg>
                        </span>
                        <div class="slds-notify__content">
                            <h2 class="slds-text-heading_small ">Different store</h2>
                        </div>
                        <div class="slds-notify__close">
                            <form method="post">
                                <button class="slds-button slds-button_icon slds-button_icon-inverse" title="Close">
                                    <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                                        <use xlink:href="/assets/icons/utility-sprite/svg/symbols.svg#close"></use>
                                    </svg>
                                    <span class="slds-assistive-text">Close</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            }
            $index = -1;
            if (count($_SESSION['Cart']) == 0) {
                $_SESSION['StoreID'] = $_POST['StoreID'];
                array_splice($_SESSION['Cart'], count($_SESSION['Cart']), 0, $_POST['ProductID']);
                array_splice($_SESSION['NumCart'], count($_SESSION['NumCart']), 0, 1);
            } else {
                //Validate store
                if ($_POST['StoreID'] == $_SESSION['StoreID']) {
                    //Find number of product
                    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
                        if ($_POST['ProductID'] == $_SESSION['Cart'][$i]) {
                            $index = $i;
                            break;
                        } else
                            $index = -1;
                    }
                    ///Update number of product
                    if ($index == -1) {
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
            ///Validate price from
            $_SESSION['Min'] = $_POST['MinPrice'];
            if (preg_match("/^[a-zA-Z-' ]*$/", $_SESSION['Min']) && $_SESSION['Min']) {
                $_SESSION['faultmin'] = "Value is invalid!";
            } else {
                $_SESSION['faultmin'] = '';
            }
            ///Validate price to
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
            ///Call api to get transfer rate // <-- chỗ này nếu được thì invoke function call API, những chức năng có thể dùng lại nhiều lần như call API thì nên viết thành 1 function riêng để dễ xử lý
            getCurrentcyRate("USD");
        }
    }
    //////Show Cart Box
    if ($showCart == true) {
        ?>
        <section role="dialog" tabindex="-1" aria-modal="true" aria-labelledby="header43" class="slds-modal slds-fade-in-open slds-modal_large slds-app-launcher">
            <div class="slds-modal__container">

                <form method="post" class="slds-text-align_right">
                    <button class=" slds-button slds-button_icon slds-modal__close slds-button_icon-inverse">
                        <svg class="slds-button__icon slds-button__icon_large" aria-hidden="true">
                            <use xlink:href="/assets/icons/utility-sprite/svg/symbols.svg#close"></use>
                        </svg>
                    </button>
                </form>
                <div class="slds-modal__header">
                    <h1 id="modal-heading-01" class="slds-modal__title slds-hyphenate">CART</h1>
                </div>
                <div class="slds-modal__content slds-p-around_medium" id="modal-content-id-1">

                    <table class="slds-table slds-table_cell-buffer slds-table_bordered">
                        <thead>
                            <tr class="slds-line-height_reset">
                                <th>No</th>
                                <th>Product Name</th>
                                <th class="slds-text-align_center">Quantity</th>
                                <th>Price</th>
                                <th>Sub total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php
                        $pay = 0;
                        for ($j = 0; $j < count($_SESSION["NumCart"]); $j++) {
                            echo "<tr>";
                            echo "<td>" . ($j + 1) . "</td>";
                            foreach ($informationProductDB as $item) {
                                if ($item['id'] == $_SESSION["Cart"][$j]) {
                                    echo "<td>" . $item['Name'] . "</td>";
                        ?>
                                    <td>
                                        <!-- decrease button -->
                                        <form method="post">
                                            <button class="valuebutton" id="decbut" name='decqty<?php echo $j; ?>'>-</button>
                                        </form>

                                        <!-- show num of product -->
                                        <form method="post">
                                            <input class="numberChange" type="number" name="number<?php echo $j; ?>" id="number<?php echo $j; ?>" value="<?= $_SESSION['NumCart'][$j]; ?>" onchange="this.form.submit()" />
                                        </form>

                                        <!-- increase button -->
                                        <form method="post">
                                            <button class="valuebutton" id="incbut" name='incqty<?php echo $j; ?>'>+</button>
                                        </form>
                                    </td>
                                    <?php
                                    //Price
                                    echo "<td>" . transferNumber(round($item['Price'] * $_SESSION['rate'])) . " VND</td>";
                                    //Subtotal
                                    echo "<td>" . transferNumber(round($item['Price'] * $_SESSION['rate']) * $_SESSION['NumCart'][$j])  . " VND</td>";
                                    $pay += round($item['Price'] * $_SESSION['rate']) * $_SESSION['NumCart'][$j];
                                    ?>

                                    <td>
                                        <form method="post">
                                            <button name="delete<?php echo $j; ?>" class="slds-button slds-button_destructive">Delete</button>
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

                    <!-- Total -->
                    <div class="totalPay">
                        <p>Total: <span style="color:red;"><?php echo transferNumber($pay)  ?> VND</span> </p>
                    </div>

                </div>
                <div class="slds-modal__footer">
                    <form method="post">
                        <button class="slds-button slds-button_neutral" name="Cancel">Cancel</button>
                        <button class="slds-button slds-button_brand " name="Checkout">Checkout</button>
                    </form>
                </div>
            </div>
        </section>
        <div class="slds-backdrop slds-backdrop_open" role="presentation"></div>

    <?php
    }


    $_SESSION['ID'] = $_SESSION['KeyWord'] . '_' . $_SESSION['Large'] . '_' . $_SESSION['Child'] . '_' . $_SESSION['Min'] . '_' . $_SESSION['Max'] . '_' . $_SESSION['Public'] . '_' . $_SESSION['Empty'] . '_' . $_SESSION['CheckedPublic'] . '_' . $_SESSION['CheckedEmpty'] . '_' . $_SESSION['NumPage'] . '_' . $_SESSION['Field'] . '_' . $_SESSION['Order'];
    $initial_page = ($_SESSION['page_number'] - 1) * $_SESSION['NumPage'];
    //SQL/////////////////////////////////////////////
    {
        $categorySelectorSQL = "WITH RECURSIVE categories AS (
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
        $categorySelectorDB = mysqli_query($mysqli, $categorySelectorSQL);
    }
    ?>


    <!-- FORM -->

    <div>
        <form method="post">
            <div class="slds-card slds-form-element">
                <!-- Input KEYWORD -->
                <div class="slds-form-element__control slds-card__header slds-size_2-of-2">
                    <input class="slds-input " id="fontSize" type="text" placeholder="Enter keyword..." name="KeyWord" value="<?php echo $_SESSION["KeyWord"]; ?>">
                </div>

                <!-- Input CATEGORY -->
                <div class="slds-form-element__control slds-card__header slds-grid">
                    <div class="slds-size_1-of-2 slds-text-align_left ">
                        <select id="LargeCategory" class="slds-select" name="LargeName" onchange="giveSelection(this.value)">
                            <?php
                            foreach ($categorySelectorDB as $item) {
                                if ($item['hierarchy_level'] == 0) {
                            ?>
                                    <option <?php if ($_SESSION['Large'] == $item['ProName']) { ?>selected="true" <?php }; ?>value="<?php echo $item['ProName']; ?>"><?php echo $item['ProName']; ?></option>
                            <?php
                                }
                            }
                            ?>
                            <option <?php if ($_SESSION['Large'] == "" || isset($_POST['ClearSearch'])) { ?>selected="true" <?php }; ?> value="">Large Category</option>
                        </select>
                    </div>
                    <div class="slds-size_1-of-2 slds-text-align_right">
                        <select id="ChildCategory" name="ChildName" class="slds-select ">
                            <?php

                            foreach ($categorySelectorDB as $child) {
                                if ($child['hierarchy_level'] == 1) {
                            ?>
                                    <option <?php if ($_SESSION['Child'] == $child['ProName']) { ?>selected="true" <?php }; ?>data-option="<?php echo $child['CatName']; ?>" value="<?php echo $child['ProName']; ?>"><?php echo $child['ProName']; ?></option>

                                <?php
                                } else {
                                ?>
                                    <option <?php if ($_SESSION['Child'] == "") { ?>selected="true" <?php }; ?> data-option="<?php echo $child['ProName']; ?>" value="">Child Category</option>

                            <?php
                                }
                            }

                            ?>
                            <option <?php if ($_SESSION['Child'] == "" || isset($_POST['ClearSearch'])) { ?>selected=" true" <?php }; ?> data-option="" value="">Child Category</option>
                        </select>
                    </div>

                </div>

                <!-- Input PRICE -->
                <div class="slds-form-element__control slds-card__header slds-grid">
                    <div class="slds-size_1-of-2 slds-text-align_left">
                        <input id="price" class="slds-input" type="text" placeholder="Price from" id="MinPrice" name="MinPrice" value="<?php echo $_SESSION['Min']; ?>">
                        <p id="ChildComent" style="color: red; font-size: 1.5rem;font-weight:bold"><?php echo $_SESSION['faultmin']; ?></p><br>
                    </div>
                    <div class="slds-size_1-of-2 slds-text-align_right">
                        <input id="price" class="slds-input" type="text" placeholder="Price to" id="MaxPrice" name="MaxPrice" value="<?php echo $_SESSION['Max']; ?>">
                        <p id="ChildComent" style="color: red; font-size: 1.5rem;font-weight:bold"><?php echo $_SESSION['faultmax']; ?></p>
                    </div>
                </div>

                <!-- Input EMPTY/PUBLIC -->
                <div class="slds-form-element__control slds-card__header slds-grid">
                    <div class="slds-checkbox ">
                        <input type="checkbox" name="Publish" id="IsPublic" value="1" <?php echo $_SESSION['CheckedPublic']; ?> />
                        <label class="slds-checkbox__label" for="IsPublic">
                            <span class="slds-checkbox_faux"></span>
                            <span class="slds-form-element__label">Is Public?</span>
                        </label>
                    </div>
                    <div class="slds-checkbox">
                        <input type="checkbox" name="Empty" id="IsEmpty" value="1" <?php echo $_SESSION['CheckedEmpty']; ?> />
                        <label class="slds-checkbox__label" for="IsEmpty">
                            <span class="slds-checkbox_faux"></span>
                            <span class="slds-form-element__label">Empty inventory?</span>
                        </label>
                    </div>
                </div>

                <!-- click Search/ClearSearch -->
                <div class="slds-form-element__control slds-card__header slds-grid">
                    <div class="slds-text-align_right slds-size_1-of-2 slds-m-right_x-small">
                        <input class="slds-button slds-button_brand " type="submit" name="submit" value="Search">
                    </div>
                    <div class="slds-text-align_left slds-size_1-of-2">
                        <input class="slds-button slds-button_destructive" type="submit" name="ClearSearch" value="Clear Search" />
                    </div>
                </div>
            </div>
        </form>
        <form method="post">
            <!-- filter by NUMBER OF PRODUCT -->
            <div class="slds-form-element__control slds-grid slds-m-top_large slds-m-bottom_large">
                <div class="slds-size_3-of-4 slds-text-align_left slds-p-left_large slds-form-element__control">
                    <select class="slds-select slds-size_1-of-8" name="NumOfPro" onchange="this.form.submit()">
                        <option value="12" <?php if ($_SESSION["NumPage"] == 12) echo 'selected=true'; ?>>12</option>
                        <option value="10" <?php if ($_SESSION["NumPage"] == 10) echo 'selected=true'; ?>>10</option>
                        <option value="8" <?php if ($_SESSION["NumPage"] == 8) echo 'selected=true'; ?>>8</option>

                    </select>
                </div>

                <!-- CART -->
                <div class="slds-size_1-of-4 slds-grid">
                    <div class="slds-size_1-of-4 slds-is-relative">
                        <div class="">
                            <form method="post">
                                <button class="slds-button slds-size_3-of-4 slds-button_outline-brand slds-is-relative" name="subCart" onclick="DisableBox()">Cart</button>
                            </form>
                        </div>
                        <div class="bubble slds-is-absolute" id="bubble" style="left:66%;">
                            <?php
                            $val = 0;
                            for ($i = 0; $i < count($_SESSION['NumCart']); $i++) {
                                $val += $_SESSION['NumCart'][$i];
                            }
                            echo $val;
                            ?>
                        </div>
                        <!-- BUBBLE -->
                    </div>


                    <!-- filter by NAME/PRICE -->
                    <div class="slds-size_1-of-4 slds-text-align_right">
                        <select class="slds-select" name="SortBy" onchange="this.form.submit()">
                            <option value="name" <?php if ($_SESSION["Field"] == 'name') echo 'selected=true'; ?>>Name</option>
                            <option value="price" <?php if ($_SESSION["Field"] == 'price') echo 'selected=true'; ?>>Price</option>
                        </select>
                    </div>

                    <!-- filter by ASC/DESC -->
                    <div class="slds-size_1-of-2 slds-m-left_small">
                        <fieldset class="slds-form-element">
                            <div class="slds-form-element__control">
                                <div class="slds-radio_button-group">
                                    <span class="slds-button slds-radio_button">
                                        <input type="radio" name="sort" id="ASC" value="ASC" onclick="this.form.submit()" <?php if ($_SESSION["Order"] == 'ASC') echo 'checked'; ?> />
                                        <label class="slds-radio_button__label" for="ASC">
                                            <span class="slds-radio_faux">ASC</span>
                                        </label>
                                    </span>
                                    <span class="slds-button slds-radio_button">
                                        <input type="radio" name="sort" id="DESC" value="DESC" onclick="this.form.submit()" <?php if ($_SESSION["Order"] == 'DESC') echo 'checked'; ?> />
                                        <label class="slds-radio_button__label" for="DESC">
                                            <span class="slds-radio_faux">DESC</span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>



    <!-- Connect 2 selectors/////////////////////////////////////////////////-->
    <script>
        var largeCategorySelector = document.querySelector('#LargeCategory');
        var ChildCategorySelector = document.querySelector('#ChildCategory');
        var optionsInChild = ChildCategorySelector.querySelectorAll('option');

        function giveSelection(selectValue) {
            ChildCategorySelector.innerHTML = 'No';
            for (var i = 0; i < optionsInChild.length; i++) {
                if (optionsInChild[i].dataset.option === selectValue) {
                    ChildCategorySelector.appendChild(optionsInChild[i]);
                }
            }
        }
        giveSelection(largeCategorySelector.value);
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
    function filterPrice($pmi, $pma, $rate)
    {
        if ((preg_match("/^[a-zA-Z-' ]*$/", $pmi) && $pmi) || (preg_match("/^[a-zA-Z-' ]*$/", $pma) && $pma)) {
            return "invalid value";
        } else {
            if (!$pma && !$pmi) return "";
            else if ($pmi && !$pma) return "(a.price>=" . $pmi / $rate . ") AND";
            else if (!$pmi && $pma) return "(a.price<=" . $pma / $rate . ") AND";
            else
                return "(a.price>=" . $pmi / $rate . " AND a.price<=" . $pma / $rate     . ") AND";
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
        $categoryRecursiveSQL = "WITH RECURSIVE categories AS (
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
                WHERE "; // <-- nên đặt tên rõ cho câu query như này để dễ hiểu, ví dụ: categoryQueryStr
    }
    $searchFormSQL = "(ch.CatName LIKE '%" . $_SESSION['KeyWord'] . "%' OR e.CatName LIKE '%" . $_SESSION['KeyWord'] . "%' OR a.NamePro LIKE'%" . $_SESSION['KeyWord'] . "%')";
    $limit_query = "LIMIT " . $initial_page . "," . $_SESSION['NumPage'] . "";
    if (filterPrice($_SESSION['Min'], $_SESSION['Max'], $_SESSION['rate']) != "invalid value")
        $categorySQL = $categoryRecursiveSQL . filterLevel($_SESSION['Large'], $_SESSION['Child']) . filterPrice($_SESSION['Min'], $_SESSION['Max'], $_SESSION['rate']) . filterPublic($_SESSION['Public']) . filterEmpty($_SESSION['Empty']) . $searchFormSQL . SortBy($_SESSION['Field']) . Order($_SESSION['Order']);
    else
        $categorySQL = $categoryRecursiveSQL . filterLevel($_SESSION['Large'], $_SESSION['Child']) . filterPublic($_SESSION['Public']) . filterEmpty($_SESSION['Empty']) . $searchFormSQL . SortBy($_SESSION['Field']) . Order($_SESSION['Order']);
    $categoryDB = mysqli_query($mysqli, $categorySQL);
    $numrows = mysqli_num_rows($categoryDB);
    $categorySQL = $categorySQL . $limit_query;
    $categoryOnePageSQL = mysqli_query($mysqli, $categorySQL);
    $total_pages = ceil($numrows / $_SESSION['NumPage']);
    $pageURL = "";
    ?>
    <div class="slds-grid <?php if ($disableBackground == true) echo "DisableBox" ?>">
        <!-- block to show all product -->
        <!-- id="showBox slds-form-element " -->
        <div class=" slds-card slds-form-element slds-grid slds-wrap slds-size_<?php if (isset($_POST['viewDetail'])) echo 3;
                                                                                else echo 4; ?>-of-4">
            <?php
            if ($numrows > 0) {
                foreach ($categoryOnePageSQL as $item) {
            ?>
                    <!-- 1 product -->
                    <!-- product product<?php echo $_SESSION['NumPage']; ?> -->
                    <div style="height:400px" class='slds-form-element__control slds-text-align_center slds-m-top_small   slds-size_1-of-<?php echo $_SESSION['NumPage'] / 2; ?> ' id="<?php echo $item['ProductID'] . '_' . $item['InvenID'] . '_' . $_SESSION['NumPage']; ?>">
                        <!-- image -->
                        <div style="height:50%;display:block;" class="slds-form-element__control slds-is-relative ">
                            <img style="max-height:100%;max-width:100%" class="slds-p-around_large" src="<?php echo $item['Link']; ?>" style="border-radius: 10px">
                            <?php if ($item['Empty'] == 0) {
                            ?>

                                <div class="slds-is-absolute slds-size_1-of-2 " style="top:40%;margin-left:25%;font-size:1.5rem; color:red;font-weight: bold;transform: rotate(-60deg); filter:brightness(90%)">SOLD OUT</div>
                            <?php } ?>

                        </div>
                        <div class="slds-form-element__control">
                            <!-- name -->
                            <p style=" color:black; font-size: 100%; margin-top:0px;height:3%"><?php echo $item['Product']; ?></p>
                            <!-- price -->
                            <p style="font-weight:bold; color: black;margin-top:0px;height:3% "><?php echo TransferNumber(round($item['Price'] * $_SESSION['rate'])); ?> VND</p>
                            <!-- inventory -->
                            <p style="color: #000;height:3%"><?php echo $item['StoreName']; ?></p>
                            <div class="slds-p-around_small slds-text-align_center">
                                <!-- view details -->
                                <div class="slds-m-bottom_xx-small">
                                    <form method="post">
                                        <input type="hidden" name="ProductID" value="<?php echo $item['Product']; ?>" />
                                        <input type="hidden" name="StoreID" value="<?php echo $item['StoreName']; ?>">
                                        <input type="hidden" name="Remain" value="<?php echo $item['Empty']; ?>">
                                        <input type="hidden" name="Price" value="<?php echo $item['Price']; ?>">
                                        <input type="hidden" name="Address" value="<?php echo $item['Address']; ?>">
                                        <input type="hidden" name="link" value="<?php echo $item['Link']; ?>">
                                        <input type="submit" name="viewDetail" value="View Detail" class="slds-button slds-button_neutral">
                                    </form>
                                </div>
                                <!-- add to cart -->
                                <div class="">
                                    <form method="post">
                                        <input type="hidden" name="ProductID" value="<?php echo $item['ProductID']; ?>">
                                        <input type="hidden" name="StoreID" value="<?php echo $item['InvenID']; ?>">
                                        <input class="slds-button slds-button_neutral" name="CartSubmit" type="submit" value="Add To Cart" <?php if ($item['Empty'] == 0) echo "disabled";  ?>>
                                    </form>
                                </div>
                                <!-- sold-out -->
                            </div>

                        </div>
                    </div>
            <?php
                }
            } else
                echo "Product does not exist";
            ?>

            <!-- Pagination -->
            <div class="slds-form-element__control slds-size_2-of-2 slds-text-align_center slds-m-bottom_small">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $_SESSION['page_number']) {
                ?>
                        <a class='slds-button slds-button_brand' href="index.php?page=<?php echo $i; ?>&id=<?php echo $_SESSION['ID']; ?>"><?php echo $i; ?></a>
                    <?php
                    } else {
                    ?>
                        <a class="slds-button slds-button_neutral" href="index.php?page=<?php echo $i; ?>&id=<?php echo $_SESSION['ID']; ?>"><?php echo $i; ?></a>
                <?php
                    }
                }

                ?>
            </div>
        </div>


        <!-- block to show detail of product -->
        <?php if (isset($_POST['viewDetail'])) {
        ?>

            <div class="slds-card slds-form-element slds-p-around_large slds-size_<?php if (isset($_POST['viewDetail'])) echo 1;
                                                                                    else echo 0; ?>-of-4 slds-m-top_none">
                <?php
                $details = explode("*_*", $inforProduct);
                ?>
                <div style="height: 20%"></div>
                <div style="height: 40%; padding:auto;" class="slds-p-around_large slds-text-align_center">
                    <img src="<?php echo $details[5]; ?>" style="max-height:100%">
                </div>
                <div class="slds-form-element__control slds-text-align_center" style="height:30%;">
                    <table class="slds-table " style="max-height:100%">
                        <tr>
                            <td>Name:</td>
                            <td style="font-weight: bold"><?php echo $details[0]; ?></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td style="font-weight: bold"><?php echo $details[1]; ?> VND</td>
                        </tr>
                        <tr>
                            <td>Remain:</td>
                            <td style="font-weight: bold"><?php echo $details[2]; ?></td>
                        </tr>
                        <tr>
                            <td>Store:</td>
                            <td style="font-weight: bold"><?php echo $details[3]; ?></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td style="font-weight: bold"><?php echo $details[4]; ?></td>
                        </tr>
                    </table>
                </div>

            </div>
        <?php } ?>
    </div>

</body>

</html>