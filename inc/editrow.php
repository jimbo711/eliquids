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
    // Get user input
    $name = $_GET['name'];
    $newQty = $_GET['newQty'];
    // Create empty error message
    $errors = "";
    // validate name field (only letters, dashes and spaces)
    if($name == ""){
        $errors .= "<p>Blank field - You must choose a flavour to update.</p>\r\n";
    }
    // vaildate qty (must be numeric and not empty)
    if (!is_numeric($newQty)) {
        $errors .= "<p>Invalid qty - Qty must be a number.</p>\r\n";
    }
    // Continue if error message is still empty
    if ($errors == "") {
        // Store query
        $sql = "UPDATE madeliquids
                SET qty='$newQty' 
                WHERE liquidname='$name'";
        // Run Query
        if (mysqli_query($conn, $sql)) {
            header('Location: ../index.php');
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Else (there were errors), report and link home
        echo "<p>Operation aborted due to errors.  See Below:</p>\r\n";
        echo $errors;
        echo '<p><a href="../index.php">'."Go Back...</a></p>\r\n";
    }
    ?>
</div><!-- /#main-wrapper -->
<?php
// Page footer
include_once 'footer.php';
?>