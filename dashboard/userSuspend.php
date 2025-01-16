<?php
require_once '../class/Admin.php';

$suspend = new Admin();

if(isset($_GET["id"])) {
    $suspend->suspendUser();
}

header('Location: ./manageUsers.php');
?>