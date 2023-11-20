<?php
    include_once "congfig.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);
?>