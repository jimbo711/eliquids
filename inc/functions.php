<?php
/**************************************

    Display Table of Current Stock

    - $conn is passed in and is used as the database connection

***************************************/
function current_stock($conn) {
    // Query all results from table
    $results = mysqli_query($conn, "SELECT * FROM madeliquids ORDER BY liquidname ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // Begin html table
        echo "<table>\r\n";
        // Create the heading row
        echo "<tr><th>ID</th><th>Name</th><th>Qty</th><th>Sold</th></tr>\r\n";
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){ 
            // each iterration, create a html table row and fill it with db row data
            echo "<tr><td>".$row['id']."</td><td>".$row['liquidname']."</td><td>".$row['qty']."</td><td>".$row['sold']."</td></tr>\r\n";
        }
        // Close the html table
        echo "</table>\r\n";
    } else {
        echo "No results";
    }
}
/**************************************

    Display select field
        populated with all of the flavours from current stock.

    - $n is passed in and is used as the name of the select field in HTML
    - $conn is passed in and is used as the database connection

***************************************/
function flavourfield($n, $conn) {
    // Open select tag
    echo '<select name="'.$n.'">'."\r\n";
    // First option is blank
    echo "<option></option>\r\n";
    // Query all the liquid names
    $sql = "SELECT liquidname FROM madeliquids ORDER BY liquidname ASC";
    $result = mysqli_query($conn, $sql) 
            or die("Select field query failed: ".mysqli_error($conn));
    // Make them into an array and loop through
    while ($row=mysqli_fetch_array($result)) {
        $liquidname = $row["liquidname"];
        // Create an option in the select feild for each liquid name
        echo "<option>".$liquidname."</option>\r\n";
    }
    // Close select tag
    echo "</select>\r\n";
}
/***************************************

    Create and populate rows of 'fulfilled orders' html table
        with data from 'orders' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function fulfilled_orders($conn) {
    // Query all results from table
    $results = mysqli_query($conn, "SELECT * FROM orders ORDER BY `dispatched` DESC, `date` ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){ 
            // each iterration, create a html table row and fill it with db row data
            $fulfilled = $row['fulfilled'];
            if ($fulfilled) {
                echo "<tr>\r\n";
                echo "<td>".$row['id']."</td>\r\n";
                echo "<td>".$row['date']."</td>\r\n";
                echo "<td>".$row['name']."</td>\r\n";
                echo "<td>".$row['username']."</td>\r\n";
                echo "<td>".$row['size']."mL</td>\r\n";
                echo "<td>".$row['orderqty']."</td>\r\n";
                echo "<td>".$row['selection']."</td>\r\n";
                echo "<td>".$row['dispatched']."</td>\r\n";
                echo "</tr>\r\n";
            }
        }
    } else {
        echo "No results";
    }
}
/***************************************

    Create and populate rows of 'unfulfilled orders' html table
        with data from 'orders' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function unfulfilled_orders($conn) {
    // Query all results from table
    $results = mysqli_query($conn, "SELECT * FROM orders ORDER BY `date` ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){ 
            // each iterration, create a html table row and fill it with db row data
            $fulfilled = $row['fulfilled'];
            if (!$fulfilled) {
                echo "<tr>\r\n";
                echo "<td>".$row['id']."</td>\r\n";
                echo "<td>".$row['date']."</td>\r\n";
                echo "<td>".$row['name']."</td>\r\n";
                echo "<td>".$row['username']."</td>\r\n";
                echo "<td>".$row['size']."mL</td>\r\n";
                echo "<td>".$row['orderqty']."</td>\r\n";
                echo "<td>".$row['selection']."</td>\r\n";
                // Last column will be a checkbox with a value equal to the row ID
                echo "<td><input type=\"checkbox\" name=\"fulfilled[]\" value=\"".$row['id']."\"></td>\r\n";
                echo "</tr>\r\n";
            }
        }
    } else {
        echo "No results";
    }
}
?>