<?php
require_once '../class/Admin.php';

$activate = new Admin();

if(isset($_GET["id"])) {
    $activate->activateUser();
}

header('Location: ./manageUsers.php');
?>