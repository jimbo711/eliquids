<?php 
// Connect to DB
require_once 'inc/connect.php';
// PHP functions
require_once 'inc/functions.php';
// Assign page title
$page_title = "New Order";
// Page header
require_once 'inc/header.php';
?>
<div id="main-wrapper" class="error">
    <?php
    // Start a session so we can use the following data on the next page
    session_start();
    // Get user input
    $date     = $_GET['date'];
    $name     = $_GET['name'];
    $username = $_GET['username'];
    $orderQty = $_GET['orderQty'];
    $size     = "";                 // Size is selected via a radio button field in new order form.
    if (isset($_GET['size'])) {     // Only assign input to $size if an option was selected.
        $size = $_GET['size'];      // Neglecting this was allowing a uglier looking error to display.
    }
    // prevent sql injection
    $date = mysqli_real_escape_string($conn, $date);
    $name  = mysqli_real_escape_string($conn, $name);
    $username  = mysqli_real_escape_string($conn, $username);
    $size  = mysqli_real_escape_string($conn, $size);
    $orderQty  = mysqli_real_escape_string($conn, $orderQty);
    // change chars from html to equiv
    $date = htmlspecialchars($date);
    $name = htmlspecialchars($name);
    $username = htmlspecialchars($username);
    $size = htmlspecialchars($size);
    $orderQty = htmlspecialchars($orderQty);
    // Create empty error message
    $errors = "";
    // validate name field (only letters, dashes and spaces)
    if ($name == "") {
        $errors .= "<p>You must enter the customer name.</p>\r\n";
    } else if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $name)){
        $errors .= "<p>Invalid name - Only letters, dashes and spaces are allowed.</p>\r\n";
    }
    // validate size field (must be set and must be a number)
    if($size == "" || !is_numeric($size)) {
        $errors .= "<p>You must select a bottle size.</p>\r\n";
    }
    // validate orderQty (must be set, not blank and must be a number)
    if(!isset($orderQty) || $orderQty == "") {
        $errors .= "<p>You must select an order quantity.</p>\r\n";
    } else if(!is_numeric($orderQty)) {
        $errors .= "<p>Invalid order quantity - must be a number.</p>\r\n";
    }
    // Check for errors
    if ($errors !== "") {
        // If there are errors. Exit the script here, report errors and link home.
        echo '<h2>Woops...</h2>';
        exit($errors.'<p><a href="index.php">'."Go Back...</a></p>\r\n");
    } else {
        // Set session variables for use on the next page
        $_SESSION['date']     = $date;
        $_SESSION['name']     = $name;
        $_SESSION['username'] = $username;
        $_SESSION['size']     = $size;
        $_SESSION['orderQty'] = $orderQty;
        $_SESSION['goback']   = $_SERVER['REQUEST_URI']; // Current url path
    }
    ?>

    <h2>New Order</h2>
    <!-- Display User Input -->
    <table>
        <tr>
            <th>Date of Purchase:</th>
            <td><?php echo $date; ?></td>
        </tr>
        <tr>
            <th>Customer Name:</th>
            <td><?php echo $name; ?></td>
        </tr>
        <tr>
            <th>ebay User ID:</th>
            <td><?php echo $username; ?></td>
        </tr>
        <tr>
            <th>Bottle Size:</th>
            <td><?php echo $size; ?>mL</td>
        </tr>
        <tr>
            <th>Order Quantity:</th>
            <td><?php echo $orderQty; ?></td>
        </tr>
    </table>

    <div id="flavourSelection">
        <h3>Flavour Selection:</h3>
        <ul>
            <form action="inc/submitorder.php" method="GET">
            <?php
            // Create a number of selection fields equal to the order quantity
            for ($i=0; $i<$orderQty; $i++) {
                // Populate with flavours from current stock?>
                <li><?php flavourfield("flavour[$i]", $conn); ?></li>
            <?php
            }
            ?>
            <li><button type="submit">Confirm</button></li>
            </form>
        </ul>
    </div>

</div><!-- /#main-wrapper -->
<?php 
// Page footer 
include_once 'inc/footer.php' 
?>