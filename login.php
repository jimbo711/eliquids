<?php
// Assign page title
$page_title = "Login";
// Page header
require_once 'inc/header.php';
?>

<div id="login">
    <form action="inc/verifylogin.php" method="POST">
    <table>
        <tr>
            <th>Username:</th>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <th>Password:</th>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">Login</button>
            </td>
        </tr>
    </table>
</div><!-- /#login -->


<?php 
// Page footer 
include_once 'inc/footer.php' 
?>