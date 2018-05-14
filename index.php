<?php
// If user is not logged in, redirect to login page.
if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
}
// Connect to DB
require_once 'inc/connect.php';
// PHP functions
require_once 'inc/functions.php';
// Page header
require_once 'inc/header.php';
?>
 
    
<div id="main-wrapper">
<div class="clearfix stretch">

    <div id="results" class="wrapper">
        <h2>Current Stock</h2>
        <?php current_stock($conn); ?>
    </div><!-- /#results -->

    <div class="wrapper">
        <!-- Add item to DB -->
        <div id="addrow">
            <h3>Add Row</h3>
            <form action="inc/addrow.php" method="GET">
            <p>
                <input type="text" size="14" name="name" placeholder="Name">
                <input type="text" size="4" name="qty" placeholder="Qty">
                <button type="submit">Add</button>
            </p>
            </form>
        </div>

        <!-- Delete item from DB -->
        <div id="delrow">
            <h3>Delete Row</h3>
            <form action="inc/delrow.php" method="GET">
            <p>Select Row ID: 
                <input type="text" size="4" name="rowID">
                <button type="submit">Delete</button>
            </p>
            </form>
        </div>

        <!-- Change Qty -->
        <div id="editrow">
            <h3>Update Row</h3>
            <form action="inc/editrow.php" method="GET">
            <p>
                <?php flavourfield("name", $conn); ?>
                <input type="text" size="5" name="newQty" placeholder="New Qty">
                <button type="submit">Update</button>
            </p>
            </form>
        </div>

    </div><!-- /.wrapper -->

</div><!-- /.clearfix -->

<div id="neworder">
    <!-- Add a new order to the database -->
    <h3>New Order</h3>    
    <table class="formTable">
        <form action="neworder.php" method="GET">
        <tr>
            <th>Date</th>
            <td><input type="date" name="date" value="<?php echo date("Y-m-j"); ?>"></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <th>Size</th>
            <td>
                <p><input type="radio" name="size" value="10">10mL</p>
                <p><input type="radio" name="size" value="15">15mL</p>
                <p><input type="radio" name="size" value="30">30mL</p>
            </td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>
                <select name="orderQty">
                <option></option>
                <?php
                    // Populate drop-down with numbers (and values) 1-12
                    for ($i=1; $i<=12; $i++)
                    {
                        ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Submit</button></td>
        </tr>
        </form>
    </table>
</div><!-- /#neworder -->

<div id="orders">
    <!-- Display Unfulfilled orders -->
    <h2>Unfulfilled Orders</h2>
    <table id="unfulfilled" class="stretch">
        <form action="inc/markfulfilled.php" method="GET">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Username</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Selection</th>
            <th>Done</th>
        </tr>
        <?php unfulfilled_orders($conn); ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2"><button type="submit">Mark Fulfilled</button></td>
        </tr>
        </form>
    </table>
    <!-- Display recent orders -->
    <h2>Fulfilled Orders</h2>
    <table id="fulfilled" class="stretch">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Username</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Selection</th>
            <th>Dispatched</th>
        </tr>
        <?php fulfilled_orders($conn); ?>
    </table>
</div>

</div><!-- /#wrapper -->

<?php include_once 'inc/footer.php'; ?>