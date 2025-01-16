<?php
require_once '../class/Admin.php';

$deactivate = new Admin();

if(isset($_GET["id"])) {
    $deactivate->deactivateUser();
}

header('Location: ./manageUsers.php');
?>