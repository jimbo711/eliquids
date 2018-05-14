<?php
// Default header variables
if (!isset($page_title)) {
    // If page title isn't set, set to default
    $page_title = "eLiquids";
}
if (!isset($style_path)) {
    // If style path isn't set, set to default
    $style_path = ""; // Assign "../" on other pages where necessary
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $style_path; ?>styles/reset.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $style_path; ?>styles/style.css">
</head>
<body>