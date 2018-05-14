<?php 
// Connect to DB
require_once 'connect.php'; 
// Set page title
$page_title = "Woops...";
// Set style path
$style_path = "../";
// Page header
require_once 'header.php';
?>
<div id="main-wrapper" class="error">
        <h2>Woops...</h2>
        <?php
        // If user input exists
        if (isset($_GET['fulfilled'])) {
        // Get user input
        $fulfilled  = $_GET['fulfilled'];
        // Check at least one box was checked
        if (count($fulfilled) > 0) {
                // Loop through array of checked boxes
                // The values will correspond to a row id which we want to update (mark fulfilled)
                foreach ($fulfilled as $order) {
                // Store query - set fulfilled column to true where row ID matches selected checkbox value
                $sql = "UPDATE orders
                        SET fulfilled = 1 
                        WHERE id = '$order'";
                // Run Query
                mysqli_query($conn, $sql);
                // Store query - enter current date into 'dispatched' column
                $date = date("Y-m-d");
                $sql = "UPDATE orders
                        SET dispatched = '$date' 
                        WHERE id = '$order'";
                // Run Query
                mysqli_query($conn, $sql);
                }
                // Redirect home
                header('Location: ../index.php');
        }
        } else {
                // Else (nothing was selected), report and link home
                echo "<p>Nothing was selected.</p>\r\n";
                echo '<p><a href="../index.php">'."Go Back...</a></p>\r\n";
        }
        ?>
</div><!-- /#main-wrapper -->
<?php
// Page Footer
include_once 'footer.php';
?>    